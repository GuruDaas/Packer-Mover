<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../server/config/db.php'; // Secure include

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname    = $_POST['fname'] ?? '';
    $lname    = $_POST['lname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $mobile   = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';

    // Basic Validation
    if(empty($fname) || empty($email) || empty($password)) {
        $message = "Please fill in all required fields.";
    } else {
        $query = "INSERT INTO users (first_name, last_name, email, mobile, password)
                  VALUES (:fname, :lname, :email, :mobile, :password)";
    
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":fname", $fname);
        oci_bind_by_name($stmt, ":lname", $lname);
        oci_bind_by_name($stmt, ":email", $email);
        oci_bind_by_name($stmt, ":mobile", $mobile);
        oci_bind_by_name($stmt, ":password", $password); // Note: Password hashing recommended for production
        
        if(oci_execute($stmt)) {
            $message = "Registration successful! You can now login.";
        } else {
            $e = oci_error($stmt);
            $message = "Registration failed: " . $e['message'];
        }
        oci_free_statement($stmt);
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="bg-white w-full max-w-lg p-8 rounded-xl shadow-2xl border-t-4 border-red-600">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
            <p class="text-gray-500 mt-2">Join TrueWay Packers & Movers today</p>
        </div>

        <?php if (!empty($message)): ?>
             <div class="bg-<?= strpos($message, 'successful') !== false ? 'green' : 'red' ?>-100 border-l-4 border-<?= strpos($message, 'successful') !== false ? 'green' : 'red' ?>-500 text-<?= strpos($message, 'successful') !== false ? 'green' : 'red' ?>-700 p-4 mb-6 rounded" role="alert">
                <p><?= $message ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">First Name</label>
                    <input type="text" name="fname" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="John"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="lname" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="Doe"/>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="john@example.com"/>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Mobile Number</label>
                <input type="tel" name="mobile" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="+91 9876543210"/>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="••••••••"/>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-md transition mt-6">
                Register Now
            </button>

            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account? 
                <a href="login.php" class="text-red-600 font-bold hover:underline">Sign In</a>
            </p>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
