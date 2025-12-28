<!-- <?php
// Oracle DB connection
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");

if (!$conn) {
  $e = oci_error();
  die("Connection failed: " . $e['message']);
}

// Check if ID is set in URL
if (isset($_GET['id'])) {
  $id = intval($_GET['id']); // Safety ke liye int me convert kar diya

  // Delete query
  $query = "DELETE FROM new_bookings WHERE id = :id";
  $stmt = oci_parse($conn, $query);
  oci_bind_by_name($stmt, ":id", $id);

  if (oci_execute($stmt)) {
    // Delete successful
    header("Location: manage_booking.php?msg=deleted");
    exit();
  } else {
    // Delete failed
    echo "Error deleting booking.";
  }
} else {
  echo "Invalid request.";
}

oci_close($conn);
?>
 -->
