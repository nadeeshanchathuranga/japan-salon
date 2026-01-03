<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}  {{ __("管理画面へようこそ！") }}
        </h2>
    </x-slot>

  <div class="container py-5">
   <div class="row">
      <!-- Service Card -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
         <div class="dashboard-card card shadow-sm h-100 border-0 rounded-3">
            <div class="card-body text-center">
               <div class="icon-wrapper mb-3">
                  <i class="bi bi-briefcase-fill fs-1"></i>
               </div>
               <h2 class=" pb-4 fw-bold">サービス追加</h2>

               <a href="{{ route('services.index') }}" class="btn btn-primary w-100">開く</a>
            </div>
         </div>
      </div>
      <!-- Example: Customers -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
         <div class="dashboard-card card shadow-sm h-100 border-0 rounded-3">
            <div class="card-body text-center">
               <div class="icon-wrapper mb-3">
                  <i class="bi bi-people-fill fs-1"></i>
               </div>
               <h2 class="pb-4  fw-bold">お客様の声</h2>
               <a href="{{ route('testimonials.index') }}"  class="btn btn-success w-100">開く</a>
            </div>
         </div>
      </div>



       <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
         <div class="dashboard-card card shadow-sm h-100 border-0 rounded-3">
            <div class="card-body text-center">
               <div class="icon-wrapper mb-3">
                 <i class="bi bi-calendar-event fs-1"></i>

               </div>
               <h2 class="pb-4  fw-bold">予約</h2>
               <a href="{{ route('reservations.index') }}"  class="btn btn-info w-100">開く</a>
            </div>
         </div>
      </div>
   </div>
</div>


</x-app-layout>
