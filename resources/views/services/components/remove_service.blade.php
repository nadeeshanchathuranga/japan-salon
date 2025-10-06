<!-- Delete button -->
<button type="button"
        class="btn btn-danger btn-sm text-white"
        data-bs-toggle="modal"
        data-bs-target="#remove-service-{{ $service->id }}">
    <i class="fa fa-trash"></i> Delete
</button>
<!-- Modal -->
<div class="modal fade" id="remove-service-{{ $service->id }}" tabindex="-1" aria-labelledby="removeServiceLabel-{{ $service->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeServiceLabel-{{ $service->id }}">
          Remove Service : {{ $service->title }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('services.destroy', $service->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          Are you sure you want to remove this Service from the system?
          <br>
          <p class="text-danger mb-0">This action cannot be undone.</p>
          <input type="hidden" name="service_id" value="{{ $service->id }}">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Yes, delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>
