<?php
$conn = oci_connect('c##sandeep', 'root', "//localhost:1521/XE"); 

$message = ""; // Message ko initialize kara

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_id = $_POST['tracking_id'];
    $status = $_POST['status'];
    $payment_amount = $_POST['payment_amount'];
    $payment_status = $_POST['payment_status'];

    $sql = "UPDATE shipments 
            SET STATUS = '$status', 
                PAYMENT_AMOUNT = '$payment_amount', 
                PAYMENT_STATUS = '$payment_status' 
            WHERE TRACKING_ID = '$tracking_id'";
    
    $stid = oci_parse($conn, $sql);
    $result = oci_execute($stid);

    if ($result) {
        $message = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4'>
                        Shipment status and payment updated successfully!
                    </div>";
    } else {
        $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4'>
                        Error in updating shipment details!
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Shipment Status - Packers & Movers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Update Shipment Status & Payment</h1>
        </div>
    </header>

    <main class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Update Shipment Details</h2>

            <!-- Success ya Error Message Show -->
            <?php if (!empty($message)) echo $message; ?>

            <form method="POST" action="update_shipment_status.php">
                <div class="mb-4">
                    <label for="tracking_id" class="block text-gray-700">Tracking ID</label>
                    <input type="text" id="tracking_id" name="tracking_id" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="In Transit">In Transit</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>

                <!-- Payment Amount Field -->
                <div class="mb-4">
                    <label for="payment_amount" class="block text-gray-700">Payment Amount (₹)</label>
                    <input type="number" step="0.01" id="payment_amount" name="payment_amount" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <!-- Payment Status Field -->
                <div class="mb-4">
                    <label for="payment_status" class="block text-gray-700">Payment Status</label>
                    <select id="payment_status" name="payment_status" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">Update Details</button>
            </form>
        </div>
    </main>
</body>
</html>
