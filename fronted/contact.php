<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<div class="relative bg-gray-900 text-white py-24 text-center bg-cover bg-center" style="background-image: url('https://truewaymovers.com/wp-content/uploads/2024/04/smiley-guy-delivering-package_23-2148546039.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-lg text-gray-300">We'd love to hear from you! Reach out for a free quote.</p>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid md:grid-cols-2 gap-12">
            
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Get In Touch</h3>
                    <p class="text-gray-600 mb-6">
                        Have questions about your move? Need a quote? Reach out to us via phone, email, or visit our office.
                    </p>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Head Office</h4>
                        <p class="text-gray-600">Plot No. 123, Transport Nagar,<br>Bangalore, Karnataka, India</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">
                        <i class="fas fa-phone-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Phone</h4>
                        <p class="text-gray-600">+91 - 9878522857</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Email</h4>
                        <p class="text-gray-600">info@truewaymovers.com</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Send a Message</h3>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3 border" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3 border" placeholder="john@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3 border" placeholder="Inquiry about Moving">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3 border" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow transition">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- Map Placeholder -->
<!-- <div class="h-64 bg-gray-200 w-full">
    <iframe src="https://www.google.com/maps/embed?..." class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div> -->

<?php include 'includes/footer.php'; ?>
