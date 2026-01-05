# AI Coding Agent Guide

This repository is a Laravel-based salon CMS with a single-page public frontend and an authenticated admin area. The most active user-facing view is `resources/views/frontend/index.blade.php`, which drives reservations, services, testimonials, and several client-side behaviors.

## Big Picture
- Routing: See `routes/web.php`.
  - Public: `GET /` → `App\Http\Controllers\Frontend\LoadController@index`.
  - Reservations: `POST /reservation-store` → `LoadController@reservationStore` (named `frontend.reservations.store`).
  - Availability: `GET /reservations-by-date` → `LoadController@getReservationsByDate` (JSON for time blocking).
- Models: `app/Models/{Service, Testimonial, Reservation}.php`.
- Mail: Confirmation and admin notification in `app/Mail/{ReservationConfirmation, ReservationNotification}.php` using `config('app.admin_email')`.
- Frontend View: `resources/views/frontend/index.blade.php` renders services, testimonials, and the reservation form with JS validation and time-slot disabling.

## Reservation Logic (Important)
- Timezone: Always use Asia/Tokyo; server-side validation relies on Carbon in that TZ.
- Business hours: 10:30–18:30; slots are 30-min increments; max 2 reservations per slot.
- Closed days: Monday (1) and Thursday (4).
- Backend API: `LoadController@getReservationsByDate` now enforces three rules and returns:
  - `reservations`: map `{ "HH:MM": count }`.
  - `proximityBlocks`: array of minute ranges `{ start, end }` (clamped to business hours).
- Blocking rules applied (and expected by the frontend):
  - Continuous 30-min chains (within ~1.5h): block 1 hour starting at the last-overlap point (second-to-last in the chain).
  - Same time reserved twice: block the previous and next 1 hour around that time.
- Frontend uses these to disable `<select id="timeSelect">` options in `index.blade.php`.

## Developer Workflows
- Install deps:
  - PHP: `composer install`
  - JS/CSS: `npm install`
- Run dev:
  - Laravel: `php artisan serve`
  - Vite: `npm run dev` (Tailwind + assets; see `vite.config.js` and `tailwind.config.js`).
- Database:
  - Migrations: `php artisan migrate`
  - Seeders (includes admin): check `database/seeders/{DatabaseSeeder, AdminUserSeeder}.php`.
- Testing: Use `phpunit` via `vendor/bin/phpunit` or `php artisan test`. See `tests/`.

## Project Conventions & Patterns
- Views: Blade templates under `resources/views/**`. The public page is `frontend/index.blade.php` and contains JS for validation, Flatpickr config, and OwlCarousel.
- Routes: Named routes for public actions (e.g., `frontend.reservations.store`).
- Validation: Done server-side in `LoadController@reservationStore` (date format `Y-m-d\TH:i`, slot minutes 00 or 30, closed days, not past, business hours, and per-slot capacity with `lockForUpdate()`).
- Assets: Public assets in `public/` and `resources/` (Vite-managed). Use `asset()`/`url()` in Blade.
- Storage: Uploaded images served from `public/storage/...` and custom `public/uploads/...`.

## Integration Points
- Emails: Customer confirmation and admin notification are sent after reservation creation. Ensure `mail` settings and `app.admin_email` are configured.
- Availability API: Any changes to slot rules should update `LoadController@getReservationsByDate` and keep the response shape (`reservations`, `proximityBlocks`) stable for the frontend.

## Examples
- Availability fetch in the frontend:
  - `fetch('/reservations-by-date?date=YYYY-MM-DD')` → `{ reservations: {"15:00": 2}, proximityBlocks: [{start: 690, end: 810}] }`.
- Server-side reservation creation enforces 30-min steps and capacity, then sends 2 emails.

Keep changes minimal and consistent with existing style; prefer backend enforcement with clear JSON for frontend blocking. Document any rule updates in this file and ensure the frontend consumes the same API shape.
