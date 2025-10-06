<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="{{ '#edit-testimonial'.$testimonial->id }}">
    <i class="fa fa-edit"></i> Edit
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'edit-testimonial'.$testimonial->id }}" tabindex="-1" aria-labelledby="edittestimonialLabel{{ $testimonial->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="edittestimonialLabel{{ $testimonial->id }}">Edit testimonial : {{ $testimonial->title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <input type="hidden" name="id" value="{{ $testimonial->id }}"/>
             <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name{{ $testimonial->id }}">Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" id="title{{ $testimonial->id }}"
                         value="{{ old('name', $testimonial->name) }}" required>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <div class="form-group">
                  <label for="content{{ $testimonial->id }}">Content</label>
                  <textarea class="form-control" name="content" id="content{{ $testimonial->id }}" rows="3" required>{{ old('content', $testimonial->content) }}</textarea>
                </div>
              </div>
            </div>

            <div class="row mt-2">


              <div class="col-md-6">
                <div class="form-group">
                  <label for="is_active{{ $testimonial->id }}">Active Status</label>
                  <select class="form-control" name="is_active" id="is_active{{ $testimonial->id }}">
                    <option value="1" {{ old('is_active', (int)$testimonial->is_active) === 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', (int)$testimonial->is_active) === 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <!-- File input (left) -->
              <div class="col-md-8">
                <div class="form-group">
                  <label for="image{{ $testimonial->id }}">testimonial Image ( Size Width 150px * Height 150px)</label>
                  <input type="file" class="form-control" name="image" id="image{{ $testimonial->id }}"
                         accept="image/png,image/jpeg,image/jpg,image/webp,image/gif">
                  <small class="text-muted">Max 2MB. Types: jpg, jpeg, png, webp, gif</small>
                </div>
              </div>

              <!-- Preview (right) -->
              <div class="col-md-4 d-flex align-items-center">
                @if($testimonial->image_path)
                  <div class="text-center w-100">
                    <small class="d-block mb-1">Current</small>
                    <img src="{{ asset('storage/'.$testimonial->image_path) }}"
                         alt="testimonial image"
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
            <button type="submit" class="btn btn-primary">Update testimonial</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
