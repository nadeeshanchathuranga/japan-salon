<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="{{ '#edit-reservation'.$reservation->id }}">
    <i class="fa fa-edit"></i> Edit
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'edit-reservation'.$reservation->id }}" tabindex="-1" aria-labelledby="editReservationLabel{{ $reservation->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="editReservationLabel{{ $reservation->id }}">Edit Reservation #{{ $reservation->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
          @csrf
          @method('PUT')

          <input type="hidden" name="id" value="{{ $reservation->id }}"/>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="service{{ $reservation->id }}" class="form-label">Service</label>
              <select class="form-control" name="service_id" id="service{{ $reservation->id }}" required>
                @foreach($services as $service)
                  <option value="{{ $service->id }}" {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                    {{ $service->title }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label for="datetime{{ $reservation->id }}" class="form-label">Date & Time</label>
              <input type="datetime-local" class="form-control" name="datetime" id="datetime{{ $reservation->id }}" 
                     value="{{ old('datetime', $reservation->date . 'T' . $reservation->time) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="name{{ $reservation->id }}" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name{{ $reservation->id }}" value="{{ old('name', $reservation->name) }}" required>
            </div>

            <div class="col-md-6">
              <label for="phone{{ $reservation->id }}" class="form-label">Phone</label>
              <input type="text" class="form-control" name="phone" id="phone{{ $reservation->id }}" value="{{ old('phone', $reservation->phone) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="email{{ $reservation->id }}" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email{{ $reservation->id }}" value="{{ old('email', $reservation->email) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="other_request{{ $reservation->id }}" class="form-label">Other Requests</label>
              <textarea class="form-control" name="other_request" id="other_request{{ $reservation->id }}" rows="3">{{ old('other_request', $reservation->other_request) }}</textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Reservation</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
