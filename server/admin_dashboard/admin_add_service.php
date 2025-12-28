<!-- service_form.php -->
<?php
$successMessage = "";  // To store success message

// Form process code
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $service = htmlspecialchars($_POST["service"]);
    $description = htmlspecialchars($_POST["description"]);

    // Save to JSON file (can be replaced with DB later)
    $file = "service-requests.json";
    $currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $currentData[] = [
        "name" => $name,
        "email" => $email,
        "service" => $service,
        "description" => $description,
        "status" => "Pending"
    ];
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));

    // Set success message
    $successMessage = "Your service request has been submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Header -->
  <header class="bg-red-600 text-white py-6">
    <div class="container mx-auto text-center">
      <h1 class="text-3xl font-bold">Service Request Form</h1>
      <p class="text-sm mt-2">Submit your service request for approval</p>
    </div>
  </header>

  <!-- Form Section -->
  <main class="container mx-auto py-10 px-6">
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-2xl font-bold mb-6">Submit Your Service Request</h2>

      <!-- Success Message -->
      <?php if ($successMessage): ?>
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
          <?php echo $successMessage; ?>
        </div>
      <?php endif; ?>

      <!-- Form -->
      <form action="" method="POST">
        <!-- Name -->
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-semibold">Your Name</label>
          <input type="text" id="name" name="name" required class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-semibold">Your Email</label>
          <input type="email" id="email" name="email" required class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <!-- Service Type -->
        <div class="mb-4">
          <label for="service" class="block text-gray-700 font-semibold">Service Type</label>
          <select id="service" name="service" required class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
            <option value="">Select a Service</option>
            <option value="Household Shifting">Household Shifting</option>
            <option value="Office Shifting">Office Shifting</option>
            <option value="Car/Bike Transportation">Car/Bike Transportation</option>
            <option value="Storage & Warehousing">Storage & Warehousing</option>
            <option value="International Shifting">International Shifting</option>
            <option value="Transit Insurance">Transit Insurance</option>
          </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-semibold">Description</label>
          <textarea id="description" name="description" rows="4" required class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Provide additional details about your service request"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-8">
          <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
            Submit
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto text-center">
      <p>&copy; <?php echo date("Y"); ?> Packers & Movers. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
