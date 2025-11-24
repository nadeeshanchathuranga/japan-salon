<h2>Reservation Confirmation</h2>

<p>Hello {{ $reservation->name }},</p>

<p>Thank you for booking with Cherish Fukuoka!</p>

<h3>Reservation Details:</h3>
<ul>
    <li><strong>Date:</strong> {{ $reservation->date }}</li>
    <li><strong>Time:</strong> {{ $reservation->time }}</li>
    <li><strong>Service:</strong> {{ $reservation->service ? $reservation->service->title : 'N/A' }}</li>
    <li><strong>Phone:</strong> {{ $reservation->phone }}</li>
    <li><strong>Special Requests:</strong> {{ $reservation->other_request ?? 'None' }}</li>
</ul>

<p>We look forward to seeing you!</p>

<p>Best regards,<br>
<strong>Cherish Fukuoka Team</strong></p>
