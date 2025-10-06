<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
    <!-- Page bg -->
    <div class="min-h-screen relative flex items-center justify-center overflow-hidden
                bg-gradient-to-br from-slate-50 via-white to-slate-100
                dark:from-slate-900 dark:via-slate-950 dark:to-slate-900">
      <!-- subtle pattern -->
      <div aria-hidden="true"
           class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.08),transparent_60%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.12),transparent_60%)]"></div>

      <!-- Card -->
      <div class="z-10 w-full max-w-md px-6 sm:px-8">
        <div class="mb-6 flex w-full items-center justify-center">
          <a href="{{ route('home') }}" title="{{ config('app.name') }} | Home">
            <img
              src="{{ asset('/images/logo.png') }}"
              alt="CHERISH"
              class="h-25 w-auto sm:h-25"
              loading="lazy"
            />
          </a>
        </div>

        <div class="rounded-2xl border border-slate-200/70 bg-white shadow-xl shadow-slate-200/50
                    backdrop-blur-sm
                    dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/30">
          <div class="border-b border-slate-200/70 px-6 py-4 sm:px-8 dark:border-slate-800">
            <h1 class="text-lg font-semibold tracking-tight text-slate-800 dark:text-slate-100">
              Sign in to your account
            </h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
              Welcome back! Please enter your details.
            </p>
          </div>

          <div class="px-6 py-6 sm:px-8">
            {{ $slot }}
          </div>

         
        </div>

        <!-- Footer -->
        <p class="mt-6 text-center text-xs text-slate-400 dark:text-slate-500">
          &copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.
        </p>
      </div>
    </div>
  </body>
</html>
