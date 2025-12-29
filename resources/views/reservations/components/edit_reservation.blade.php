<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="{{ '#edit-reservation'.$reservation->id }}">
    <i class="fa fa-edit"></i> 修正
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'edit-reservation'.$reservation->id }}" tabindex="-1" aria-labelledby="editReservationLabel{{ $reservation->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

<!-- Flatpickr for modal datetime (disable Monday/Thursday) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  (function(){
    const dt = document.getElementById('datetime{{ $reservation->id }}');
    if(!dt) return;

    // ensure browser native picker doesn't conflict
    try { dt.type = 'text'; } catch(e) {}

    if (typeof flatpickr !== 'undefined') {
      flatpickr(dt, {
        enableTime: true,
        time_24hr: true,
        minuteIncrement: 30,
        dateFormat: 'Y-m-d\TH:i',
        minDate: new Date(),
        disable: [
          function(date) { return [1,4].includes(date.getDay()); }
        ],
        onChange: function(selectedDates, dateStr){
          // keep existing input listeners happy
          dt.dispatchEvent(new Event('input', { bubbles: true }));
        }
      });
    }
  })();
</script>

      <div class="modal-header">
        <h5 class="modal-title" id="editReservationLabel{{ $reservation->id }}">予約を修正 #{{ $reservation->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
          @csrf
          @method('PUT')

          <input type="hidden" name="id" value="{{ $reservation->id }}"/>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="service{{ $reservation->id }}" class="form-label">サービス</label>
              <select class="form-control" name="service_id" id="service{{ $reservation->id }}" required>
                @foreach($services as $service)
                  <option value="{{ $service->id }}" {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                    {{ $service->title }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label for="datetime{{ $reservation->id }}" class="form-label">予約日時</label>
              <input type="datetime-local" class="form-control" name="datetime" id="datetime{{ $reservation->id }}" 
                     value="{{ old('datetime', $reservation->date . 'T' . $reservation->time) }}" required step="1800" min="{{ now()->format('Y-m-d\TH:i') }}">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="name{{ $reservation->id }}" class="form-label">名前</label>
              <input type="text" class="form-control" name="name" id="name{{ $reservation->id }}" value="{{ old('name', $reservation->name) }}" required>
            </div>

            <div class="col-md-6">
              <label for="phone{{ $reservation->id }}" class="form-label">電話番号</label>
              <input type="text" class="form-control" name="phone" id="phone{{ $reservation->id }}" value="{{ old('phone', $reservation->phone) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="email{{ $reservation->id }}" class="form-label">メールアドレス</label>
              <input type="email" class="form-control" name="email" id="email{{ $reservation->id }}" value="{{ old('email', $reservation->email) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="other_request{{ $reservation->id }}" class="form-label">その他リクエスト</label>
              <textarea class="form-control" name="other_request" id="other_request{{ $reservation->id }}" rows="3">{{ old('other_request', $reservation->other_request) }}</textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">修正完了</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<script>
  (function(){
    const dt = document.getElementById('datetime{{ $reservation->id }}');
    const form = dt ? dt.closest('form') : null;
    function isClosedDayFromValue(val){
      if(!val) return false;
      const parts = val.split('T');
      let d;
      if(parts.length === 2){
        const dateParts = parts[0].split('-');
        d = new Date(parseInt(dateParts[0],10), parseInt(dateParts[1],10)-1, parseInt(dateParts[2],10));
      } else {
        d = new Date(val);
      }
      return [1,4].includes(d.getDay());
    }
    function showError(msg){
      let el = document.getElementById('datetimeError{{ $reservation->id }}');
      const parent = dt ? dt.parentNode : null;
      if(!el && parent){
        el = document.createElement('div');
        el.id = 'datetimeError{{ $reservation->id }}';
        el.className = 'text-danger small mt-1';
        parent.appendChild(el);
      }
      if(el) el.textContent = msg;
    }
    function clearError(){
      const el = document.getElementById('datetimeError{{ $reservation->id }}');
      if(el) el.remove();
    }

    // initial validation for pre-filled value (when modal opens)
    if(dt && dt.value && isClosedDayFromValue(dt.value)){
      showError('Our shop is closed on Mondays and Thursdays. Please choose another day.');
      dt.setCustomValidity('Our shop is closed on Mondays and Thursdays. Please choose another day.');
    } else if(dt) {
      dt.setCustomValidity('');
    }

    if(dt){
      dt.addEventListener('input', function(){
        clearError();
        if(isClosedDayFromValue(this.value)){
          this.setCustomValidity('Our shop is closed on Mondays and Thursdays. Please choose another day.');
          showError('Our shop is closed on Mondays and Thursdays. Please choose another day.');
        } else {
          this.setCustomValidity('');
          clearError();
        }
      });
    }
    if(form){
      form.addEventListener('submit', function(e){
        if(dt && isClosedDayFromValue(dt.value)){
          e.preventDefault();
          showError('Our shop is closed on Mondays and Thursdays. Please choose another day.');
          dt.focus();
          return false;
        }
      });
    }
  })();
</script>
