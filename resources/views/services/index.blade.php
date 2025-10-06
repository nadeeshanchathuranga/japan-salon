<x-app-layout>
<div class="container py-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
            </ol>
        </nav>
    </div>

    <!-- Create Service Button + Modal -->
    @include('services.components.create_service')
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
                 <table id="servicesTable" class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:70px;" class="text-center">#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-end">Price</th>
                <th>Status</th>
                <th style="width:160px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)

                <tr>
                    <!-- Index -->
                    <td class="text-center fw-semibold">{{ $service->id }}</td>

                    <!-- Image -->
                    <td>
                        @if($service->image_path)
                            <img src="{{ asset('storage/'.$service->image_path) }}"
                                 class="rounded border"
                                 style="height:50px; width:50px; object-fit:cover;"
                                 alt="service image">
                        @else
                            <span class="text-muted">No image</span>
                            
                        @endif
                    </td>

                    <!-- Title -->
                    <td>{{ $service->title }}</td>

                    <!-- Description -->
                    <td>{{ \Illuminate\Support\Str::limit($service->description, 50) }}</td>

                    <!-- Price -->
                    <td class="text-end">¥{{ number_format($service->price, 2) }}</td>

                    <!-- Status -->
                    <td>
                        @if($service->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="d-flex gap-2">
                        @include('services.components.edit_service', ['service' => $service])
                        @include('services.components.remove_service', ['service' => $service])
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
        <h5 class="modal-title" id="editServiceLabel">Edit Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="editServiceForm" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="edit-title" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Price (¥) <span class="text-danger">*</span></label>
            <input type="number" name="price" id="edit-price" class="form-control" step="0.01" min="0" required>
          </div>

          <div class="mb-2">
            <label class="form-label d-block">Current Image</label>
            <img id="edit-preview" src="" alt="service image" class="rounded d-none" style="height:60px;object-fit:cover;">
          </div>

          <div class="mb-1">
            <label class="form-label">Replace Image (optional)</label>
            <input type="file" name="image" id="edit-image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
            <div class="form-text">Supported: jpeg, png, jpg, gif, svg. Max 2MB.</div>
          </div>

          <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="edit-active" name="is_active" value="1">
            <label class="form-check-label" for="edit-active">Active</label>
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
<script>
    $(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#servicesTable')) {
        $('#servicesTable').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
        });
    }
});

</script>
</x-app-layout>
