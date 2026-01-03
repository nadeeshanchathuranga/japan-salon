<!-- Trigger: Add New -->
<button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#new-testimonial-modal">
 <i class="bi bi-plus-circle me-1"></i> お客様の声を追加
</button> 
<div class="modal fade" id="new-testimonial-modal" tabindex="-1" aria-labelledby="newTestimonialLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="newTestimonialLabel">お客様の声を追加</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">
          <div class="row g-3">
            <!-- Title -->
            <div class="col-12">
              <label class="form-label">名前 <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
              @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
              <label class="form-label">詳細 <span class="text-danger">*</span></label>
              <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
              @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        
            <!-- Image -->
            <div class="col-md-6">
              <label class="form-label">イメージ ( Size Width 150px * Height 150px)</label>
              <input type="file" name="image" class="form-control" accept="image/*">
              @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
              <div class="form-text">対応形式: jpeg, png, jpg, gif, svg</div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>保存
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
        </div>
      </form>

    </div>
  </div>
</div>
