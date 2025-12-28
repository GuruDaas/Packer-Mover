<?php
// Load service requests
$file = "service-requests.json";
$serviceRequests = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$approvedRequests = array_filter($serviceRequests, function($request) {
    return $request["status"] == "Approved";
});
$rejectedRequests = array_filter($serviceRequests, function($request) {
    return $request["status"] == "Rejected";
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Approved/Rejected Service Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <header class="bg-red-600 text-white py-6">
    <div class="container mx-auto text-center">
      <h1 class="text-3xl font-bold">Admin Panel - Approved Requests</h1>
    </div>
  </header>

  <main class="container mx-auto py-10 px-6">
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-2xl font-bold mb-6">Approved Requests</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 border">Name</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Service</th>
              <th class="px-4 py-2 border">Description</th>
              <th class="px-4 py-2 border">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($approvedRequests as $index => $request): ?>
              <tr>
                <td class="px-4 py-2 border"><?php echo $request["name"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["email"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["service"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["description"]; ?></td>
                <td class="px-4 py-2 border text-green-500"><?php echo $request["status"]; ?></td> <!-- Green for approved -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <h2 class="text-2xl font-bold mt-8 mb-6">Rejected Requests</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 border">Name</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Service</th>
              <th class="px-4 py-2 border">Description</th>
              <th class="px-4 py-2 border">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rejectedRequests as $index => $request): ?>
              <tr>
                <td class="px-4 py-2 border"><?php echo $request["name"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["email"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["service"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["description"]; ?></td>
                <td class="px-4 py-2 border text-red-500"><?php echo $request["status"]; ?></td> <!-- Red for rejected -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>
</html>
