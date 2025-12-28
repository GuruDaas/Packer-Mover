<?php
// Oracle insert logic
$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect POST data
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $from_location = $_POST["from_location"] ?? '';
    $to_location = $_POST["to_location"] ?? '';
    $date = $_POST["date"] ?? '';
    $items = $_POST["items"] ?? '';
    $agree = isset($_POST["agree"]) ? 'Yes' : 'No';

    // Oracle DB connection
    $conn = oci_connect('system', 'root', "//localhost:1521/XE");

    if (!$conn) {
        $errorMsg = "Could not connect to Oracle: " . oci_error();
    } else {
        // Prepare insert statement
        $sql = "INSERT INTO contact_requests (name, email, phone, from_location, to_location, shift_date, items, agree)
                VALUES (:name, :email, :phone, :from_location, :to_location, TO_DATE(:shift_date, 'YYYY-MM-DD'), :items, :agree)";

        $stid = oci_parse($conn, $sql);

        // Bind variables
        oci_bind_by_name($stid, ":name", $name);
        oci_bind_by_name($stid, ":email", $email);
        oci_bind_by_name($stid, ":phone", $phone);
        oci_bind_by_name($stid, ":from_location", $from_location);
        oci_bind_by_name($stid, ":to_location", $to_location);
        oci_bind_by_name($stid, ":shift_date", $date);
        oci_bind_by_name($stid, ":items", $items);
        oci_bind_by_name($stid, ":agree", $agree);

        // Execute
        if (oci_execute($stid)) {
            $successMsg = "Thank you, $name. Your request has been received!";
        } else {
            $errorMsg = "Failed to submit the form.";
        }

        oci_free_statement($stid);
        oci_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Free Moving Quote</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header + Navbar same as before -->
<!-- You can paste header and navbar HTML here -->

<section class="py-10 max-w-7xl mx-auto px-6 lg:px-16">
  <?php if ($successMsg): ?>
    <div class="bg-green-200 text-green-800 p-4 rounded mb-6 font-semibold text-center"><?php echo $successMsg; ?></div>
  <?php elseif ($errorMsg): ?>
    <div class="bg-red-200 text-red-800 p-4 rounded mb-6 font-semibold text-center"><?php echo $errorMsg; ?></div>
  <?php endif; ?>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="space-y-4">
      <img src="https://truewaymovers.com/wp-content/uploads/2022/11/Contact-Us-page-1-min.jpg" class="w-full h-60 object-cover rounded-lg shadow-md" alt="Support"/>
      <img src="https://truewaymovers.com/wp-content/uploads/2022/11/pexels-artem-podrez-5025667-1-min-2048x1152.jpg" class="w-full h-60 object-cover rounded-lg shadow-md" alt="Service"/>
    </div>

    <div class="bg-red-600 text-white p-4 rounded-lg shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">GET A FREE MOVING QUOTE</h2>
      <form action="" method="POST" class="space-y-4">
        <input type="text" name="name" placeholder="Name" class="w-full p-3 rounded-lg text-gray-800" required>
        <input type="email" name="email" placeholder="Email Address" class="w-full p-3 rounded-lg text-gray-800" required>
        <input type="tel" name="phone" placeholder="Phone Number" class="w-full p-3 rounded-lg text-gray-800" required>
        <input type="text" name="from_location" placeholder="Shifting From" class="w-full p-3 rounded-lg text-gray-800" required>
        <input type="text" name="to_location" placeholder="Shifting To" class="w-full p-3 rounded-lg text-gray-800" required>
        <input type="date" name="date" class="w-full p-3 rounded-lg text-gray-800" required>
        <textarea name="items" placeholder="Items List" rows="4" class="w-full p-3 rounded-lg text-gray-800"></textarea>
        <div class="flex items-start">
          <input type="checkbox" name="agree" id="agree" class="mr-2" required>
          <label for="agree" class="text-sm">I agree and authorize the team to contact me and/or send relevant data over Email, SMS & WhatsApp. This will override the registry with DNC / NDNC.</label>
        </div>
        <button type="submit" class="bg-yellow-400 text-gray-800 font-bold w-full p-3 rounded-lg hover:bg-yellow-500 transition">Submit</button>
      </form>
    </div>
  </div>
</section>
</body>
</html>
