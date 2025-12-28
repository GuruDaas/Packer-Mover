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

// Simulate cancellation process (replace with database update query in real implementation)
$cancellationMessage = "Booking ID $bookingId has been canceled successfully.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cancel Booking</title>
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
    <h1 class="text-xl font-bold">Cancel Booking</h1>
    <a href="my_bookings.php" class="bg-gray-200 text-blue-700 hover:bg-gray-300 px-4 py-2 rounded">Back to My Bookings</a>
  </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-6 py-10">
  <div class="bg-white p-6 shadow hover-effect rounded-lg">
    <h2 class="text-2xl font-bold text-red-600 mb-4">Cancellation Successful</h2>
    <p class="text-gray-600"><?= htmlspecialchars($cancellationMessage) ?></p>
  </div>

  <div class="mt-6">
    <a href="my_bookings.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Back</a>
  </div>
</main>

</body>
</html>