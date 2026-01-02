<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TrueWay Packers & Movers</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for marquee effect */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            animation: marquee 15s linear infinite;
        }
    </style>
</head>
<body class="font-sans text-gray-900 bg-white">

    <!-- Header Section Start -->
    <div class="bg-white border-b border-red-500 py-2">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center flex-wrap">
            <!-- Left Section: Logo + Text -->
            <a href="index.php" class="flex items-center space-x-4">
                <img src="https://truewaymovers.com/wp-content/uploads/2022/10/trueway-logo.png" alt="TrueWay Logo" class="h-14 min-w-14" />
                <div>
                    <h1 class="text-red-600 font-bold text-lg md:text-xl">TRUEWAY PACKERS & MOVERS PVT. LTD.</h1>
                    <p class="text-sm text-gray-700 font-medium italic">"the moving experts"</p>
                </div>
            </a>

            <!-- Right Section: Call & WhatsApp -->
            <div class="flex space-x-6 items-center mt-3 md:mt-0">
                <!-- Call Info -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone-alt text-cyan-500 text-lg"></i>
                    <div>
                        <p class="font-bold text-sm">Call Us</p>
                        <p class="text-sm">+91 - 9878522857</p>
                    </div>
                </div>
                <!-- WhatsApp Info -->
                <div class="flex items-center space-x-2">
                    <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                    <div>
                        <p class="font-bold text-sm">Whatsapp</p>
                        <p class="text-sm">+91 - 9878522857</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Page End -->

    <!-- Navbar Start -->
    <nav class="bg-red-600 text-white px-4 py-3 shadow-md relative z-10 sticky top-0">
        <ul class="flex flex-wrap gap-6 justify-center items-center text-sm font-semibold relative md:gap-10">
            <li><a href="index.php" class="hover:underline cursor-pointer font-semibold text-[16px]">HOME</a></li>
            <li><a href="about.php" class="hover:underline cursor-pointer font-semibold text-[16px]">ABOUT US</a></li>
            
            <li class="relative group">
                <button class="hover:underline cursor-pointer font-semibold text-[16px] flex items-center gap-1">
                    SERVICES <i class="fa fa-caret-down"></i>
                </button>
                <ul class="hidden group-hover:block absolute left-0 bg-white text-black mt-2 p-2 rounded shadow-lg z-50 min-w-[200px]">
                    <li><a href="service.php" class="hover:bg-gray-200 block px-4 py-2">All Services</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Local Shifting</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Car Transport</a></li>
                </ul>
            </li>

            <li><a href="shifting_process.php" class="hover:underline cursor-pointer font-semibold text-[16px]">SHIFTING PROCESS</a></li>
            <li><a href="contact.php" class="hover:underline cursor-pointer font-semibold text-[16px]">CONTACT US</a></li>
            
            <!-- Dynamic Links -->
            <li><a href="../server/shipments/add_shipment.php" class="hover:underline cursor-pointer font-semibold text-[16px]">Track Shipment</a></li>
            
            <li><a href="login.php" class="bg-white text-red-600 px-4 py-1 rounded hover:bg-gray-100 font-bold transition">Login</a></li>
            <!-- Admin Link (Optional, usually hidden or distinct) -->
            <!-- <li><a href="admin.html" class="hover:underline cursor-pointer">Admin</a></li> -->
        </ul>
    </nav>
    <!-- Navbar End -->
