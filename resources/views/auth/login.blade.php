<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Dot Group · Sign In</title>
    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>



<body class="bg-[#011810] min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased">
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}")
        </script>
    @endif
    <!-- ===== LOGIN CARD ===== -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 sm:p-10">

        <div class="flex items-center justify-center mb-8">
            <img src="{{ asset('logo/placeholder.jpg') }}" alt="We Dot Group Logo"
                class="h-25 w-20 rounded-full shadow-lg shadow-indigo-600/25 object-cover">
        </div>

        <!-- ===== LOGIN FORM ===== -->
        <form action="{{ route('login') }}" class="space-y-5" method="POST">
            @csrf
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fas fa-envelope text-sm"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Please Enter Your Email"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border @error('email') border-red-700
                        @enderror border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('email')
                        <span class="text-xs text-red-500 mt-1.5 flex items-center gap-1">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fas fa-lock text-sm"></i>
                    </span>
                    <input type="password" id="password" name="password" placeholder="••••••••"
                        autocomplete="current-password" value="{{ old('password') }}"
                        class="w-full pl-10 pr-12 py-3 bg-slate-50 border @error('password') border-red-700

                        @enderror border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('password')
                        <span class="text-xs text-red-500 mt-1.5 flex items-center gap-1">{{ $message }}</span>
                    @enderror

                    <!-- Toggle password visibility -->
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 focus:outline-none transition"
                        aria-label="Show password">
                        <i id="eyeIcon" class="fas fa-eye text-sm"></i>
                    </button>
                </div>
                <p id="passwordError" class="hidden text-xs text-red-500 mt-1.5 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i> <span>Password must be at least 6 characters.</span>
                </p>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-[#011810]  text-white font-semibold py-3 rounded-xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-700/30 transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                <span id="btnText">Sign In</span>
                <i id="btnIcon" class="fas fa-arrow-right text-xs"></i>
            </button>

        </form>

    </div>

    <!-- ========== JAVASCRIPT ========== -->
    <script>
        (function() {
            // ---- Password visibility toggle ----
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'text') {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                    toggleBtn.setAttribute('aria-label', 'Hide password');
                } else {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                    toggleBtn.setAttribute('aria-label', 'Show password');
                }
            });

            // ---- Form validation & submission ----
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            function showError(element, errorElement) {
                element.classList.add('border-red-400', 'bg-red-50');
                element.classList.remove('border-slate-200', 'bg-slate-50');
                errorElement.classList.remove('hidden');
            }

            function clearError(element, errorElement) {
                element.classList.remove('border-red-400', 'bg-red-50');
                element.classList.add('border-slate-200', 'bg-slate-50');
                errorElement.classList.add('hidden');
            }

            emailInput.addEventListener('input', () => clearError(emailInput, emailError));
            passwordInput.addEventListener('input', () => clearError(passwordInput, passwordError));

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let isValid = true;
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email || !emailRegex.test(email)) {
                    showError(emailInput, emailError);
                    isValid = false;
                }

                if (!password || password.length < 6) {
                    showError(passwordInput, passwordError);
                    isValid = false;
                }

                if (!isValid) return;

                // ---- Simulate login ----
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
                btnText.textContent = 'Signing in...';
                btnIcon.className = 'fas fa-circle-notch fa-spin text-xs';

                setTimeout(() => {
                    submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    submitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                    btnText.textContent = 'Success!';
                    btnIcon.className = 'fas fa-check-circle text-xs';

                    setTimeout(() => {
                        alert('✅ Login successful! Redirecting...');
                        // window.location.href = '/admin/dashboard';
                    }, 300);
                }, 1200);
            });
        })();
    </script>
</body>

</html>
