<?php
$conn = oci_connect('c##aman', 'root', '//localhost:1521/XE');
if (!$conn) {
  die("Connection failed: " . oci_error());
}

// Deleting a staff
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $delete_query = "DELETE FROM staff WHERE staff_id = :id";
  $delete_stmt = oci_parse($conn, $delete_query);
  oci_bind_by_name($delete_stmt, ":id", $delete_id);
  if (oci_execute($delete_stmt)) {
    header("Location: staff.php?msg=deleted");
    exit();
  } else {
    $e = oci_error($delete_stmt);
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center'>Error deleting record: " . htmlspecialchars($e['message']) . "</div>";
  }
}

$query = "SELECT * FROM staff ORDER BY staff_id DESC";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Staff</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100">

  <div class="flex flex-col items-center justify-center w-full min-h-screen p-6">
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') : ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center" role="alert">
        Staff deleted successfully!
      </div>
    <?php endif; ?>

    <h1 class="text-3xl font-bold mb-6 text-center">Manage Staff</h1>

    <a href="add_staff.php" class="mb-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
      + Add New Staff
    </a>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md w-full max-w-6xl">
      <table class="min-w-full text-sm">
        <thead>
          <tr>
            <th class="py-3 px-6 bg-blue-600 text-white">ID</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Name</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Email</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Phone</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Role</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Joining Date</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Status</th>
            <th class="py-3 px-6 bg-blue-600 text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = oci_fetch_assoc($stmt)) : ?>
            <tr class="border-b">
              <td class="py-3 px-6 text-center"><?php echo $row['STAFF_ID']; ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['NAME']); ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['EMAIL']); ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['PHONE']); ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['ROLE']); ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['JOINING_DATE']))); ?></td>
              <td class="py-3 px-6 text-center"><?php echo htmlspecialchars($row['STATUS']); ?></td>
              <td class="py-3 px-6 text-center">
                <a href="edit_staff.php?id=<?php echo $row['STAFF_ID']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                <a href="staff.php?delete_id=<?php echo $row['STAFF_ID']; ?>" onclick="return confirm('Are you sure you want to delete this staff?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
