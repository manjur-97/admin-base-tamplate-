<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-xl font-bold mb-4">About {{ $website->title }}</h3>
                <p class="text-gray-400">{{ $website->description ?? 'We are dedicated to providing the best service to our customers. Our mission is to make your experience exceptional.' }}</p>
            </div>

            <!-- Contact Form -->
            <div>
                <h3 class="text-xl font-bold mb-4">Get in Touch</h3>
                <form class="space-y-4">
                    <div>
                        <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded bg-gray-800 text-white">
                    </div>
                    <div>
                        <input type="email" placeholder="Your Email" class="w-full px-4 py-2 rounded bg-gray-800 text-white">
                    </div>
                    <div>
                        <textarea placeholder="Your Message" rows="3" class="w-full px-4 py-2 rounded bg-gray-800 text-white"></textarea>
                    </div>
                    <button class="bg-blue-600 px-6 py-2 rounded hover:bg-blue-700">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                <ul class="space-y-4 text-gray-400">
                    @if ($website->address)
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>{{ $website->address }}</span>
                        </li>
                    @endif
                    @if ($website->mobile)
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3"></i>
                            <span>{{ $website->mobile }}</span>
                        </li>
                    @endif
                    @if ($website->email)
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>{{ $website->email }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    @if ($website->facebook)
                        <a href="{{ $website->facebook }}" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if ($website->twitter)
                        <a href="{{ $website->twitter }}" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if ($website->instagram)
                        <a href="{{ $website->instagram }}" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if ($website->linkedin)
                        <a href="{{ $website->linkedin }}" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
