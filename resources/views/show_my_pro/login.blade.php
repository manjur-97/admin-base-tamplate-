<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Login</title>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="gradient-bg h-screen overflow-hidden">
    <!-- Background decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-10 rounded-full floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white opacity-10 rounded-full floating-animation" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white opacity-5 rounded-full floating-animation" style="animation-delay: -1.5s;"></div>
    </div>

    <div class="h-screen flex flex-col justify-center sm:px-6 lg:px-8 relative z-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-4">
                <div class="mx-auto w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg mb-3">
                    <i class="fas fa-user-circle text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-white mb-1">
                    Welcome Back
                </h2>
                <p class="text-indigo-100 text-base">
                    Sign in to your account
                </p>
            </div>

            @if (session('success'))
                <div class="glass-effect rounded-lg p-3 mb-4 border border-green-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="glass-effect rounded-2xl py-6 px-6 shadow-2xl">
                @if ($errors->any())
                    <div class="bg-red-500 bg-opacity-20 border border-red-300 rounded-lg p-3 mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-400 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-100">There were errors with your submission</h3>
                                <div class="mt-1 text-sm text-red-200">
                                    <ul role="list" class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="space-y-4" action="{{ route('tanent_login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-white mb-1">
                            <i class="fas fa-mobile-alt mr-1"></i>Mobile Number
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input id="mobile" name="mobile" type="text" autocomplete="mobile" required 
                                value="{{ old('mobile') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300 text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-1">
                            <i class="fas fa-lock mr-1"></i>Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300 text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-indigo-300 group-hover:text-indigo-200 transition-colors duration-300"></i>
                            </span>
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="mt-4">
                    <div class="relative">
                       
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-full shadow-lg text-xs">Don't have an account?</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('tanent.register') }}" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-white border-opacity-30 rounded-lg shadow-lg text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all duration-300 transform hover:scale-105">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-white text-opacity-70 group-hover:text-opacity-100 transition-colors duration-300"></i>
                            </span>
                            Create Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>