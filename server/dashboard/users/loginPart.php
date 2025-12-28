<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Helpful Blogs</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
</head>
<body class="bg-gray-100">
    <!-- Header Section Start -->
<div class="bg-white border-b border-red-500 py-2">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center flex-wrap">
    
      <!-- Left Section: Logo + Text -->
      <div class="flex items-center space-x-4">
        <img
          src="https://truewaymovers.com/wp-content/uploads/2022/10/trueway-logo.png"
          alt="TrueWay Logo"
          class="h-14 min-w-14"
        />
        <div>
          <h1 class="text-red-600 font-bold text-lg md:text-xl">
            TRUEWAY PACKERS & MOVERS PVT. LTD.
          </h1>
          <p class="text-sm text-gray-700 font-medium italic">
            "the moving experts"
          </p>
        </div>
      </div>
    
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
    
    
     <!-- navbar page -->
      <nav class="bg-red-600 text-white px-4 py-3 shadow-md relative z-10 h-12">
        <ul class="flex flex-wrap gap-6 justify-center items-center text-sm font-semibold relative gap-10">
          
          <li><a href="index.html" class="hover:underline cursor-pointer font-semibold text-[16px] pl-12">HOME</a></li>
          <li><a href="about.html" class="hover:underline cursor-pointer font-semibold text-[16px]">ABOUT US</a></li>
    
          <li class="relative group">
            <button onclick="toggleDropdown()" class="hover:underline cursor-pointer font-semibold text-[16px]">SERVICES</button>
            <ul id="serviceDropdown" class="hidden absolute left-0 bg-white text-black mt-2 p-2 rounded shadow-lg z-10">
              <li><a href="services.html" class="hover:underline cursor-pointer block px-4 py-2">All Services</a></li>
              <li><a href="local-shifting.html" class="block px-4 py-2 hover:bg-gray-200">Local Shifting</a></li>
              <li><a href="car-transport.html" class="block px-4 py-2 hover:bg-gray-200">Car Transport</a></li>
            </ul>
          </li>
          <li><a href="shifting_process.html" class="hover:underline cursor-pointer font-semibold text-[16px]">SHIFTING PROCESS</a></li>
          <li><a href="moving_tips.html" class="hover:underline cursor-pointer font-semibold text-[16px]">MOVING TIPS</a></li>
          <li><a href="galery.html" class="hover:underline cursor-pointer font-semibold text-[16px]">GALERY</a></li>
          <li><a href="contact.html" class="hover:underline cursor-pointer font-semibold text-[16px]">CONTACT US</a></li>
          <li><a href="blogs.html" class="hover:underline cursor-pointer font-semibold text-[16px]">BLOGS</a></li>
          <li><a href="login.html" class="hover:underline cursor-pointer bold font-semibold text-[17px] ml-10 pl-12">Login</a></li>
        </ul>
      </nav>
      <!-- navbar page end -->
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
          <a href="javascript:void(0)">
            <img src="https://readymadeui.com/readymadeui.svg" alt="logo" class="w-40 mb-8 mx-auto block" />
          </a>
    
          <div class="p-8 rounded-2xl bg-white shadow">
            <h2 class="text-slate-900 text-center text-3xl font-semibold">Sign in</h2>
            <form class="mt-12 space-y-6">
              <div>
                <label class="text-slate-800 text-sm font-medium mb-2 block">User name</label>
                <div class="relative flex items-center">
                  <input name="username" type="text" required class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter user name" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                    <circle cx="10" cy="7" r="6"></circle>
                    <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"></path>
                  </svg>
                </div>
              </div>
    
              <div>
                <label class="text-slate-800 text-sm font-medium mb-2 block">Password</label>
                <div class="relative flex items-center">
                  <input name="password" type="password" required class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter password" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"></path>
                  </svg>
                </div>
              </div>
    
              <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                  <label for="remember-me" class="ml-3 block text-sm text-slate-800">
                    Remember me
                  </label>
                </div>
                <div class="text-sm">
                  <a href="javascript:void(0);" class="text-blue-600 hover:underline font-semibold">
                    Forgot your password?
                  </a>
                </div>
              </div>
    
              <div class="!mt-12">
                <button type="button" class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  Sign in
                </button>
              </div>
              <p class="text-slate-800 text-sm !mt-6 text-center">Don't have an account? <a href="./register.html" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register here</a></p>
            </form>
          </div>
        </div>
    
</body>
  </div>