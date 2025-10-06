<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"  content="CHERISH, デトックスサロン, 福岡サロン, 水素吸入, 足湯, 岩盤浴, 心と体ケア, リラクゼーション, ヒーリング, 自分時間">
      <meta name="description" content="福岡のデトックスサロンCHERISH。水素吸入・天然鉱石の足湯・低温岩盤浴で心と体を癒し、自分を大切にする時間をご提供します。">
      <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
      <title>CHERISH｜福岡のデトックスサロン｜水素吸入・足湯・岩盤浴</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
         href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Kiwi+Maru&display=swap"
         rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

 {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
 <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <script src="{{ url('js/app.js') }}"></script>
        <style>
body{
  font-family: "Jost", sans-serif;

}
</style>
    </head>
    <body >
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
          <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <!-- Bootstrap 5 JS (bundle includes Popper) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#servicesTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']],
    });


     $('#testimonialsTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']],
    });
});




</script>
</html>
