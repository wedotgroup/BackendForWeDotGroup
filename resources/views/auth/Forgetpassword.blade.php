<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md">

            <!-- Card -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">

                <!-- Icon -->
                <div class="flex justify-center mb-5">
                    <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center">
                        <svg class="w-7 h-7 text-[#011810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <!-- Heading -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Reset Password
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Enter your new password below.
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.forget.password') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>

                        <input type="email" id="email" name="email" placeholder="Enter your email"  value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300 
                                   bg-white py-3 px-4 text-sm
                                   text-gray-900 outline-none
                                   focus:border-[#011810]
                                   focus:ring-2 focus:ring-green-100">
                                   @error('email')
                                       <span class="text-red-600 text-sm">{{ $message }}</span>
                                   @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password
                        </label>

                        <div class="relative">

                            <input type="password" id="password" name="password" placeholder="Enter new password"
                                value="{{ old('password') }}"
                                class="w-full rounded-lg border border-gray-300
                                       bg-white py-3 pl-4 pr-12 text-sm
                                       text-gray-900 outline-none
                                       focus:border-[#011810]
                                       focus:ring-2 focus:ring-green-100">
                                        @error('password')
                                       <span class="text-red-600 text-sm">{{ $message }}</span>
                                   @enderror

                            <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-700">
                                <svg id="passwordIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>

                        <div class="relative">

                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm your password" 
                                class="w-full rounded-lg border border-gray-300
                                       bg-white py-3 pl-4 pr-12 text-sm
                                       text-gray-900 outline-none
                                       focus:border-[#011810]
                                       focus:ring-2 focus:ring-green-100">
                                       @error('password_confirmation')
                                           <span class="text-red-600 text-sm">{{ $message }}</span>
                                       @enderror

                            <button type="button" onclick="togglePassword('password_confirmation', 'confirmIcon')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-700">
                                <svg id="confirmIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full rounded-lg bg-[#011810] px-4 py-3
                               text-sm font-semibold text-white
                               transition hover:bg-[#E1C562]
                               focus:outline-none focus:ring-2
                               focus:ring-[#011810] focus:ring-offset-2">
                        Reset Password
                    </button>

                </form>

                <!-- Back to Login -->
                <div class="mt-6 text-center">
                    <a href="/"
                        class="inline-flex items-center gap-2 text-sm
                               font-medium text-gray-600
                               hover:text-[#011810] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>

                        Back to Login
                    </a>
                </div>

            </div>

        </div>

    </div>


    <script>
        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {

                input.type = "text";

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19
                        c-4.478 0-8.268-2.943-9.542-7
                        a9.956 9.956 0 012.107-3.592
                        M6.228 6.228
                        A9.953 9.953 0 0112 5
                        c4.478 0 8.268 2.943 9.542 7
                        a9.97 9.97 0 01-4.132 5.411
                        M6.228 6.228L3 3
                        m3.228 3.228l11.544 11.544
                        M9.88 9.88A3 3 0 0014.12 14.12"
                    />
                `;

            } else {

                input.type = "password";

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5
                        c4.478 0 8.268 2.943 9.542 7
                        -1.274 4.057-5.064 7-9.542 7
                        -4.477 0-8.268-2.943-9.542-7z"
                    />
                `;
            }
        }
    </script>

</body>

</html>
