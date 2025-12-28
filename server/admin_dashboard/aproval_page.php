<?php
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");

if (!$conn) {
    die("Connection failed: " . oci_error());
}

// Fetch Approved Shipments
$query = "SELECT * FROM new_bookings WHERE status = 'Approved'";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Approved Shipments</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Main Container -->
<div class="container mx-auto mt-10">
  <h2 class="text-3xl font-bold mb-6 text-green-700">Approved Shipments</h2>

  <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-green-500 text-white">
      <tr>
        <th class="py-3 px-6 text-left">Booking ID</th>
        <th class="py-3 px-6 text-left">Customer Name</th>
        <th class="py-3 px-6 text-left">Pick Address</th>
        <th class="py-3 px-6 text-left">Destination</th>
        <th class="py-3 px-6 text-left">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = oci_fetch_assoc($stmt)): ?>
        <tr class="border-b hover:bg-gray-100">
          <td class="py-3 px-6"><?= htmlspecialchars($row['BOOKING_ID']) ?></td>
          <td class="py-3 px-6"><?= htmlspecialchars($row['CUSTOMER_NAME']) ?></td>
          <td class="py-3 px-6"><?= htmlspecialchars($row['PICK_ADDRESS']) ?></td>
          <td class="py-3 px-6"><?= htmlspecialchars($row['DESTINATION']) ?></td>
          <td class="py-3 px-6 font-semibold text-green-600"><?= htmlspecialchars($row['STATUS']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="mt-6">
    <a href="shipments.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
      Back to Pending Shipments
    </a>
  </div>
</div>

<?php
oci_free_statement($stmt);
oci_close($conn);
?>
</body>
</html>
