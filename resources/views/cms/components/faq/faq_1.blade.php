<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Find answers to common questions about our services and products.
            </p>
        </div>

        <div class="space-y-4">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">What services do you offer?</h3>
                        <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="mt-2 text-gray-600 hidden">
                        We offer a comprehensive range of services including web development, mobile app development, UI/UX design, digital marketing, and cloud solutions. Our team of experts is dedicated to delivering high-quality solutions tailored to your specific needs.
                    </div>
                </button>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">How long does it take to complete a project?</h3>
                        <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="mt-2 text-gray-600 hidden">
                        Project timelines vary depending on the scope and complexity. A typical website project can take 4-8 weeks, while more complex applications may take 3-6 months. We'll provide you with a detailed timeline during our initial consultation.
                    </div>
                </button>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">What is your pricing structure?</h3>
                        <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="mt-2 text-gray-600 hidden">
                        We offer flexible pricing options including project-based pricing, hourly rates, and retainer agreements. Each project is unique, and we'll work with you to determine the most suitable pricing structure based on your requirements and budget.
                    </div>
                </button>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Do you provide ongoing support?</h3>
                        <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="mt-2 text-gray-600 hidden">
                        Yes, we offer comprehensive support and maintenance services. Our support packages include regular updates, security monitoring, performance optimization, and technical assistance. We're committed to ensuring your digital solutions remain secure and up-to-date.
                    </div>
                </button>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">How do you ensure project quality?</h3>
                        <svg class="w-6 h-6 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="mt-2 text-gray-600 hidden">
                        We follow a rigorous quality assurance process that includes code reviews, automated testing, performance testing, and security audits. Our team conducts regular testing throughout the development process to ensure the highest quality standards are met.
                    </div>
                </button>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-4">Still have questions?</p>
            <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                Contact Support
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>

    <script>
        function toggleFAQ(button) {
            const content = button.querySelector('div:last-child');
            const icon = button.querySelector('svg');

            // Toggle content visibility
            content.classList.toggle('hidden');

            // Toggle icon rotation
            icon.classList.toggle('rotate-180');

            // Toggle button background
            button.classList.toggle('bg-gray-50');
        }
    </script>
</section>
