<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>
    
    @php
    $produk = \App\Models\Produk::all();
    $query = \App\Models\ProdukHistory::with(['produk', 'user']);
    $allHistories = $query->orderBy('created_at', 'desc')->paginate(20);
    @endphp
    
    <style>
        .carousel-container {
            position: relative;
            overflow: hidden;
        }
        
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .carousel-slide {
            min-width: 100%;
            position: relative;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .icon-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .bg-dark-blue {
            background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 100%);
        }
        
        .stat-icon {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
    </style>
    
    <!-- Mini Carousel -->
    <div class="container mx-auto px-4 pt-6 max-w-4xl">
        <div class="carousel-container h-15 rounded-lg mb-6 shadow-md">
            <div class="carousel-track" id="carouselTrack">
                <!-- Slide 1 -->
                <div class="carousel-slide bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg">
                    <div class="h-full flex items-center justify-between px-6 text-white">
                        <div>
                            <h3 class="text-lg font-bold">Selamat Datang!</h3>
                            <p class="text-blue-100 text-sm">Dashboard Management</p>
                        </div>
                        <div class="icon-float text-white/80">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div class="carousel-slide bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg">
                    <div class="h-full flex items-center justify-between px-6 text-white">
                        <div>
                            <h3 class="text-lg font-bold">Kelola Produk</h3>
                            <p class="text-emerald-100 text-sm">Pantau Inventori</p>
                        </div>
                        <div class="icon-float text-white/80">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="carousel-slide bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg">
                    <div class="h-full flex items-center justify-between px-6 text-white">
                        <div>
                            <h3 class="text-lg font-bold">Riwayat Data</h3>
                            <p class="text-purple-100 text-sm">Lacak Aktivitas</p>
                        </div>
                        <div class="icon-float text-white/80">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carousel Navigation Dots -->
        <div class="flex justify-center space-x-2 mb-6">
            <button class="carousel-dot w-2 h-2 rounded-full bg-gray-400 hover:bg-gray-600 transition-colors" onclick="goToSlide(0)"></button>
            <button class="carousel-dot w-2 h-2 rounded-full bg-gray-400 hover:bg-gray-600 transition-colors" onclick="goToSlide(1)"></button>
            <button class="carousel-dot w-2 h-2 rounded-full bg-gray-400 hover:bg-gray-600 transition-colors" onclick="goToSlide(2)"></button>
        </div>
    </div>
    
    <!-- Dashboard Cards -->
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card Produk -->
            <div class="card-hover bg-dark-blue dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 text-white relative">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="stat-icon p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white/90">Total Produk</h3>
                                <p class="text-2xl font-bold">{{ $produk->count() }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="produk" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm font-medium transition-all duration-200 backdrop-blur-sm">
                                <span>View More</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <div class="text-4xl font-bold text-white/60">📦</div>
                    </div>
                </div>
                
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-12 -mt-12"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            </div>
            
            <!-- Card History -->
            <div class="card-hover bg-dark-blue dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 text-white relative">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="stat-icon p-3 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white/90">Total Records</h3>
                                <p class="text-2xl font-bold">{{ $allHistories->total() }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="record" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm font-medium transition-all duration-200 backdrop-blur-sm">
                                <span>View More</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <div class="text-4xl font-bold text-white/60">📊</div>
                    </div>
                </div>
                
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-12 -mt-12"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            </div>
        </div>
    </div>
    
    <script>
        let currentSlide = 0;
        const totalSlides = 3;
        
        function updateCarousel() {
            const track = document.getElementById('carouselTrack');
            const dots = document.querySelectorAll('.carousel-dot');
            
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-gray-400');
                    dot.classList.add('bg-blue-500');
                } else {
                    dot.classList.remove('bg-blue-500');
                    dot.classList.add('bg-gray-400');
                }
            });
        }
        
        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateCarousel();
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }
        
        // Auto-advance carousel
        setInterval(nextSlide, 4000);
        
        // Initialize
        updateCarousel();
    </script>
</x-app-layout>