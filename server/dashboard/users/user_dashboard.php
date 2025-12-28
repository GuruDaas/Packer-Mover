<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"></script>
  <style>
    .hover-effect {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-effect:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
    .dark-mode {
      transition: background-color 0.3s, color 0.3s;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 dark-mode">

<!-- Sidebar -->
<div class="flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-blue-700 text-white min-h-screen p-4 sticky top-0">
    <h2 class="text-2xl font-bold mb-6">Packers & Movers</h2>
    <nav class="space-y-4">
      <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">Dashboard</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">New Booking</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">My Bookings</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">Profile</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">Support</a>
    </nav>
    <div class="mt-8">
      <label class="flex items-center">
        <input type="checkbox" id="darkModeToggle" class="mr-2">
        <span>Dark Mode</span>
      </label>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-grow p-6">
    <!-- Sticky Header -->
    <header class="bg-white shadow sticky top-0 z-10 p-4 mb-6 flex justify-between items-center">
      <h1 class="text-xl font-semibold">Dashboard</h1>
      <div class="flex items-center space-x-4">
        <button class="relative">
          <span class="material-icons">notifications</span>
          <!-- Notification Bell -->
          <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs px-1">3</span>
        </button>
        <span>Welcome, <strong><?= htmlspecialchars($email) ?></strong></span>
        <a href="../logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">Logout</a>
      </div>
    </header>

    <!-- Breadcrumbs -->
    <nav class="text-sm text-gray-500 mb-6">
      <a href="#" class="text-blue-600 hover:underline">Home</a> / Dashboard
    </nav>

    <!-- Dashboard Analytics -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
      <div class="bg-white shadow hover-effect p-4 rounded-lg text-center">
        <h2 class="text-2xl font-bold text-blue-700">12</h2>
        <p class="text-gray-600">Total Bookings</p>
      </div>
      <div class="bg-white shadow hover-effect p-4 rounded-lg text-center">
        <h2 class="text-2xl font-bold text-blue-700">5</h2>
        <p class="text-gray-600">Upcoming Dates</p>
      </div>
      <div class="bg-white shadow hover-effect p-4 rounded-lg text-center">
        <h2 class="text-2xl font-bold text-blue-700">1200 KM</h2>
        <p class="text-gray-600">Total Distance</p>
      </div>
      <div class="bg-white shadow hover-effect p-4 rounded-lg text-center">
        <h2 class="text-2xl font-bold text-blue-700">4.5/5</h2>
        <p class="text-gray-600">User Rating</p>
      </div>
    </section>

    <!-- New Booking Section -->
    <section class="bg-white shadow hover-effect p-6 rounded-lg mb-6">
      <h2 class="text-xl font-semibold mb-4 text-blue-700">Make a New Booking</h2>
      <form action="../backend/new_booking.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" name="pickup_address" required placeholder="Pickup Address" class="border p-3 rounded focus:ring-2 focus:ring-blue-500">
        <input type="text" name="delivery_address" required placeholder="Delivery Address" class="border p-3 rounded focus:ring-2 focus:ring-blue-500">
        <input type="date" name="moving_date" required class="border p-3 rounded focus:ring-2 focus:ring-blue-500">
        <input type="text" name="items" required placeholder="Items Description" class="border p-3 rounded focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="col-span-1 md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg shadow hover-effect">Book Now</button>
      </form>
    </section>

    <!-- My Bookings -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Hover and animation effects */
    .hover-effect {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-effect:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }
    .button-hover {
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .button-hover:hover {
      background-color: #2563eb; /* Darker blue */
      transform: scale(1.05);
    }
    .image-hover {
      transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .image-hover:hover {
      transform: scale(1.1);
      opacity: 0.9;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-gray-100 via-blue-50 to-gray-100 text-gray-800">

<!-- Main Content -->
<main class="container mx-auto px-6 py-10 space-y-12">

  <!-- Section Title -->
  <h2 class="text-3xl font-bold text-blue-700 mb-6">Your Bookings</h2>

  <!-- Filter and Search -->
  <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow hover-effect">
    <div>
      <label for="statusFilter" class="block text-sm font-medium text-gray-700">Filter by Status</label>
      <select id="statusFilter" name="statusFilter" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        <option value="all">All</option>
        <option value="upcoming">Upcoming</option>
        <option value="completed">Completed</option>
        <option value="canceled">Canceled</option>
      </select>
    </div>
    <div class="relative">
      <input type="text" placeholder="Search bookings..." class="border-2 border-gray-300 p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500">
      <button class="absolute right-2 top-2 text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Booking Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Example Booking Card -->
    <div class="bg-white p-6 rounded-lg shadow hover-effect">
      <div class="relative">
        <img src="../assets/booking-placeholder.jpg" alt="Booking Image" class="w-full h-40 object-cover rounded-lg image-hover">
        <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">Upcoming</span>
      </div>
      <h3 class="text-xl font-semibold mt-4 text-blue-700">Booking #12345</h3>
      <p class="text-sm text-gray-600">Pickup: New York</p>
      <p class="text-sm text-gray-600">Delivery: Los Angeles</p>
      <p class="text-sm text-gray-600">Date: 2025-05-01</p>
      <p class="text-sm text-gray-600">Items: 5 Boxes, 2 Furniture</p>
      <div class="flex justify-between items-center mt-4">
        <button class="bg-red-500 text-white py-2 px-4 rounded-lg button-hover"><a href=" ./cancle_page.php">Cancel</button>
        <a href="view_detail.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg button-hover">View Details</a>
      </div>
    </div>

    <!-- Repeat similar cards for other bookings -->
    <div class="bg-white p-6 rounded-lg shadow hover-effect">
      <div class="relative">
        <img src="../assets/booking-placeholder.jpg" alt="Booking Image" class="w-full h-40 object-cover rounded-lg image-hover">
        <span class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded">Completed</span>
      </div>
      <h3 class="text-xl font-semibold mt-4 text-blue-700">Booking #12346</h3>
      <p class="text-sm text-gray-600">Pickup: Chicago</p>
      <p class="text-sm text-gray-600">Delivery: Houston</p>
      <p class="text-sm text-gray-600">Date: 2025-04-15</p>
      <p class="text-sm text-gray-600">Items: 3 Furniture, 10 Boxes</p>
      <div class="flex justify-between items-center mt-4">
        <a href="booking-details.php?id=12346" class="bg-blue-600 text-white py-2 px-4 rounded-lg button-hover">View Details</a>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="flex justify-center mt-6">
    <button class="bg-gray-200 text-gray-600 py-2 px-4 rounded-lg hover:bg-gray-300">Previous</button>
    <button class="bg-gray-200 text-gray-600 py-2 px-4 rounded-lg hover:bg-gray-300 ml-2">Next</button>
  </div>

</main>

</body>
</html>

    <!-- Support Section -->
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Support</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <style>
        .hover-effect {
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-effect:hover {
          transform: translateY(-5px);
          box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        .button-hover {
          transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button-hover:hover {
          background-color: #2563eb; /* Darker blue */
          transform: scale(1.05);
        }
      </style>
    </head>
    <body class="bg-gradient-to-r from-gray-100 via-blue-50 to-gray-100 text-gray-800">
    
    <!-- Header -->
   
    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10 space-y-12">
    
      <!-- Section Title -->
      <h2 class="text-3xl font-bold text-blue-700 mb-6">How can we help you?</h2>
    
      <!-- FAQs Section -->
      <section class="bg-white p-6 rounded-lg shadow hover-effect">
        <h3 class="text-2xl font-semibold text-blue-700 mb-4">Frequently Asked Questions</h3>
        <ul class="space-y-4">
          <li class="flex items-start">
            <span class="text-blue-600 mr-2">Q:</span>
            <p>How do I create a new booking?</p>
          </li>
          <li class="flex items-start">
            <span class="text-blue-600 mr-2">Q:</span>
            <p>What payment methods are accepted?</p>
          </li>
          <li class="flex items-start">
            <span class="text-blue-600 mr-2">Q:</span>
            <p>How can I cancel a booking?</p>
          </li>
          <li class="flex items-start">
            <span class="text-blue-600 mr-2">Q:</span>
            <p>How do I track my shipment?</p>
          </li>
        </ul>
        <a href="#" class="text-blue-600 hover:underline block mt-4">View All FAQs</a>
      </section>
    
      <!-- Ticketing System Section -->
      <section class="bg-white p-6 rounded-lg shadow hover-effect">
        <h3 class="text-2xl font-semibold text-blue-700 mb-4">Support Tickets</h3>
        <button class="bg-blue-600 text-white py-2 px-4 mb-4 rounded-lg button-hover">Create a New Ticket</button>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="border-b-2 pb-2">Ticket ID</th>
              <th class="border-b-2 pb-2">Issue</th>
              <th class="border-b-2 pb-2">Status</th>
              <th class="border-b-2 pb-2">Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-b py-2">#12345</td>
              <td class="border-b py-2">Payment Issue</td>
              <td class="border-b py-2 text-green-600">Resolved</td>
              <td class="border-b py-2">2025-04-20</td>
            </tr>
            <tr>
              <td class="border-b py-2">#12346</td>
              <td class="border-b py-2">Cancel Booking</td>
              <td class="border-b py-2 text-yellow-600">In Progress</td>
              <td class="border-b py-2">2025-04-19</td>
            </tr>
          </tbody>
        </table>
      </section>
    
      <!-- Feedback Section -->
      <section class="bg-white p-6 rounded-lg shadow hover-effect">
        <h3 class="text-2xl font-semibold text-blue-700 mb-4">Feedback</h3>
        <form action="../backend/submit_feedback.php" method="POST" class="space-y-4">
          <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <select id="rating" name="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="5">5 - Excellent</option>
              <option value="4">4 - Good</option>
              <option value="3">3 - Average</option>
              <option value="2">2 - Poor</option>
              <option value="1">1 - Terrible</option>
            </select>
          </div>
          <div>
            <label for="feedback" class="block text-sm font-medium text-gray-700">Comments</label>
            <textarea id="feedback" name="feedback" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Share your feedback..."></textarea>
          </div>
          <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg button-hover">Submit Feedback</button>
        </form>
      </section>
    
    </main>
    
    </body>
    </html>
  </div>
</div>

<script>
  // Toggle Dark Mode
  document.getElementById('darkModeToggle').addEventListener('change', function () {
    document.body.classList.toggle('bg-gray-800');
    document.body.classList.toggle('text-white');
    document.body.classList.toggle('dark-mode');
  });
</script>

</body>
</html>