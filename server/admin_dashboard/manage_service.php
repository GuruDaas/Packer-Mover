<?php
// Load service requests
$file = "service-requests.json";
$serviceRequests = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Handle POST requests for updating or deleting the service request status
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["status"])) {  // For updating status
        foreach ($serviceRequests as &$request) {
            if ($request["email"] === $_POST["email"]) {
                $request["status"] = $_POST["status"];
                break;
            }
        }
    } elseif (isset($_POST["delete"])) {  // For deleting a request
        $serviceRequests = array_filter($serviceRequests, function($request) {
            return $request["email"] !== $_POST["email"];
        });
    }

    file_put_contents($file, json_encode(array_values($serviceRequests), JSON_PRETTY_PRINT));

    // Redirect to the same page to reflect the updated status or deletion
    echo json_encode(["success" => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Approval - Service Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <header class="bg-red-600 text-white py-6">
    <div class="container mx-auto text-center">
      <h1 class="text-3xl font-bold">Admin Panel - Service Requests</h1>
    </div>
  </header>

  <main class="container mx-auto py-10 px-6">
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-2xl font-bold mb-6">Service Requests</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 border">Name</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Service</th>
              <th class="px-4 py-2 border">Description</th>
              <th class="px-4 py-2 border">Status</th>
              <th class="px-4 py-2 border">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($serviceRequests as $index => $request): ?>
              <tr id="row-<?php echo $index; ?>">
                <td class="px-4 py-2 border"><?php echo $request["name"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["email"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["service"]; ?></td>
                <td class="px-4 py-2 border"><?php echo $request["description"]; ?></td>
                <td class="px-4 py-2 border" id="status-<?php echo $index; ?>"><?php echo $request["status"]; ?></td>
                <td class="px-4 py-2 border">
                  <button onclick="updateStatus('<?php echo $request['email']; ?>', 'Approved', <?php echo $index; ?>)" class="bg-green-500 text-white px-4 py-1 rounded">Approve</button>
                  <button onclick="updateStatus('<?php echo $request['email']; ?>', 'Rejected', <?php echo $index; ?>)" class="bg-red-500 text-white px-4 py-1 rounded">Reject</button>
                  <button onclick="deleteRequest('<?php echo $request['email']; ?>', <?php echo $index; ?>)" class="bg-yellow-500 text-white px-4 py-1 rounded">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="text-center mt-8">
        <a href="./admin_approval_service.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
          View Approved Requests
        </a>
      </div>
    </div>
  </main>

<script>
function updateStatus(email, status, rowIndex) {
    fetch('./manage_service.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}&status=${encodeURIComponent(status)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`status-${rowIndex}`).innerText = status;
            alert('Status updated successfully!');
        } else {
            alert('Failed to update status!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred!');
    });
}

function deleteRequest(email, rowIndex) {
    if (confirm("Are you sure you want to delete this service request?")) {
        fetch('./manage_service.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `email=${encodeURIComponent(email)}&delete=true`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`row-${rowIndex}`).remove();
                alert('Service request deleted successfully!');
            } else {
                alert('Failed to delete the request!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred!');
        });
    }
}
</script>

</body>
</html>
