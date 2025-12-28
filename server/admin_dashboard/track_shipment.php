<?php
$conn = oci_connect('c##sandeep', 'root', "//localhost:1521/XE");

$shipment = null; // Initialize karte hai

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tracking_id']) && !empty($_GET['tracking_id'])) {
    $tracking_id = $_GET['tracking_id'];

    $sql = "SELECT * FROM shipments WHERE TRACKING_ID = :tracking_id"; 
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":tracking_id", $tracking_id);
    oci_execute($stid);

    $shipment = oci_fetch_assoc($stid); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment - Packers & Movers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Track Your Shipment</h1>
        </div>
    </header>

    <main class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Enter Tracking ID</h2>
            <form method="GET" action="track_shipment.php">
                <div class="mb-4">
                    <label for="tracking_id" class="block text-gray-700">Tracking ID</label>
                    <input type="text" id="tracking_id" name="tracking_id" required class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">Track Shipment</button>
            </form>

            <?php if ($shipment && is_array($shipment)): ?>
                <div class="mt-10">
                    <h3 class="text-2xl font-bold mb-4">Shipment Details</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 border-b text-left text-gray-700 font-semibold">Field</th>
                                    <th class="py-3 px-6 border-b text-left text-gray-700 font-semibold">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Tracking ID</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['TRACKING_ID']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Origin</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['ORIGIN']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Destination</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['DESTINATION']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Status</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['STATUS']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Pickup Date</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['PICKUP_DATE']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6 border-b font-medium">Created At</td>
                                    <td class="py-3 px-6 border-b"><?php echo htmlspecialchars($shipment['CREATED_AT']); ?></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-6">Updated At</td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($shipment['UPDATED_AT']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif (isset($_GET['tracking_id'])): ?>
                <div class="mt-6 text-red-600 font-semibold">
                    No Shipment Found with this Tracking ID!
                </div>
            <?php endif; ?>

            <!-- View Shipments Button - Bottom Center -->
            <a href="view_shipments.php" class="mt-8 block w-56 text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold mx-auto">View All Shipments</a>
        </div>
    </main>
</body>
</html>
