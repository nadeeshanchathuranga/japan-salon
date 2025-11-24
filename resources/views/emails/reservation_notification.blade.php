<h2>New Reservation</h2>

<p>A new reservation has been made.</p>

<h3>Customer Details:</h3>
<ul>
    <li><strong>Name:</strong> {{ $reservation->name }}</li>
    <li><strong>Email:</strong> {{ $reservation->email }}</li>
    <li><strong>Phone:</strong> {{ $reservation->phone }}</li>
    <li><strong>Date:</strong> {{ $reservation->date }}</li>
    <li><strong>Time:</strong> {{ $reservation->time }}</li>
    <li><strong>Service:</strong> {{ $reservation->service ? $reservation->service->title : 'N/A' }}</li>
    <li><strong>Special Requests:</strong> {{ $reservation->other_request ?? 'None' }}</li>
</ul>
