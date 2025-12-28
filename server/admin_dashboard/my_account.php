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
    header("Location: my_account.php?msg=deleted");
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account - Booking Details</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 w-full">

  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Booking Details</h1>

    <?php while ($row = oci_fetch_assoc($stmt)) : ?>
      <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">#<?php echo $row['ID']; ?> Details</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
          <div>
            <strong>Request No.:</strong> <?php echo $row['ID']; ?>
          </div>
          <div>
            <strong>Request Date:</strong> <?php echo htmlspecialchars(date('Y-m-d', strtotime($row['BOOKING_DATE']))); ?>
          </div>
          <div>
            <strong>Name:</strong> <?php echo htmlspecialchars($row['CUSTOMER_NAME']); ?>
          </div>
          <div>
            <strong>Mobile No.:</strong> <?php echo htmlspecialchars($row['CONTACT_PHONE']); ?>
          </div>
          <div>
            <strong>Email ID:</strong> <?php echo htmlspecialchars($row['CUSTOMER_EMAIL']); ?>
          </div>
          <div>
            <strong>Location Shift From:</strong> <?php echo htmlspecialchars($row['PICK_ADDRESS']); ?>
          </div>
          <div>
            <strong>Location Shift To:</strong> <?php echo htmlspecialchars($row['DESTINATION']); ?>
          </div>
          <div>
            <strong>Date of Shifting:</strong> <?php echo htmlspecialchars(date('Y-m-d', strtotime($row['PICK_DATE']))); ?>
          </div>
          <div>
            <strong>Status:</strong>
            <span class="px-2 py-1 rounded <?php echo $row['STATUS'] == 'Confirmed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800'; ?>">
              <?php echo htmlspecialchars($row['STATUS']); ?>
            </span>
          </div>
          <div>
            <a href="my_account.php?delete_id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this booking?')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
              Delete
            </a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>