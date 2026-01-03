<x-app-layout>
<div class="container py-4">

    <!-- Header & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i> ダッシュボード</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">予約一覧</li>
                </ol>
            </nav>
        </div>

       
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mb-2">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Reservations Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="reservationsTable" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px;" class="text-center">#</th>
                            <th>サービス</th>
                            <th>予約日時</th>
                            
                            <th>名前</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th>その他リクエスト</th>
                            <th style="width:160px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <!-- Index -->
                                <td class="text-center fw-semibold">{{ $reservation->id }}</td>

                                <!-- Service -->
                                <td>{{ $reservation->service->title ?? '未設定' }}</td>

                                <!-- Date & Time -->
                                <td>{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}
{{ $reservation->time }}

                                </td> 

                                <!-- Customer Info -->
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->email }}</td>

                                <!-- Other Requests -->
                                <td>{{ \Illuminate\Support\Str::limit($reservation->other_request, 50) }}</td>

                                <!-- Actions -->
                                <td class="d-flex gap-2">
                                   @include('reservations.components.edit_reservation', ['reservation' => $reservation])
     @include('reservations.components.remove_reservation', ['reservation' => $reservation])
                                    
                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $reservations->links() }}
                </div>

            </div>
        </div>
    </div>

</div>

<!-- DataTable Initialization -->
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#reservationsTable')) {
            $('#reservationsTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: -1 } // Disable ordering on actions column
                ]
            });
        }
    });
</script>

</x-app-layout>
