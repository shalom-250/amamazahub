<div class="flex flex-col">
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada - Leading Ecommerce Change</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #0f2b8e 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="w-32 h-8 bg-red-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xl">Lazada</span>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-red-500 font-medium">HOME</a>
                    <div class="relative group">
                        <a href="#" class="text-gray-700 hover:text-red-500 font-medium flex items-center">
                            ABOUT <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Company</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Leadership</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">History</a>
                        </div>
                    </div>
                    <a href="#" class="text-gray-700 hover:text-red-500 font-medium">PRESS & MEDIA</a>
                    <div class="relative group">
                        <a href="#" class="text-gray-700 hover:text-red-500 font-medium flex items-center">
                            CAREERS <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Open Positions</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Culture</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Benefits</a>
                        </div>
                    </div>
                    <a href="#" class="text-gray-700 hover:text-red-500 font-medium">CONTACTS</a>
                </nav>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <a href="#" class="block py-2 text-gray-700">HOME</a>
                <a href="#" class="block py-2 text-gray-700">ABOUT</a>
                <a href="#" class="block py-2 text-gray-700">PRESS & MEDIA</a>
                <a href="#" class="block py-2 text-gray-700">CAREERS</a>
                <a href="#" class="block py-2 text-gray-700">CONTACTS</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                    ECOMMERCE IS CHANGING<br>
                    <span class="text-yellow-300">AND WE'RE LEADING THE CHANGE</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 opacity-90">
                    Join millions of customers and sellers in Southeast Asia's leading online shopping destination.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300">
                        Shop Now
                    </button>
                    <button class="bg-transparent hover:bg-white/10 border-2 border-white text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                        Learn More
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Why Shop With Lazada?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shipping-fast text-red-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Free Shipping</h3>
                    <p class="text-gray-600">Enjoy free shipping on thousands of products with no minimum spend.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-blue-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Secure Payments</h3>
                    <p class="text-gray-600">Your transactions are protected with our advanced security systems.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-headset text-green-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">24/7 Support</h3>
                    <p class="text-gray-600">Our customer service team is always ready to assist you anytime.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Products -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Trending Products</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <div class="h-48 bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-blue-500 text-5xl"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Smartphone X1</h3>
                        <p class="text-gray-600 text-sm mb-2">Latest model with advanced features</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">$299.99</span>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <div class="h-48 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-laptop text-green-500 text-5xl"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Ultrabook Pro</h3>
                        <p class="text-gray-600 text-sm mb-2">Lightweight and powerful</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">$899.99</span>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <div class="h-48 bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-headphones text-purple-500 text-5xl"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Wireless Headphones</h3>
                        <p class="text-gray-600 text-sm mb-2">Noise cancelling technology</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">$149.99</span>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <div class="h-48 bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-tshirt text-yellow-500 text-5xl"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Fashion T-Shirt</h3>
                        <p class="text-gray-600 text-sm mb-2">Premium cotton material</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">$24.99</span>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10">
                <button class="bg-white hover:bg-gray-100 border border-gray-300 text-gray-800 font-semibold py-3 px-8 rounded-lg transition duration-300">
                    View All Products
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Lazada</h3>
                    <p class="text-gray-400">Southeast Asia's leading online shopping and selling destination.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">How to Buy</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Returns & Refunds</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contact Us</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">About Lazada</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Press & Media</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Corporate</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Stay Connected</h4>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-500 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-500 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-500 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <p class="text-gray-400">Subscribe to our newsletter</p>
                    <div class="mt-2 flex">
                        <input type="email" placeholder="Your email" class="px-3 py-2 bg-gray-700 text-white rounded-l focus:outline-none w-full">
                        <button class="bg-red-500 hover:bg-red-600 px-4 rounded-r transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 Lazada. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
</div>