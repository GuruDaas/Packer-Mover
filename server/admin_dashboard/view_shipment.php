<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Oracle Database Connection
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");

if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . $e['message']);
}

// Query for approved shipments
$approved_query = "SELECT * FROM shipments WHERE status = 'approved'";
$approved_stid = oci_parse($conn, $approved_query);
oci_execute($approved_stid);

// Query for rejected shipments
$rejected_query = "SELECT * FROM shipments WHERE status = 'rejected'";
$rejected_stid = oci_parse($conn, $rejected_query);
oci_execute($rejected_stid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Shipments | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">View Shipments</h1>

        <!-- Approved Shipments -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-12">
            <h2 class="text-2xl font-semibold text-green-600 mb-4">Approved Shipments</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-green-100">
                            <th class="border border-gray-300 px-4 py-2">Booking ID</th>
                            <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                            <th class="border border-gray-300 px-4 py-2">Customer Email</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = oci_fetch_assoc($approved_stid)): ?>
                            <tr class="hover:bg-green-50 transition-all duration-300">
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['BOOKING_ID']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['CUSTOMER_NAME']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['CUSTOMER_EMAIL']; ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-green-600 font-bold"><?php echo ucfirst($row['STATUS']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Rejected Shipments -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-semibold text-red-600 mb-4">Rejected Shipments</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-red-100">
                            <th class="border border-gray-300 px-4 py-2">Booking ID</th>
                            <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                            <th class="border border-gray-300 px-4 py-2">Customer Email</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = oci_fetch_assoc($rejected_stid)): ?>
                            <tr class="hover:bg-red-50 transition-all duration-300">
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['BOOKING_ID']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['CUSTOMER_NAME']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $row['CUSTOMER_EMAIL']; ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-red-600 font-bold"><?php echo ucfirst($row['STATUS']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>

<?php
// Close the connection
oci_free_statement($approved_stid);
oci_free_statement($rejected_stid);
oci_close($conn);
?>
