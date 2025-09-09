<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanent Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#f0f6ff',
                        accent: '#38bdf8',
                        text: '#0f172a',
                        card: '#fff',
                        border: '#e0e7ef',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-secondary text-text min-h-screen font-sans flex flex-col">
    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 bg-white/90 shadow-md sticky top-0 z-30 border-border">
        <a href="{{ route('landing_page') }}">
            <span class="text-3xl font-extrabold text-primary tracking-tight">Show My Pro</span>
        </a>
        @if (auth('tanent')->check())
            <div class="relative group">
                <button class="flex items-center gap-2 bg-gradient-to-r from-primary to-accent text-white px-6 py-2 rounded-lg shadow-md hover:from-accent hover:to-primary transition text-base font-semibold focus:outline-none">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white bg-opacity-20">
                        <i class="fas fa-user text-lg text-white"></i>
                    </span>
                   
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl py-2 z-50 hidden group-hover:block group-focus:block border border-border">
                    <!-- User Card -->
                    <div class="flex items-center gap-3 px-4 py-4 border-b border-border">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center">
                            <i class="fas fa-user text-2xl text-white"></i>
                        </div>
                        <div>
                            <div class="font-bold text-text text-base">{{ auth('tanent')->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ auth('tanent')->user()->email }}</div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <a href="" class="flex items-center gap-2 px-4 py-3 text-text hover:bg-secondary transition">
                        <i class="fas fa-user-cog text-primary"></i> View Profile
                    </a>
                    <a href="" class="flex items-center gap-2 px-4 py-3 text-text hover:bg-secondary transition">
                        <i class="fas fa-key text-primary"></i> Change Password
                    </a>
                    <form method="POST" action="{{ route('tanent_logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-3 text-text hover:bg-secondary transition">
                            <i class="fas fa-sign-out-alt text-primary"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('tanent.login') }}" class="bg-gradient-to-r from-primary to-accent text-white px-6 py-2 rounded-lg shadow-md hover:from-accent hover:to-primary transition text-base font-semibold ml-4">Sign In</a>
        @endif
    </header>
    <div class="flex-1 flex overflow-hidden">
       
        <!-- Overlay for mobile -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden"></div>
        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-8 overflow-y-auto w-full">
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <footer class="block text-center py-6 text-text/60 bg-white border-t border-border mt-16 text-base rounded-t-2xl shadow-inner">
        &copy; {{ date('Y') }} Show My Pro. All rights reserved.
    </footer>
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });
        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
        // Dropdown for user menu
        document.addEventListener('click', function(e) {
            const group = document.querySelector('.group');
            const dropdown = group?.querySelector('div.absolute');
            if (group && dropdown) {
                if (group.contains(e.target)) {
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
    @yield('configuration_script')
 
</body>
</html> 