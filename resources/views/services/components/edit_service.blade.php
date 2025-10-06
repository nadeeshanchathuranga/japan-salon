<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="{{ '#edit-service'.$service->id }}">
    <i class="fa fa-edit"></i> Edit
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'edit-service'.$service->id }}" tabindex="-1" aria-labelledby="editServiceLabel{{ $service->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="editServiceLabel{{ $service->id }}">Edit Service : {{ $service->title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('services.update', $service->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="modal-body">
            <input type="hidden" name="id" value="{{ $service->id }}"/>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="title{{ $service->id }}">Title</label>
                  <input type="text" class="form-control" name="title" id="title{{ $service->id }}"
                         value="{{ old('title', $service->title) }}" required>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <div class="form-group">
                  <label for="description{{ $service->id }}">Description</label>
                  <textarea  required class="form-control" name="description" id="description{{ $service->id }}" rows="3">{{ old('description', $service->description) }}</textarea>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price{{ $service->id }}">Price</label>
                  <input type="number"  step="0.01" class="form-control" name="price" id="price{{ $service->id }}"
                         value="{{ old('price', $service->price) }}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="is_active{{ $service->id }}">Active Status</label>
                  <select class="form-control" name="is_active" id="is_active{{ $service->id }}">
                    <option value="1" {{ old('is_active', (int)$service->is_active) === 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', (int)$service->is_active) === 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <!-- File input (left) -->
              <div class="col-md-8">
                <div class="form-group">
                  <label for="image{{ $service->id }}">Service Image ( Size Width 350px * Height 200px)</label>
                  <input type="file" class="form-control" name="image" id="image{{ $service->id }}"
                         accept="image/png,image/jpeg,image/jpg,image/webp,image/gif">
                  <small class="text-muted">Max 2MB. Types: jpg, jpeg, png, webp, gif</small>
                </div>
              </div>

              <!-- Preview (right) -->
              <div class="col-md-4 d-flex align-items-center">
                @if($service->image_path)
                  <div class="text-center w-100">
                    <small class="d-block mb-1">Current</small>
                    <img src="{{ asset('storage/'.$service->image_path) }}"
                         alt="service image"
                         class="rounded border"
                         style="height:80px; width:80px; object-fit:cover;">
                  </div>
                @else
                  <span class="text-muted">No image</span>
                @endif
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Service</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
