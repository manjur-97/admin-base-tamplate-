<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show My Pro</title>
    <!-- Tailwind CSS CDN with custom config for light blue -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb', // deep blue
                        secondary: '#f0f6ff', // very light blue
                        accent: '#38bdf8', // sky blue accent
                        text: '#0f172a', // dark text
                        card: '#fff',
                        border: '#e0e7ef',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-secondary text-text min-h-screen font-sans">
    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 bg-white/90 shadow-md sticky top-0 z-30  border-border">
        <a href="{{route('landing_page')}}"> <span class="text-3xl font-extrabold text-primary tracking-tight">Show My Pro</span></a>
       
        <a href="{{ route('tanent.login') }}" class="bg-gradient-to-r from-primary to-accent text-white px-6 py-2 rounded-lg shadow-md hover:from-accent hover:to-primary transition text-base font-semibold ml-4">Sign In</a>
    </header>

    <!-- Full Screen Banner -->
    <section class="w-full min-h-[90vh] flex flex-col items-center justify-center text-center bg-gradient-to-br from-primary/80 via-accent/40 to-secondary relative pb-12">
        <div class="container mx-auto px-4 z-10 flex flex-col items-center">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-5xl sm:text-6xl font-black mb-6 text-white drop-shadow-lg leading-tight">Create your own portfolio<br class="hidden sm:block"/> with <span class="text-accent">zero code</span></h1>
                <p class="text-xl sm:text-2xl mb-10 text-white/90 font-medium">Showcase your work, skills, and creativity online.<br/>Build and launch your portfolio for free—no coding, no cost, just your story.</p>
          <a href="{{ route('tanent.register') }}" class="bg-gradient-to-r from-accent to-primary px-8 py-3 rounded-lg font-bold text-white text-lg shadow-lg hover:from-primary hover:to-accent transition w-full sm:w-auto">Get Started</a>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-extrabold mb-10 text-primary text-center tracking-tight">Showcase of Portfolios</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            <!-- Portfolio Card Example -->
            <div class="bg-card rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col items-center p-8 border border-border group">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-accent mb-4 shadow-lg">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xl text-primary mb-1">John Doe</h3>
                <p class="text-base text-text/70 mb-3 text-center">UI/UX Designer portfolio with interactive case studies and clean layout.</p>
                <a href="#" class="inline-block mt-2 bg-gradient-to-r from-primary to-accent text-white px-5 py-2 rounded-lg font-semibold shadow hover:from-accent hover:to-primary transition">View Portfolio</a>
            </div>
            <div class="bg-card rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col items-center p-8 border border-border group">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-accent mb-4 shadow-lg">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jane Smith" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xl text-primary mb-1">Jane Smith</h3>
                <p class="text-base text-text/70 mb-3 text-center">Web developer portfolio featuring live project demos and blog.</p>
                <a href="#" class="inline-block mt-2 bg-gradient-to-r from-primary to-accent text-white px-5 py-2 rounded-lg font-semibold shadow hover:from-accent hover:to-primary transition">View Portfolio</a>
            </div>
            <div class="bg-card rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col items-center p-8 border border-border group">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-accent mb-4 shadow-lg">
                    <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Alex Lee" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xl text-primary mb-1">Alex Lee</h3>
                <p class="text-base text-text/70 mb-3 text-center">Photographer portfolio with gallery and client testimonials.</p>
                <a href="#" class="inline-block mt-2 bg-gradient-to-r from-primary to-accent text-white px-5 py-2 rounded-lg font-semibold shadow hover:from-accent hover:to-primary transition">View Portfolio</a>
            </div>
            <div class="bg-card rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col items-center p-8 border border-border group">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-accent mb-4 shadow-lg">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Sara Kim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xl text-primary mb-1">Sara Kim</h3>
                <p class="text-base text-text/70 mb-3 text-center">Content writer portfolio with featured articles and writing samples.</p>
                <a href="#" class="inline-block mt-2 bg-gradient-to-r from-primary to-accent text-white px-5 py-2 rounded-lg font-semibold shadow hover:from-accent hover:to-primary transition">View Portfolio</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-text/60 bg-white border-t border-border mt-16 text-base rounded-t-2xl shadow-inner">
        &copy; 2025 Show My Pro. All rights reserved.
    </footer>
</body>
</html>