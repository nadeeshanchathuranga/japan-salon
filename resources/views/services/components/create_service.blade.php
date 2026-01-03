<!-- Trigger: Add New -->
<button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#new-service-modal">
 <i class="bi bi-plus-circle me-1"></i> サービスを追加
</button>

<!-- Modal: New Service -->
<div class="modal fade" id="new-service-modal" tabindex="-1" aria-labelledby="newServiceLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="newServiceLabel">サービスを追加</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">
          <div class="row g-3">
            <!-- Title -->
            <div class="col-12">
              <label class="form-label">タイトル <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
              @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Description -->
           <div class="col-12">
    <label class="form-label">詳細 <span class="text-danger">*</span></label>
    <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
    @error('description') 
        <div class="text-danger small">{{ $message }}</div> 
    @enderror
</div>

            <!-- Price -->
            <div class="col-md-6">
              <label class="form-label">金額 (¥) <span class="text-danger">*</span></label>
              <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price') }}" required>
              @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Image -->
            <div class="col-md-6">
              <label class="form-label">イメージ ( Size Width 350px * Height 200px)  </label>
              <input type="file" name="image" class="form-control" accept="image/*" required>
              @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
              <div class="form-text">対応形式: jpeg, png, jpg, gif, svg</div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> 保存
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
        </div>
      </form>

    </div>
  </div>
</div>
