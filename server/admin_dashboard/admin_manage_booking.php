<?php
$conn = oci_connect('c##aman', 'root', '//localhost:1521/XE');
if (!$conn) {
  die("Connection failed: " . oci_error());
}

// Deleting a booking
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $delete_query = "DELETE FROM new_bookings WHERE id = :id";
  $delete_stmt = oci_parse($conn, $delete_query);
  oci_bind_by_name($delete_stmt, ":id", $delete_id);
  if (oci_execute($delete_stmt)) {
    header("Location: admin_manage_booking.php?msg=deleted");
    exit();
  } else {
    $e = oci_error($delete_stmt);
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center'>Error deleting record: " . htmlspecialchars($e['message']) . "</div>";
  }
}

$query = "SELECT * FROM new_bookings ORDER BY id DESC";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Bookings</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100 h-screen">

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
        <a href="#logout" class="flex items-center p-2 rounded hover:bg-green-700"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
      </div>
    </div>

    <!-- -------------sidebar end------------------------------------------- -->
  <!-- ✅ Main Content -->
  <div class="flex-1 ml-64 p-6">
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') : ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center" role="alert">
        Booking deleted successfully!
      </div>
    <?php endif; ?>

    <h1 class="text-3xl font-bold mb-6">Manage Bookings</h1>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
      <table class="min-w-full text-sm">
      <thead>
  <tr>
    <th class="py-3 px-6 bg-green-600 text-white">ID</th>
    <th class="py-3 px-6 bg-green-600 text-white">Customer Name</th>
    <th class="py-3 px-6 bg-green-600 text-white">Customer Email</th>
    <th class="py-3 px-6 bg-green-600 text-white">Contact Phone</th>
    <th class="py-3 px-6 bg-green-600 text-white">Pick Date</th>
    <th class="py-3 px-6 bg-green-600 text-white">Pick Address</th>
    <th class="py-3 px-6 bg-green-600 text-white">Destination</th>
    <th class="py-3 px-6 bg-green-600 text-white">Booking Date</th> <!-- ✅ New Column -->
    <th class="py-3 px-6 bg-green-600 text-white">Status</th>       <!-- ✅ New Column -->
    <th class="py-3 px-6 bg-green-600 text-white">Actions</th>
  </tr>
</thead>

<tbody>
  <?php while ($row = oci_fetch_assoc($stmt)) : ?>
    <tr class="border-b">
      <td class="py-3 px-6 text-center"><?php echo $row['ID']; ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['CUSTOMER_NAME']); ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['CUSTOMER_EMAIL']); ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['CONTACT_PHONE']); ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['PICK_DATE']))); ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['PICK_ADDRESS']); ?></td>
      <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['DESTINATION']); ?></td>

      <td class="py-3 px-6 text-center">
        <?php echo htmlspecialchars(date('Y-m-d', strtotime($row['BOOKING_DATE']))); ?>
      </td> <!-- ✅ New Booking Date -->

      <td class="py-3 px-6 text-center">
        <?php echo htmlspecialchars($row['STATUS']); ?>
      </td> <!-- ✅ New Status -->

      <td class="py-3 px-6 text-center">
        <a href="admin_manage_booking.php?delete_id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this booking?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-trash-alt"></i> Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</tbody>

      </table>
    </div>
  </div>

</body>
</html>
