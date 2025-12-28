<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Packers and Movers Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    .sidebar {
      transition: all 0.3s ease-in-out;
    }
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.open {
        transform: translateX(0);
      }
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
     <!-- Sidebar -->
     <div class="sidebar w-64 bg-green-600 text-white  p-4 fixed inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out">
      <div class="flex items-center mb-6">
        <i class="fas fa-truck-moving text-3xl"></i>
        <h2 class="ml-2 text-xl font-bold">Packers & Movers</h2>
      </div>
      <ul class="space-y-2">
        <li><a href="./admin_dashboard.php" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
        <!-- <li class="flex items-center p-2 rounded hover:bg-green-700"><a href="./my_account.php" class="fas fa-home mr-2">My Account</a></li> -->
        <li>
          <!-- <li><a href="./my_account.php" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-home mr-2"></i>My Account</a></li> -->
      <details class="group">
        <summary class="flex items-center p-2 rounded hover:bg-green-700 cursor-pointer">
          <i class="fas fa-cogs mr-2"></i>Services
          <i class="fas fa-chevron-down ml-auto transform group-open:rotate-180 transition-transform"></i>
        </summary>
        <ul class="ml-6 mt-2 space-y-1">
          <li>
            <a href="./manage_service.php" class="block px-2 py-1 rounded hover:bg-green-700">Manage Services</a>
          </li>
        </ul>
      </details>
    </li>

    <details class="group">
        <summary class="flex items-center p-2 rounded hover:bg-green-700 cursor-pointer">
          <i class="fas fa-cogs mr-2"></i>Booking
          <i class="fas fa-chevron-down ml-auto transform group-open:rotate-180 transition-transform"></i>
        </summary>
        <ul class="ml-6 mt-2 space-y-1">
          <li>
            <!-- <a href="./admin-new-bookings.php" class="block px-2 py-1 rounded hover:bg-green-700">New Booking</a> -->
            <a href="./admin_manage_booking.php" class="block px-2 py-1 rounded hover:bg-green-700">Manage Booking</a>
          </li>
        </ul>
      </details>
        </li>
        <details class="group">
          <summary class="flex items-center p-2 rounded hover:bg-green-700 cursor-pointer">
            <i class="fas fa-cogs mr-2"></i>Shipments
            <i class="fas fa-chevron-down ml-auto transform group-open:rotate-180 transition-transform"></i>
          </summary>
          <ul class="ml-6 mt-2 space-y-1">
            <li>
              <a href="./track_shipment.php" class="block px-2 py-1 rounded hover:bg-green-700">Track Shipment</a>
              <a href="view_shipments.php" class="block px-2 py-1 rounded hover:bg-green-700">View Shipment</a>
            </li>
          </ul>
        </details>    
        <li><a href="#customers" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-users mr-2"></i>Customers</a></li>
       
      <div class="absolute bottom-4">
        <a href="#profile" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-user-circle mr-2"></i>Profile</a>
        <a href="./logout.php" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
      </div>
    </div>

    <!-- -------------sidebar end------------------------------------------- -->

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold mb-4 text-center ml-96">Dashboard</h2>
        <div class="flex space-x-4">
          <i class="fas fa-bell text-xl cursor-pointer text-gray-600 hover:text-green-600" title="Notifications"></i>
          <i class="fas fa-user-circle text-xl cursor-pointer text-gray-600 hover:text-green-600" title="Profile"></i>
        </div>
      </div>

      <main class="flex-1">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:bg-blue-300 flex flex-col items-center">
          <i class="fas fa-pencil-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">3</p>
          <p class="text-base">Total Services</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md hover:bg-yellow-300 flex flex-col items-center">
          <i class="fas fa-pencil-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">0</p>
          <p class="text-base">Total Unread Queries</p>
        </div>
        <div class="bg-pink-200 p-4 rounded-lg shadow-md hover:bg-pink-300 flex flex-col items-center">
          <i class="fas fa-pencil-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">3</p>
          <p class="text-base">Total Read Queries</p>
        </div>

        <!-- Row 2 -->
        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:bg-blue-300 flex flex-col items-center">
          <i class="fas fa-file-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">4</p>
          <p class="text-base">All Bookings</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md hover:bg-yellow-300 flex flex-col items-center">
          <i class="fas fa-file-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">1</p>
          <p class="text-base">Total New Booking</p>
        </div>
        <div class="bg-green-200 p-4 rounded-lg shadow-md hover:bg-green-300 flex flex-col items-center">
          <i class="fas fa-file-alt text-2xl mb-2"></i>
          <p class="text-xl font-bold">2</p>
          <p class="text-base">Total Approved Booking</p>
        </div>

        <!-- Row 3 -->
        <div class="bg-pink-200 p-4 rounded-lg shadow-md hover:bg-pink-300 flex flex-col items-center">
          <i class="fas fa-times text-2xl mb-2"></i>
          <p class="text-xl font-bold">1</p>
          <p class="text-base">Total Rejected Booking</p>
        </div>
        <div class="bg-blue-200 p-4 rounded-lg shadow-md hover:bg-blue-300 flex flex-col items-center">
          <i class="fas fa-cog text-2xl mb-2"></i>
          <p class="text-xl font-bold">7</p>
          <p class="text-base">Total Services</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-lg shadow-md hover:bg-yellow-300 flex flex-col items-center">
          <i class="fas fa-users text-2xl mb-2"></i>
          <p class="text-xl font-bold">3</p>
          <p class="text-base">Total Reg. Users</p>
        </div>
      </div>
    </main>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('open');
    }
  </script>
</body>
</html>