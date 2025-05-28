<section class="py-12 md:py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">
            <!-- Left Column - Title and Description -->
            <div class="text-left">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold mb-4">FAQ</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Find answers to common questions about our services and products. Can't find what you're looking for? Contact our support team.
                </p>
                <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-md hover:shadow-lg">
                    <span class="font-medium">Contact Support</span>
                    <svg class="w-5 h-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Right Column - FAQ Items -->
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left focus:outline-none group" onclick="toggleFAQ3(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">What services do you offer?</h3>
                            <div class="flex items-center">
                                <span class="text-sm text-blue-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">View Answer</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-gray-600 hidden overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="py-2">
                                We offer a comprehensive range of services including web development, mobile app development, UI/UX design, digital marketing, and cloud solutions. Our team of experts is dedicated to delivering high-quality solutions tailored to your specific needs.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left focus:outline-none group" onclick="toggleFAQ3(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">How long does it take to complete a project?</h3>
                            <div class="flex items-center">
                                <span class="text-sm text-blue-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">View Answer</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-gray-600 hidden overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="py-2">
                                Project timelines vary depending on the scope and complexity. A typical website project can take 4-8 weeks, while more complex applications may take 3-6 months. We'll provide you with a detailed timeline during our initial consultation.
                            </div>
                        </div>
                    </button>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left focus:outline-none group" onclick="toggleFAQ3(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">What is your pricing structure?</h3>
                            <div class="flex items-center">
                                <span class="text-sm text-blue-600 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">View Answer</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-gray-600 hidden overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="py-2">
                                We offer flexible pricing options including project-based pricing, hourly rates, and retainer agreements. Each project is unique, and we'll work with you to determine the most suitable pricing structure based on your requirements and budget.
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ3(button) {
            const content = button.querySelector('div:last-child');
            const icon = button.querySelector('svg');
            const question = button.querySelector('h3');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('rotate-180');
                question.classList.add('text-blue-600');
            } else {
                content.style.maxHeight = '0';
                setTimeout(() => {
                    content.classList.add('hidden');
                }, 300);
                icon.classList.remove('rotate-180');
                question.classList.remove('text-blue-600');
            }
        }
    </script>
</section>
