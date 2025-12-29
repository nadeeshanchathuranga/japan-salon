<!-- Delete button -->
<button type="button"
        class="btn btn-danger btn-sm text-white"
        data-bs-toggle="modal"
        data-bs-target="#remove-testimonial-{{ $testimonial->id }}">
    <i class="fa fa-trash"></i> 削除
</button> 
<div class="modal fade" id="remove-testimonial-{{ $testimonial->id }}" tabindex="-1" aria-labelledby="removetestimonialLabel-{{ $testimonial->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removetestimonialLabel-{{ $testimonial->id }}">
          削除 : {{ $testimonial->title }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          このサービスシステムから削除してもよろしいですか？
          <br>
          <p class="text-danger mb-0">（復元することは出来ません！）</p>
          <input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">はい、削除</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
        </div>
      </form>

    </div>
  </div>
</div>
