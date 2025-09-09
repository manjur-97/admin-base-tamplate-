@extends('tanent.layout')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">Design Your Website</h2>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 mb-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button id="header-footer-tab"
                    class="tab-btn active border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                    Header & Footer
                </button>
                <button id="menus-tab"
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                    Menus
                </button>
                <button id="pages-tab"
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Pages
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="header-footer-content" class="tab-content active">
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Header Templates</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach ($headers as $header)
                            <div class="bg-white rounded-lg border hover:shadow-lg transition-shadow overflow-hidden">
                                <!-- Header Info -->
                                <div class="p-4 border-b">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="selected_header" id="header_{{ $header['id'] }}"
                                                value="{{ $header['id'] }}"
                                                data-file-name="{{ $header['file_name'] ?? '' }}"
                                                {{ $header['is_active'] ? 'checked' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                            <label for="header_{{ $header['id'] }}"
                                                class="font-semibold text-gray-800 cursor-pointer">{{ $header['name'] }}</label>
                                        </div>
                                        <span
                                            class="text-xs px-2 py-1 rounded {{ $header['is_active'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $header['is_active'] ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Header Preview -->
                                <div class="header-preview-container">
                                    <div class="header-preview-content" id="header_preview_{{ $header['id'] }}">
                                        {!! $header['content'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Footer Templates</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach ($footers as $footer)
                            <div class="bg-white rounded-lg border hover:shadow-lg transition-shadow overflow-hidden">
                                <!-- Footer Info -->
                                <div class="p-4 border-b">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="selected_footer" id="footer_{{ $footer['id'] }}"
                                                value="{{ $footer['id'] }}"
                                                data-file-name="{{ $footer['file_name'] ?? '' }}"
                                                {{ $footer['is_active'] ? 'checked' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                            <label for="footer_{{ $footer['id'] }}"
                                                class="font-semibold text-gray-800 cursor-pointer">{{ $footer['name'] }}</label>
                                        </div>
                                        <span
                                            class="text-xs px-2 py-1 rounded {{ $footer['is_active'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $footer['is_active'] ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Footer Preview -->
                                <div class="footer-preview-container">
                                    <div class="footer-preview-content" id="footer_preview_{{ $footer['id'] }}">
                                        {!! $footer['content'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Footer Settings</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Footer Background Color</label>
                            <input type="color" class="w-full h-10 rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Footer Text Color</label>
                            <input type="color" class="w-full h-10 rounded border-gray-300">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Copyright Text</label>
                            <input type="text" placeholder="© 2024 Your Company. All rights reserved."
                                class="w-full p-2 border border-gray-300 rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="menus-content" class="tab-content hidden">
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Navigation Menu</h3>
                    <div id="menu-list" class="space-y-4">
                        {{-- Assuming $parent_menus is passed from the controller, containing only parent menus with children eager loaded --}}
                        @isset($parent_menus)
                            @forelse($parent_menus->where('parent_id', null) as $menu)
                                @include('tanent.pages.design.partials.menu-item', ['menu' => $menu])
                            @empty
                                <p class="text-gray-500 text-center py-4">No menu items yet. Add one below.</p>
                            @endforelse
                        @else
                            <p class="text-gray-500 text-center py-4">No menu items yet. Add one below.</p>
                        @endisset
                    </div>
                    <button id="addMenuButton"
                        class="w-full mt-4 p-3 border-2 border-dashed border-gray-300 rounded text-gray-500 hover:border-gray-400 hover:text-gray-600 transition-colors">
                        + Add Menu Item
                    </button>
                </div>
            </div>
        </div>

        <div id="pages-content" class="tab-content hidden">
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Website Pages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-800">Home Page</h4>
                            <p class="text-sm text-gray-600 mt-1">Main landing page</p>
                            <button class="mt-3 text-blue-600 hover:text-blue-800 text-sm">Edit Page</button>
                        </div>
                        <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-800">About Page</h4>
                            <p class="text-sm text-gray-600 mt-1">Company information</p>
                            <button class="mt-3 text-blue-600 hover:text-blue-800 text-sm">Edit Page</button>
                        </div>
                        <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-800">Contact Page</h4>
                            <p class="text-sm text-gray-600 mt-1">Contact information</p>
                            <button class="mt-3 text-blue-600 hover:text-blue-800 text-sm">Edit Page</button>
                        </div>
                        <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-800">Services Page</h4>
                            <p class="text-sm text-gray-600 mt-1">Services offered</p>
                            <button class="mt-3 text-blue-600 hover:text-blue-800 text-sm">Edit Page</button>
                        </div>
                        <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-800">Blog Page</h4>
                            <p class="text-sm text-gray-600 mt-1">Blog posts</p>
                            <button class="mt-3 text-blue-600 hover:text-blue-800 text-sm">Edit Page</button>
                        </div>
                        <a href="{{route('tanent.website.page_create', $website_id)}}">
                            <div
                                class="bg-white p-4 rounded border-2 border-dashed border-gray-300 hover:border-gray-400 transition-colors">
                                <h4 class="font-semibold text-gray-500">+ Add New Page</h4>
                                <p class="text-sm text-gray-400 mt-1">Create Page</p>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Menu Modal -->
    <div id="addMenuModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Add New Menu Item</h3>
                <button id="closeMenuModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6">
                <form action="{{ route('backend.websitemenu.store') }}" method="POST" id="addMenuForm">
                    @csrf
                    <input type="hidden" name="website_id" value="{{ $website_id }}">
                    <div class="space-y-8">
                        <!-- Name -->
                        <div class="relative">
                            <input type="text" name="name" id="menu_name"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " required />
                            <label for="menu_name"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name</label>
                        </div>

                        <!-- Parent Menu -->
                        <div class="relative">
                            <select name="parent_id" id="parent_id"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                                <option value="">None</option>
                                @isset($parent_menus)
                                    @foreach ($parent_menus as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <label for="parent_id"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 start-1">Parent
                                Menu (Optional)</label>
                        </div>

                        <!-- Order -->
                        <div class="relative">
                            <input type="number" name="order" id="order" value="0"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " />
                            <label for="order"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Order</label>
                        </div>

                        <!-- Status -->
                        <div class="relative">
                            <select name="status" id="status"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <label for="status"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 start-1">Status</label>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" id="cancelMenuModal"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Create
                            Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Message -->
    <div id="header-toast" class="fixed top-6 right-6 z-50 hidden">
        <div
            class="flex items-center px-4 py-3 rounded shadow-lg bg-green-500 text-white font-semibold space-x-2 animate-fade-in">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="header-toast-msg">Header selected successfully!</span>
        </div>
    </div>



    <style>
        .tab-btn.active {
            @apply border-indigo-500 text-indigo-600;
        }

        .tab-content.active {
            @apply block;
        }

        .header-preview-container {
            background: #f8fafc;
            overflow: hidden;
        }

        .header-preview-content {
            transform: scale(0.7);
            transform-origin: top left;
            width: 142.86%;
        }

        .footer-preview-container {
            background: #f8fafc;
            overflow: hidden;
        }

        .footer-preview-content {
            transform: scale(0.7);
            transform-origin: top left;
            width: 142.86%;
        }

        @media (max-width: 768px) {
            .header-preview-content {
                transform: scale(0.5);
                width: 200%;
            }

            .footer-preview-content {
                transform: scale(0.5);
                width: 200%;
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease;
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-btn');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active', 'border-indigo-500',
                        'text-indigo-600'));
                    tabs.forEach(t => t.classList.add('border-transparent', 'text-gray-500'));
                    contents.forEach(c => c.classList.add('hidden'));

                    // Add active class to clicked tab
                    tab.classList.add('active', 'border-indigo-500', 'text-indigo-600');
                    tab.classList.remove('border-transparent', 'text-gray-500');

                    // Show corresponding content
                    const targetId = tab.id.replace('-tab', '-content');
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });

            // Menu Modal Logic
            const addMenuButton = document.getElementById('addMenuButton');
            const addMenuModal = document.getElementById('addMenuModal');
            const closeMenuModal = document.getElementById('closeMenuModal');
            const cancelMenuModal = document.getElementById('cancelMenuModal');

            if (addMenuButton) {
                addMenuButton.addEventListener('click', () => {
                    if (addMenuModal) {
                        addMenuModal.classList.remove('hidden');
                    }
                });
            }

            const closeTheMenuModal = () => {
                if (addMenuModal) {
                    addMenuModal.classList.add('hidden');
                }
            };

            if (closeMenuModal) closeMenuModal.addEventListener('click', closeTheMenuModal);
            if (cancelMenuModal) cancelMenuModal.addEventListener('click', closeTheMenuModal);
        });

        $(function() {
            $('input[name="selected_header"]').on('change', function() {
                var headerId = $(this).val();
                var headerContent = $('#header_preview_' + headerId).html();
                var fileName = $(this).data('file-name');

                $.ajax({
                    url: "{{ route('cms.settings.save-header') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        header: headerContent,
                        file_name: fileName,
                        website_id: {{ $website_id }}
                    },
                    success: function(response) {
                        // Remove active from all
                        $('input[name="selected_header"]').each(function() {
                            var card = $(this).closest('.bg-white');
                            card.find('.text-xs').removeClass(
                                'bg-green-100 text-green-800').addClass(
                                'bg-gray-100 text-gray-600').text('Inactive');
                        });
                        // Set active for selected
                        var card = $('input[name="selected_header"]:checked').closest(
                            '.bg-white');
                        card.find('.text-xs').removeClass('bg-gray-100 text-gray-600').addClass(
                            'bg-green-100 text-green-800').text('Active');
                        showHeaderToast('Header selected successfully!');
                    },
                    error: function(xhr) {
                        showHeaderToast('Something went wrong. Please try again.', true);
                    }
                });
            });
        });

        $(function() {
            $('input[name="selected_footer"]').on('change', function() {
                var footerId = $(this).val();
                var footerContent = $('#footer_preview_' + footerId).html();
                var fileName = $(this).data('file-name');

                $.ajax({
                    url: "{{ route('cms.settings.save-footer') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        footer: footerContent,
                        file_name: fileName,
                        website_id: {{ $website_id }}
                    },
                    success: function(response) {
                        // Remove active from all
                        $('input[name="selected_footer"]').each(function() {
                            var card = $(this).closest('.bg-white');
                            card.find('.text-xs').removeClass(
                                'bg-green-100 text-green-800').addClass(
                                'bg-gray-100 text-gray-600').text('Inactive');
                        });
                        // Set active for selected
                        var card = $('input[name="selected_footer"]:checked').closest(
                            '.bg-white');
                        card.find('.text-xs').removeClass('bg-gray-100 text-gray-600').addClass(
                            'bg-green-100 text-green-800').text('Active');
                        showHeaderToast('Footer selected successfully!');
                    },
                    error: function(xhr) {
                        showHeaderToast('Something went wrong. Please try again.', true);
                    }
                });
            });
        });

        function showHeaderToast(msg, isError = false) {
            var toast = $('#header-toast');
            var toastMsg = $('#header-toast-msg');
            toastMsg.text(msg);
            toast.find('div').toggleClass('bg-green-500', !isError).toggleClass('bg-red-500', isError);
            toast.removeClass('hidden');
            setTimeout(function() {
                toast.addClass('hidden');
            }, 2000);
        }
    </script>
@endsection
