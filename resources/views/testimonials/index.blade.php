<x-app-layout>
<div class="container py-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i> ダッシュボード</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">お客様の声</li>
            </ol>
        </nav>
    </div>

    <!-- Create Service Button + Modal -->
    @include('testimonials.components.create_testimonial')
   </div>

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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                 <table id="testimonialsTable" class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:70px;" class="text-center">#</th>
                <th>イメージ</th>
                <th>タイトル</th>
                <th>詳細</th>

                <th>ステータス</th>
                <th style="width:160px;">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)

                <tr>
                    <!-- Index -->
                    <td class="text-center fw-semibold">{{ $testimonial->id }}</td>

                    <!-- Image -->
                    <td>
                       @if($testimonial->image_path)
    <img src="{{ asset($testimonial->image_path) }}"
         class="rounded border"
         style="height:50px; width:50px; object-fit:cover;"
         alt="testimonial image">
@else
    <span class="text-muted">画像なし</span>
@endif

                    </td>
                     <!-- Title -->
                    <td>{{ $testimonial->name }}</td>

                    <!-- Description -->
                    <td>{{ \Illuminate\Support\Str::limit($testimonial->content, 50) }}</td>


                    <!-- Status -->
                    <td>
                        @if($testimonial->is_active)
                            <span class="badge bg-success">表示</span>
                        @else
                            <span class="badge bg-secondary">非表示</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="d-flex gap-2">
                        @include('testimonials.components.edit_testimonial', ['testimonial' => $testimonial])
                        @include('testimonials.components.remove_testimonial', ['testimonial' => $testimonial])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
            </div>
        </div>
    </div>
</div>

<!-- Reusable Edit Service Modal (single instance) -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 class="modal-title" id="editServiceLabel">修正</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="editServiceForm" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">タイトル <span class="text-danger">*</span></label>
            <input type="text" name="title" id="edit-title" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">詳細</label>
            <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">金額 (¥) <span class="text-danger">*</span></label>
            <input type="number" name="price" id="edit-price" class="form-control" step="0.01" min="0" required>
          </div>

          <div class="mb-2">
            <label class="form-label d-block">現在の画像</label>
            <img id="edit-preview" src="" alt="service image" class="rounded d-none" style="height:60px;object-fit:cover;">
          </div>

          <div class="mb-1">
            <label class="form-label">画像を変更（任意）</label>
            <input type="file" name="image" id="edit-image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
            <div class="form-text">対応形式: jpeg, png, jpg, gif, svg　最大2MB</div>
          </div>

          <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="edit-active" name="is_active" value="1">
            <label class="form-check-label" for="edit-active">表示</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">更新</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- DataTables + Modal wiring -->
<script>

    $(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#testimonialsTable')) {
        $('#testimonialsTable').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
        });
    }
});

</script>
</x-app-layout>
