<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
$email = $_SESSION['email'];
$bookingId = $_GET['id'] ?? null; // Get booking ID from URL

if (!$bookingId) {
    echo "Invalid Booking ID.";
    exit();
}

// Dummy booking details for demonstration
// Replace this with database queries to fetch booking details based on $bookingId
$bookingDetails = [
    "id" => $bookingId,
    "pickup_address" => "New York",
    "delivery_address" => "Los Angeles",
    "moving_date" => "2025-05-01",
    "items" => "5 Boxes, 2 Furniture",
    "status" => "Upcoming",
    "cost" => "$2500",
    "driver_name" => "John Doe",
    "contact" => "+1 234 567 890",
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hover-effect {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-effect:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Header -->
<header class="bg-blue-700 text-white py-4 shadow">
  <div class="container mx-auto px-6 flex justify-between items-center">
    <h1 class="text-xl font-bold">Booking Details</h1>
    <a href="my_bookings.php" class="bg-gray-200 text-blue-700 hover:bg-gray-300 px-4 py-2 rounded">Back to My Bookings</a>
  </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-6 py-10">
  <div class="bg-white p-6 shadow hover-effect rounded-lg">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Booking ID: <?= htmlspecialchars($bookingDetails['id']) ?></h2>
    <p><strong>Pickup Address:</strong> <?= htmlspecialchars($bookingDetails['pickup_address']) ?></p>
    <p><strong>Delivery Address:</strong> <?= htmlspecialchars($bookingDetails['delivery_address']) ?></p>
    <p><strong>Moving Date:</strong> <?= htmlspecialchars($bookingDetails['moving_date']) ?></p>
    <p><strong>Items:</strong> <?= htmlspecialchars($bookingDetails['items']) ?></p>
    <p><strong>Status:</strong> <span class="text-blue-600 font-semibold"><?= htmlspecialchars($bookingDetails['status']) ?></span></p>
    <p><strong>Cost:</strong> <?= htmlspecialchars($bookingDetails['cost']) ?></p>
    <p><strong>Driver Name:</strong> <?= htmlspecialchars($bookingDetails['driver_name']) ?></p>
    <p><strong>Contact:</strong> <?= htmlspecialchars($bookingDetails['contact']) ?></p>
  </div>

  <div class="mt-6">
    <a href="my_bookings.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Back</a>
  </div>
</main>

</body>
</html>