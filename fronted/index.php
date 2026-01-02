<?php include 'includes/header.php'; ?>

<!-- Hero Section with Background -->
<section class="relative bg-cover bg-center h-[600px] flex items-center"
   style="background-image: url('https://as1.ftcdn.net/v2/jpg/02/95/37/70/1000_F_295377040_cVBPPYrTXKxb9znVHqiUKewlg0Ye5XWY.jpg');">
   
   <!-- Overlay -->
   <div class="absolute inset-0 bg-black bg-opacity-60"></div>

   <!-- Main Content -->
   <div class="relative z-10 container mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
     
     <!-- Left Text -->
     <div class="text-white space-y-6">
       <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">Top Rated Movers</span>
       <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
         Move with <span class="text-yellow-400">Confidence</span>, <br> Move with <span class="text-red-500">TrueWay</span>.
       </h1>
       <p class="text-lg text-gray-200 max-w-lg">
         Join thousands of happy customers who trust us for safe, timely, and hassle-free shifting. We handle your belongings with care.
       </p>
       <div class="flex flex-wrap gap-4">
         <a href="contact.php" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full font-bold shadow-lg transition transform hover:scale-105">
           Get Free Quote
         </a>
         <a href="service.php" class="bg-transparent border-2 border-white hover:bg-white hover:text-black text-white px-8 py-3 rounded-full font-bold shadow-lg transition transform hover:scale-105">
           Our Services
         </a>
       </div>
     </div>

     <!-- Right Form (Optional: Quick Inquiry) -->
     <!-- <div class="hidden md:block bg-white p-6 rounded-xl shadow-2xl max-w-sm ml-auto">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Estimates</h3>
        <form action="#" class="space-y-4">
            <input type="text" placeholder="Your Name" class="w-full border p-2 rounded">
            <input type="text" placeholder="Mobile Number" class="w-full border p-2 rounded">
            <button class="w-full bg-yellow-400 text-black font-bold py-2 rounded hover:bg-yellow-500">Check Rates</button>
        </form>
     </div> -->
   </div>
</section>

<!-- Welcome Section -->
<div class="relative z-20 -mt-16 container mx-auto px-6">
    <div class="bg-white shadow-xl rounded-lg p-8 grid md:grid-cols-3 gap-8 border-t-4 border-red-600">
        <div class="md:col-span-2 space-y-2">
            <h2 class="text-3xl font-bold text-gray-800">Welcome to TrueWay Packers & Movers</h2>
            <p class="text-gray-600">India's Leading, Trusted, and Experienced Relocation Experts.</p>
        </div>
        <div class="flex items-center justify-end">
            <a href="contact.php" class="w-full md:w-auto text-center bg-gray-900 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded transition">
                Request a Call Back
            </a>
        </div>
    </div>
</div>

<!-- About Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h4 class="text-red-600 font-bold uppercase text-sm tracking-widest mb-2">About Our Company</h4>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">We Make Moving Easy & Safe</h2>
            <p class="text-gray-600 leading-relaxed mb-6">
                TrueWay Packers & Movers Pvt. Ltd. offers delightful home moving services at delightful prices. 
                Our US Patent Pending Technology ensures zero wastage and maximum efficiency. From instant quotes 
                to breakage-free delivery, our automated process guarantees peace of mind.
            </p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-700">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i> Experienced & Trained Staff
                </li>
                <li class="flex items-center text-gray-700">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i> On-Time Delivery Guarantee
                </li>
                <li class="flex items-center text-gray-700">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i> 100% Safe Handling
                </li>
            </ul>
            <a href="about.php" class="text-red-600 font-bold hover:underline">Read More About Us &rarr;</a>
        </div>
        <div class="relative">
            <img src="https://truewaymovers.com/wp-content/uploads/2024/04/1374.webp" alt="About TrueWay" class="rounded-lg shadow-2xl relative z-10 w-full" />
            <div class="absolute -bottom-6 -right-6 w-full h-full border-4 border-red-200 rounded-lg z-0 hidden md:block"></div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-16 bg-white">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800">Our Premium Services</h2>
        <p class="text-gray-500 mt-2">Comprehensive solutions for all your relocation needs</p>
    </div>

    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $services = [
            ["title" => "Household Shifting", "img" => "https://truewaymovers.com/wp-content/uploads/2022/11/Untitled-design-2024-06-11T140915.913.jpg", "desc" => "Safe and secure domestic shifting services across India."],
            ["title" => "Car Transportation", "img" => "https://truewaymovers.com/wp-content/uploads/2024/06/Untitled-design-2024-06-11T141214.943.jpg", "desc" => "Reliable car carrier services ensuring damage-free delivery."],
            ["title" => "Office Relocation", "img" => "https://truewaymovers.com/wp-content/uploads/2024/06/Untitled-design-2024-06-11T141329.985.jpg", "desc" => "Efficient corporate moving services with minimal downtime."]
        ];
        
        foreach($services as $service): 
        ?>
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden border border-gray-100">
            <div class="relative overflow-hidden h-56">
                <img src="<?= $service['img'] ?>" alt="<?= $service['title'] ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition"></div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 group-hover:text-red-600 transition"><?= $service['title'] ?></h3>
                <p class="text-gray-600 text-sm mt-2 mb-4"><?= $service['desc'] ?></p>
                <a href="service.php" class="text-sm font-bold text-red-500 hover:text-red-700">LEARN MORE &rarr;</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="text-center mt-12">
        <a href="service.php" class="inline-block border-2 border-red-600 text-red-600 font-bold py-3 px-8 rounded hover:bg-red-600 hover:text-white transition">View All Services</a>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-red-600 text-white">
    <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-4xl font-bold mb-2">12+</div>
            <div class="text-red-100 uppercase text-xs tracking-wider">Years Experience</div>
        </div>
        <div>
            <div class="text-4xl font-bold mb-2">24k+</div>
            <div class="text-red-100 uppercase text-xs tracking-wider">Happy Clients</div>
        </div>
        <div>
            <div class="text-4xl font-bold mb-2">7k+</div>
            <div class="text-red-100 uppercase text-xs tracking-wider">Projects Done</div>
        </div>
        <div>
            <div class="text-4xl font-bold mb-2">150+</div>
            <div class="text-red-100 uppercase text-xs tracking-wider">Pro Staff</div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-12 bg-gray-100 overflow-hidden">
    <div class="container mx-auto px-6 mb-8 text-center">
         <h2 class="text-2xl font-bold text-gray-800">Trusted By Leading Companies</h2>
    </div>
    
    <div class="relative w-full overflow-hidden">
        <div class="flex animate-marquee space-x-12 items-center w-[200%]">
            <!-- Logos repeated for seamless loop -->
            <?php 
            $partners = ["airtel.png", "sbi.png", "amazon.png", "paytm.png", "dlf.png", "flipkart.png"];
            // Repeat twice for marquee
            for($i=0; $i<2; $i++) {
                foreach($partners as $p) {
                    echo '<img src="https://truewaymovers.com/wp-content/uploads/2022/11/'.$p.'" class="h-12 w-auto opacity-70 hover:opacity-100 transition grayscale hover:grayscale-0">';
                }
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
