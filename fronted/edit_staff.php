<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = oci_connect('c##aman', 'root', '//localhost:1521/XE');
if (!$conn) {
    die("Connection failed: " . oci_error());
}

if (isset($_POST['add_staff'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $joining_date = $_POST['joining_date'];
    $status = $_POST['status'];

    $query = "INSERT INTO staff (name, email, phone, role, joining_date, status)
              VALUES (:name, :email, :phone, :role, TO_DATE(:joining_date, 'YYYY-MM-DD'), :status)";
    
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':name', $name);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':phone', $phone);
    oci_bind_by_name($stmt, ':role', $role);
    oci_bind_by_name($stmt, ':joining_date', $joining_date);
    oci_bind_by_name($stmt, ':status', $status);

    if (oci_execute($stmt)) {
        header("Location: staff.php?msg=added");
        exit();
    } else {
        $e = oci_error($stmt);
        echo "<div style='color: red;'>Error inserting staff: " . htmlspecialchars($e['message']) . "</div>";
    }
}
?>

<!-- HTML Form -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="post" class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Add New Staff</h1>

        <label class="block mb-2">Name</label>
        <input type="text" name="name" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Email</label>
        <input type="email" name="email" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Phone</label>
        <input type="text" name="phone" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Role</label>
        <input type="text" name="role" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Joining Date</label>
        <input type="date" name="joining_date" required class="w-full p-2 border rounded mb-4">

        <label class="block mb-2">Status</label>
        <select name="status" required class="w-full p-2 border rounded mb-6">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>

        <button type="submit" name="add_staff" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-full">
            Add Staff
        </button>
    </form>

</body>
</html>
