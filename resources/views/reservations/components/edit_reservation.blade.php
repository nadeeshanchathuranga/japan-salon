<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#edit-reservation{{ $reservation->id }}">
    <i class="fa fa-edit"></i> 修正
</button>

<!-- Modal -->
<div class="modal fade" id="edit-reservation{{ $reservation->id }}" tabindex="-1" aria-labelledby="editReservationLabel{{ $reservation->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

      <div class="modal-header">
        <h5 class="modal-title" id="editReservationLabel{{ $reservation->id }}">予約を修正 #{{ $reservation->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
           <div class="col-lg-12 mx-auto">
                <div id="message-{{ $reservation->id }}" class="jost-font">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>
                <form method="POST" class="edit-reservation-form edit-form-{{ $reservation->id }}" action="{{ route('reservations.update', $reservation->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-12">
                            <label class="form-label font-14 jost-font">氏名<span class="text-danger">*</span></label>
                            <input type="text" name="name" minlength="2" maxlength="100"
                                class="form-control edit-name"
                                value="{{ $reservation->name }}"
                                placeholder="氏名を入力してください" required>
                            <div class="invalid-feedback">氏名は2文字以上100文字以下で入力してください。</div>
                        </div>

                        <!-- Date / Time -->
                        <div class="col-sm-6">
                            <label class="form-label font-14 jost-font">日時を選択<span class="text-danger">*</span></label>
                            <input type="hidden" class="edit-datetime" name="datetime" value="{{ $reservation->date }}T{{ $reservation->time }}">
                            <div class="d-flex gap-2">
                                @php
                                    $allowedTimes = [
                                        '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
                                        '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00',
                                        '17:30', '18:00', '18:30',
                                    ];
                                @endphp
                                <input type="date" class="form-control edit-date-input"
                                    value="{{ $reservation->date }}"
                                    min="{{ now()->format('Y-m-d') }}" required>
                                <select class="form-select edit-time-select" required>
                                    <option value="">時間...</option>
                                    @foreach ($allowedTimes as $t)
                                        <option value="{{ $t }}"
                                            @if ($reservation->time === $t) selected @endif>{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="invalid-feedback">日付と時間を選択してください。</div>
                        </div>

                        <!-- Service -->
                        <div class="col-sm-6">
                            <label class="form-label font-14 jost-font">サービス<span class="text-danger">*</span></label>
                            <select name="service_id" class="form-select edit-service" required>
                                <option value="">サービスを選択...</option>
                                @foreach ($services1 as $service)
                                    <option value="{{ $service->id }}"
                                        @if ($reservation->service_id == $service->id) selected @endif>{{ $service->title }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">サービスを選択してください。</div>
                        </div>

                        <!-- Phone -->
                        <div class="col-sm-6">
                            <label class="form-label font-14 jost-font">電話番号<span class="text-danger">*</span></label>
                            <input type="tel" name="phone" maxlength="11" minlength="10"
                                class="form-control edit-phone"
                                value="{{ $reservation->phone }}"
                                placeholder="09012345678" required>
                            <div class="invalid-feedback">有効な電話番号を入力してください。</div>
                        </div>

                        <!-- Email -->
                        <div class="col-sm-6">
                            <label class="form-label font-14 jost-font">メールアドレス<span class="text-danger">*</span></label>
                            <input type="email" name="email" maxlength="255"
                                class="form-control edit-email"
                                value="{{ $reservation->email }}"
                                placeholder="example@email.com" required>
                            <div class="invalid-feedback">有効なメールアドレスを入力してください。</div>
                        </div>

                        <!-- Other Request -->
                        <div class="col-12">
                            <label class="form-label font-14 jost-font">その他ご希望</label>
                            <textarea name="other_request" class="form-control edit-request"
                                maxlength="1000" rows="3"
                                placeholder="何かご要望やご質問がございましたら、こちらにご記入ください。">{{ $reservation->other_request }}</textarea>
                            <div class="text-muted font-12 mt-1"><span class="edit-char-count">0</span>/1000</div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary edit-submit-btn">更新する</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const reservationId = {{ $reservation->id }};
    const form = document.querySelector('.edit-form-' + reservationId);

    if (!form) return;

    const dateInput = form.querySelector('.edit-date-input');
    const timeSelect = form.querySelector('.edit-time-select');
    const hiddenDatetime = form.querySelector('.edit-datetime');
    const charCountEl = form.querySelector('.edit-char-count');
    const submitBtn = form.querySelector('.edit-submit-btn');
    const requestInput = form.querySelector('.edit-request');
    const nameInput = form.querySelector('.edit-name');
    const phoneInput = form.querySelector('.edit-phone');
    const emailInput = form.querySelector('.edit-email');
    const serviceSelect = form.querySelector('.edit-service');

    const allowedTimes = ["10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"];
    const closedDays = [1, 4];

    const serverNowMs = {{ (int) \Carbon\Carbon::now()->getTimestamp() * 1000 }};
    const clockOffsetMs = serverNowMs - Date.now();

    const timeToMinutes = t => {
        const [h, m] = t.split(':').map(Number);
        return h * 60 + m;
    };

    const isClosedDay = dateStr => closedDays.includes(new Date(dateStr).getDay());

    const combineAndSetHidden = () => {
        hiddenDatetime.value = dateInput.value && timeSelect.value
            ? dateInput.value + 'T' + timeSelect.value
            : '';
    };

    function showDatetimeError(msg) {
        clearDatetimeError();
        const err = document.createElement('div');
        err.className = 'text-danger font-12 mt-1 edit-datetime-error';
        err.innerHTML = '<i class="fa-solid fa-exclamation-circle me-1"></i>' + msg;
        timeSelect.parentNode.appendChild(err);
    }

    function clearDatetimeError() {
        const err = form.querySelector('.edit-datetime-error');
        if (err) err.remove();
    }

    /* ---------------- FLATPICKR ---------------- */
    if (typeof flatpickr !== 'undefined') {
        flatpickr(dateInput, {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            disable: [function(date) { return closedDays.includes(date.getDay()); }],
            onChange: () => dateInput.dispatchEvent(new Event('change')),
        });
    }

    function refreshBaseTimeOptions() {
        const now = Date.now() + clockOffsetMs;
        timeSelect.innerHTML = '<option value="">時間を選択...</option>';

        allowedTimes.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t;
            opt.textContent = t;

            if (dateInput.value) {
                const [y, m, d] = dateInput.value.split('-').map(Number);
                const [hh, mm] = t.split(':').map(Number);
                const slotDate = new Date(y, m - 1, d, hh, mm);

                if (slotDate.getTime() <= now) {
                    opt.disabled = true;
                    opt.textContent += ' (終了)';
                }
            }

            timeSelect.appendChild(opt);
        });
    }

   async function applyReservationBlocking(date) {
    if (!date) return;

    try {
        const res = await fetch(`/reservations-by-date?date=${date}`);
        if (!res.ok) throw new Error('Network error');

        const data = await res.json();
        // example response:
        // { "15:00": 2, "16:30": 1 }

        const blockedRanges = [];

        /* -------- SAME TIME SLOT >= 2 → BLOCK ±1 HOUR -------- */
        Object.entries(data).forEach(([timeStr, count]) => {
            if (count >= 2) {
                const centerMin = timeToMinutes(timeStr);

                blockedRanges.push([
                    centerMin - 60, // 1 hour before
                    centerMin + 60  // 1 hour after
                ]);
            }
        });

        /* -------- APPLY BLOCKS TO TIME OPTIONS -------- */
        Array.from(timeSelect.options).forEach(opt => {
            if (!opt.value || opt.disabled) return;

            const optionMin = timeToMinutes(opt.value);

            const isBlocked = blockedRanges.some(
                ([start, end]) => optionMin >= start && optionMin <= end
            );

            if (isBlocked) {
                opt.disabled = true;
            }
        });

    } catch (error) {
        console.error(error);
        showDatetimeError('予約情報の取得に失敗しました');
    }
}


    dateInput.addEventListener('change', async function () {
        clearDatetimeError();

        if (!this.value) {
            timeSelect.innerHTML = '<option value="">時間を選択...</option>';
            return;
        }

        if (isClosedDay(this.value)) {
            showDatetimeError('申し訳ございません。月曜日と木曜日は定休日です。');
            this.value = '';
            timeSelect.innerHTML = '<option value="">時間を選択...</option>';
            return;
        }

        refreshBaseTimeOptions();
        await applyReservationBlocking(this.value);
        combineAndSetHidden();
    });

    timeSelect.addEventListener('change', combineAndSetHidden);

    requestInput.addEventListener('input', function() {
        charCountEl.textContent = this.value.length;
    });

    charCountEl.textContent = requestInput.value.length;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        clearDatetimeError();

        let isValid = true;

        if (!nameInput.value.trim() || nameInput.value.length < 2) {
            nameInput.classList.add('is-invalid');
            isValid = false;
        }

        if (!dateInput.value || !timeSelect.value) {
            dateInput.classList.add('is-invalid');
            timeSelect.classList.add('is-invalid');
            showDatetimeError('日付と時間を選択してください。');
            isValid = false;
        } else if (timeSelect.options[timeSelect.selectedIndex].disabled) {
            timeSelect.classList.add('is-invalid');
            showDatetimeError('選択された時間は利用できません。');
            isValid = false;
        }

        if (!serviceSelect.value) {
            serviceSelect.classList.add('is-invalid');
            isValid = false;
        }

        const phoneValue = phoneInput.value.trim().replace(/[^0-9]/g, '');
        if (!phoneValue || phoneValue.length < 10 || !/^0\d{9,10}$/.test(phoneValue)) {
            phoneInput.classList.add('is-invalid');
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
            emailInput.classList.add('is-invalid');
            isValid = false;
        }

        if (!isValid) return;

        combineAndSetHidden();

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>更新中...';
        this.submit();
    });

    if (dateInput.value) {
        refreshBaseTimeOptions();
        applyReservationBlocking(dateInput.value);
    }
});
</script>

