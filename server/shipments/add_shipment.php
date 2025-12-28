<?php
$conn = oci_connect('c##sandeep', 'root', "//localhost:1521/XE"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_id = $_POST['tracking_id'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $status = $_POST['status'];
    $payment_amount = $_POST['payment_amount'];
    $payment_status = $_POST['payment_status'];

    $sql = "INSERT INTO shipments (TRACKING_ID, ORIGIN, DESTINATION, STATUS, PAYMENT_AMOUNT, PAYMENT_STATUS) 
            VALUES ('$tracking_id', '$origin', '$destination', '$status', '$payment_amount', '$payment_status')";
    
    $stid = oci_parse($conn, $sql);
    $result = oci_execute($stid);

    if ($result) {
        echo "<div class='bg-green-200 text-green-800 p-4 rounded mb-4'>Shipment added successfully!</div>";
    } else {
        echo "<div class='bg-red-200 text-red-800 p-4 rounded mb-4'>Error in adding shipment!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shipment - Packers & Movers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Add New Shipment</h1>
        </div>
    </header>

    <main class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Shipment Details</h2>

            <form method="POST" action="add_shipment.php">
                <div class="mb-4">
                    <label for="tracking_id" class="block text-gray-700">Tracking ID</label>
                    <input type="text" id="tracking_id" name="tracking_id" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="origin" class="block text-gray-700">Origin</label>
                    <input type="text" id="origin" name="origin" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="destination" class="block text-gray-700">Destination</label>
                    <input type="text" id="destination" name="destination" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
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

                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">Add Shipment</button>
            </form>

            <!-- View Shipments Button -->
            <a href="view_shipments.php" class="mt-6 block w-56 text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold mx-auto">View All Shipments</a>
        </div>
    </main>
</body>
</html>
