<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <title>Authentication</title>
</head>

<body>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center mb-6">
                <button id="show-login" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-l-md focus:outline-none">
                    Login
                </button>
                <button id="show-register" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-r-md focus:outline-none">
                    Register
                </button>
            </div>
            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/check-circle -->
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Login Form --}}
        <div id="login-form" class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <h2 class="mb-6 text-center text-3xl font-extrabold text-gray-900">
                    Login
                </h2>
                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4 mb-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
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
                <form class="space-y-6" action="{{ route('tanent_login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-gray-700">
                            Mobile Number
                        </label>
                        <div class="mt-1">
                            <input id="mobile" name="mobile" type="text" autocomplete="mobile" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Registration Form --}}
        <div id="register-form" class="hidden mt-8 sm:mx-auto sm:w-full sm:max-w-md">
             @if (session('show_otp_form'))
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Verify Your Mobile Number
                    </h2>
                    @if (session('mobile'))
                    <p class="mt-2 text-center text-sm text-gray-600">
                        An OTP has been sent to your mobile number: <strong>{{ session('mobile') }}</strong>.
                    </p>
                    @endif
                </div>

                <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                        <form class="space-y-6" action="{{ route('tanent.verify.otp') }}" method="POST">
                            @csrf
                            @if (session('mobile'))
                            <input type="hidden" name="mobile" value="{{ session('mobile') }}">
                            @endif

                            @if ($errors->any())
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800">There were errors with your
                                                submission</h3>
                                            <div class="mt-2 text-sm text-red-700">
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

                            <div>
                                <label for="otp" class="block text-sm font-medium text-gray-700">
                                    OTP
                                </label>
                                <div class="mt-1">
                                    <input id="otp" name="otp" type="text" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Verify OTP
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Tanent Registration
                    </h2>
                </div>

                <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                        @if ($errors->any())
                            <div class="rounded-md bg-red-50 p-4">
                                <div class="flex">
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
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
                        <form class="space-y-6" action="{{ route('tanent.register.post') }}" method="POST">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="mobile" class="block text-sm font-medium text-gray-700">
                                    Mobile
                                </label>
                                <div class="mt-1">
                                    <input id="mobile" name="mobile" type="text" value="{{ old('mobile') }}" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                        value="{{ old('email') }}" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    Address
                                </label>
                                <div class="mt-1">
                                    <input id="address" name="address" type="text" value="{{ old('address') }}"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Retype Password
                                </label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const showLoginBtn = document.getElementById('show-login');
            const showRegisterBtn = document.getElementById('show-register');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            showLoginBtn.addEventListener('click', () => {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                showLoginBtn.classList.remove('bg-white', 'text-gray-700');
                showLoginBtn.classList.add('bg-indigo-600', 'text-white');
                showRegisterBtn.classList.remove('bg-indigo-600', 'text-white');
                showRegisterBtn.classList.add('bg-white', 'text-gray-700');
            });

            showRegisterBtn.addEventListener('click', () => {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                showRegisterBtn.classList.remove('bg-white', 'text-gray-700');
                showRegisterBtn.classList.add('bg-indigo-600', 'text-white');
                showLoginBtn.classList.remove('bg-indigo-600', 'text-white');
                showLoginBtn.classList.add('bg-white', 'text-gray-700');
            });

            // If OTP form is shown, make sure the register form container is visible
            if ({{ session('show_otp_form') ? 'true' : 'false' }}) {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                showRegisterBtn.classList.remove('bg-white', 'text-gray-700');
                showRegisterBtn.classList.add('bg-indigo-600', 'text-white');
                showLoginBtn.classList.remove('bg-indigo-600', 'text-white');
                showLoginBtn.classList.add('bg-white', 'text-gray-700');
            }
        });
    </script>
</body>
</html>
