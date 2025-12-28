<?php
$conn = oci_connect('c##sandeep', 'root', "//localhost:1521/XE");

// Delete Shipment Logic
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM shipments WHERE TRACKING_ID = '$delete_id'";
    $delete_stid = oci_parse($conn, $delete_query);
    oci_execute($delete_stid);
    // Page reload after delete
    header("Location: view_shipments.php");
    exit();
}

// Fetch all shipments
$query = "SELECT * FROM shipments";
$stid = oci_parse($conn, $query);
oci_execute($stid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Shipments - Packers & Movers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">View Shipments</h1>
        </div>
    </header>

    <!-- Shipment List Section -->
    <main class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">All Shipments</h2>

            <!-- Shipments Table -->
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Tracking ID</th>
                        <th class="px-4 py-2 text-left">Origin</th>
                        <th class="px-4 py-2 text-left">Destination</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Payment Amount (₹)</th>
                        <th class="px-4 py-2 text-left">Payment Status</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = oci_fetch_assoc($stid)) {
                        echo "<tr class='border-b hover:bg-gray-100'>";
                        echo "<td class='px-4 py-2'>" . htmlspecialchars($row['TRACKING_ID']) . "</td>";
                        echo "<td class='px-4 py-2'>" . htmlspecialchars($row['ORIGIN']) . "</td>";
                        echo "<td class='px-4 py-2'>" . htmlspecialchars($row['DESTINATION']) . "</td>";

                        // Status Button (Color Change)
                        $status = htmlspecialchars($row['STATUS']);
                        $statusClass = ($status == 'Delivered') ? 'bg-green-500' : 'bg-blue-500';
                        echo "<td class='px-4 py-2'>
                                <span class='text-white py-1 px-3 rounded-full text-sm font-semibold $statusClass'>
                                    $status
                                </span>
                              </td>";

                        // Payment Amount
                        $payment_amount = htmlspecialchars($row['PAYMENT_AMOUNT']);
                        echo "<td class='px-4 py-2'>₹" . ($payment_amount ? number_format($payment_amount, 2) : '0.00') . "</td>";

                        // Payment Status (Paid / Pending)
                        $payment_status = htmlspecialchars($row['PAYMENT_STATUS']);
                        $paymentStatusClass = ($payment_status == 'Paid') ? 'text-green-600 font-bold' : 'text-red-600 font-bold';
                        echo "<td class='px-4 py-2'>
                                <span class='$paymentStatusClass'>
                                    " . ($payment_status ? $payment_status : 'Pending') . "
                                </span>
                              </td>";

                        // Action Buttons (Delete)
                        echo "<td class='px-4 py-2'>
                                <a href='view_shipments.php?delete_id=" . htmlspecialchars($row['TRACKING_ID']) . "' 
                                   onclick='return confirm(\"Are you sure you want to delete this shipment?\")' 
                                   class='bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-semibold'>
                                    Delete
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
