<!-- Delete button -->
<button type="button"
        class="btn btn-danger btn-sm text-white"
        data-bs-toggle="modal"
        data-bs-target="#remove-reservation-{{ $reservation->id }}">
    <i class="fa fa-trash"></i> Delete
</button>

<!-- Modal -->
<div class="modal fade" id="remove-reservation-{{ $reservation->id }}" tabindex="-1" aria-labelledby="removeReservationLabel-{{ $reservation->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="removeReservationLabel-{{ $reservation->id }}">
          Remove Reservation #{{ $reservation->id }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal-body">
          Are you sure you want to remove this Reservation from the system?
          <br>
          <p class="text-danger mb-0">This action cannot be undone.</p>
          <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Yes, delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </form>
    </div>
  </div>
</div>
