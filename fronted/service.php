<?php
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $service = htmlspecialchars($_POST["service"]);
    $description = htmlspecialchars($_POST["description"]);

    $file = "service-requests.json";
    $currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $currentData[] = [
        "name" => $name,
        "email" => $email,
        "service" => $service,
        "description" => $description,
        "status" => "Pending",
        "date" => date('Y-m-d H:i:s')
    ];
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));
    $successMessage = "Your service request has been submitted successfully!";
}
?>
<?php include 'includes/header.php'; ?>

<div class="bg-gray-900 text-white py-16 text-center">
    <h1 class="text-4xl font-bold">Service Request</h1>
    <p class="text-gray-400 mt-2">Let us know how we can help you move.</p>
</div>

<div class="container mx-auto py-12 px-6 max-w-4xl">
    <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
      
      <?php if ($successMessage): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded shadow-sm">
          <p class="font-bold">Success</p>
          <p><?= $successMessage; ?></p>
        </div>
      <?php endif; ?>

      <form action="" method="POST" class="grid md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Request Details</h2>
        </div>

        <div>
          <label class="block text-gray-700 font-bold mb-2">Your Name</label>
          <input type="text" name="name" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
        </div>

        <div>
          <label class="block text-gray-700 font-bold mb-2">Your Email</label>
          <input type="email" name="email" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
        </div>

        <div class="md:col-span-2">
          <label class="block text-gray-700 font-bold mb-2">Service Type</label>
          <select name="service" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
            <option value="">Select a Service</option>
            <option value="Household Shifting">Household Shifting</option>
            <option value="Office Shifting">Office Shifting</option>
            <option value="Car/Bike Transportation">Car/Bike Transportation</option>
            <option value="Storage & Warehousing">Storage & Warehousing</option>
            <option value="International Shifting">International Shifting</option>
            <option value="Transit Insurance">Transit Insurance</option>
          </select>
        </div>

        <div class="md:col-span-2">
          <label class="block text-gray-700 font-bold mb-2">Description</label>
          <textarea name="description" rows="5" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50" placeholder="Please provide details about pickup/drop locations and items..."></textarea>
        </div>

        <div class="md:col-span-2 text-center mt-4">
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-10 rounded-full shadow-lg transition transform hover:scale-105">
            Submit Request
          </button>
        </div>
      </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
