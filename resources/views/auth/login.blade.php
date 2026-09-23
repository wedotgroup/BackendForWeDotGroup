<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>We Dot Group · Sign In</title>
  <link rel="icon" type="image/png" href="{{ asset('logo/favicon.PNG') }}">

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font Awesome -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
>

<!-- Toastr -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Google Font -->
<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
>

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>

<style>
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
</style>


</head>

<body class="bg-[#011810] min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased">


@if (session('error'))

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            toastr.error(@json(session('error')));
        });
    </script>

@endif




<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 sm:p-10">

    <!-- Logo -->

    <div class="flex items-center justify-center mb-8">

        <img
            src="{{ asset('logo/placeholder.jpg') }}"
            alt="We Dot Group Logo"
            class="h-25 w-20 rounded-full shadow-lg shadow-indigo-600/25 object-cover"
        >

    </div>


    <!-- ================= LOGIN FORM ================= -->

    <form
        id="loginForm"
        action="{{ route('login') }}"
        class="space-y-5"
        method="POST"
    >

        @csrf


        <!-- Email -->

        <div>

            <label
                for="email"
                class="block text-sm font-medium text-slate-700 mb-1.5"
            >
                Email address
            </label>

            <div class="relative">

                <span
                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400"
                >
                    <i class="fas fa-envelope text-sm"></i>
                </span>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Please Enter Your Email"
                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border
                    @error('email')
                        border-red-500
                    @else
                        border-slate-200
                    @enderror
                    rounded-xl text-slate-800 placeholder-slate-400 text-sm
                    focus:outline-none focus:ring-2 focus:ring-[#011810]
                    focus:border-transparent transition-all"
                >

            </div>

            @error('email')

                <span class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </span>

            @enderror

        </div>


        <!-- Password -->

        <div>

            <label
                for="password"
                class="block text-sm font-medium text-slate-700 mb-1.5"
            >
                Password
            </label>

            <div class="relative">

                <span
                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400"
                >
                    <i class="fas fa-lock text-sm"></i>
                </span>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    class="w-full pl-10 pr-12 py-3 bg-slate-50 border
                    @error('password')
                        border-red-500
                    @else
                        border-slate-200
                    @enderror
                    rounded-xl text-slate-800 placeholder-slate-400 text-sm
                    focus:outline-none focus:ring-2 focus:ring-[#011810]
                    focus:border-transparent transition-all"
                >


                <!-- Toggle Password -->

                <button
                    type="button"
                    id="togglePassword"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 focus:outline-none transition"
                    aria-label="Show password"
                >

                    <i
                        id="eyeIcon"
                        class="fas fa-eye text-sm"
                    ></i>

                </button>

            </div>


            @error('password')

                <span class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </span>

            @enderror


            <!-- Client-side password error -->

            

        </div>


        <!-- Forgot Password -->

        <div class="text-right">

            <button
                type="button"
                id="forgotPasswordBtn"
                class="text-sm font-medium text-[#011810] hover:underline"
            >
                Forgot Password?
            </button>

        </div>


        <!-- Submit -->

        <button
            type="submit"
            id="submitBtn"
            class="w-full bg-[#011810] text-white font-semibold py-3
            rounded-xl shadow-lg shadow-indigo-600/20
            hover:bg-[#02251a] transition-all duration-200
            flex items-center justify-center gap-2 text-sm"
        >

            <span id="btnText">
                Sign In
            </span>

            <i
                id="btnIcon"
                class="fas fa-arrow-right text-xs"
            ></i>

        </button>

    </form>

</div>



<div
    id="forgotPasswordModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 px-4 backdrop-blur-sm"
>

    <div
        class="relative w-full max-w-md rounded-2xl bg-white p-6 sm:p-8 shadow-2xl"
    >

        <!-- Close -->

        <button
            type="button"
            id="closeForgotPassword"
            class="absolute right-4 top-4 flex h-9 w-9
            items-center justify-center rounded-full bg-slate-100
            text-slate-500 transition hover:bg-slate-200
            hover:text-slate-700"
        >

            <i class="fas fa-times"></i>

        </button>


        <!-- Icon -->

        <div class="mb-5 flex justify-center">

            <div
                class="flex h-14 w-14 items-center justify-center
                rounded-full bg-[#011810]/10 text-[#011810]"
            >

                <i class="fas fa-key text-xl"></i>

            </div>

        </div>


        <!-- Heading -->

        <div class="mb-6 text-center">

            <h2 class="text-2xl font-bold text-slate-900">
                Forgot Password?
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Enter your registered email address and we'll send you
                a password reset link.
            </p>

        </div>


        <!-- Forgot Password Form -->

        <form
            action="{{ route('admin.forget.password') }}"
            method="POST"
            id="forgotPasswordForm"
            class="space-y-5"
        >

            @csrf


            <!-- Email -->

            <div>

                <label
                    for="forgot_email"
                    class="mb-1.5 block text-sm font-medium text-slate-700"
                >
                    Email Address
                </label>

                <div class="relative">

                    <span
                        class="pointer-events-none absolute inset-y-0 left-0
                        flex items-center pl-3.5 text-slate-400"
                    >

                        <i class="fas fa-envelope text-sm"></i>

                    </span>

                    <input
                        type="email"
                        name="email"
                        id="forgot_email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        class="w-full rounded-xl border border-slate-200
                        bg-slate-50 py-3 pl-10 pr-4 text-sm
                        text-slate-800 outline-none transition-all
                        focus:border-transparent
                        focus:ring-2 focus:ring-[#011810]"
                    >

                </div>

                @error('email')

                    <span class="mt-1.5 flex items-center gap-1 text-xs text-red-500">

                        <i class="fas fa-exclamation-circle"></i>

                        {{ $message }}

                    </span>

                @enderror

            </div>


            <!-- Submit -->

            <button
                type="submit"
                id="resetPasswordBtn"
                class="flex w-full items-center justify-center gap-2
                rounded-xl bg-[#011810] py-3 text-sm font-semibold
                text-white shadow-lg transition-all
                hover:bg-[#02251a]"
            >

                <i
                    id="resetBtnIcon"
                    class="fas fa-paper-plane text-xs"
                ></i>

                <span id="resetBtnText">
                    Send Reset Link
                </span>

            </button>

        </form>


        <!-- Back -->

        <div class="mt-5 text-center">

            <button
                type="button"
                id="cancelForgotPassword"
                class="text-sm text-slate-500 hover:text-[#011810]"
            >
                Cancel
            </button>

        </div>

    </div>

</div>



<script>

    document.addEventListener('DOMContentLoaded', function () {

    

        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function () {

            const isPassword =
                passwordInput.getAttribute('type') === 'password';

            passwordInput.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );

            if (isPassword) {

                eyeIcon.classList.remove('fa-eye');

                eyeIcon.classList.add('fa-eye-slash');

                toggleBtn.setAttribute(
                    'aria-label',
                    'Hide password'
                );

            } else {

                eyeIcon.classList.remove('fa-eye-slash');

                eyeIcon.classList.add('fa-eye');

                toggleBtn.setAttribute(
                    'aria-label',
                    'Show password'
                );

            }

        });



        

        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordError = document.getElementById('passwordError');

        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');


        loginForm.addEventListener('submit', function (e) {

            const email = emailInput.value.trim();
            const password = passwordInput.value;

            let isValid = true;


            /* Email validation */

            const emailRegex =
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email || !emailRegex.test(email)) {

                emailInput.classList.add(
                    'border-red-500',
                    'bg-red-50'
                );

                isValid = false;

            }


            /* Password validation */

            if (!password || password.length < 6) {

                passwordInput.classList.add(
                    'border-red-500',
                    'bg-red-50'
                );

                passwordError.classList.remove('hidden');

                passwordError.classList.add('flex');

                isValid = false;

            }


            /* Stop only if client validation fails */

            if (!isValid) {

                e.preventDefault();

                return;

            }


           

            submitBtn.disabled = true;

            submitBtn.classList.add(
                'opacity-80',
                'cursor-not-allowed'
            );

            btnText.textContent = 'Signing in...';

            btnIcon.className =
                'fas fa-circle-notch fa-spin text-xs';

        });



        /* Clear password error */

        passwordInput.addEventListener('input', function () {

            if (passwordInput.value.length >= 6) {

                passwordInput.classList.remove(
                    'border-red-500',
                    'bg-red-50'
                );

                passwordError.classList.add('hidden');

                passwordError.classList.remove('flex');

            }

        });



        /* Clear email error */

        emailInput.addEventListener('input', function () {

            emailInput.classList.remove(
                'border-red-500',
                'bg-red-50'
            );

        });




        const forgotPasswordBtn =
            document.getElementById('forgotPasswordBtn');

        const forgotPasswordModal =
            document.getElementById('forgotPasswordModal');

        const closeForgotPassword =
            document.getElementById('closeForgotPassword');

        const cancelForgotPassword =
            document.getElementById('cancelForgotPassword');


        /* Open */

        forgotPasswordBtn.addEventListener('click', function () {

            forgotPasswordModal.classList.remove('hidden');

            forgotPasswordModal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

            setTimeout(function () {

                document
                    .getElementById('forgot_email')
                    .focus();

            }, 100);

        });


        /* Close function */

        function closeForgotModal() {

            forgotPasswordModal.classList.add('hidden');

            forgotPasswordModal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }


        /* Close button */

        closeForgotPassword.addEventListener(
            'click',
            closeForgotModal
        );


        /* Cancel */

        cancelForgotPassword.addEventListener(
            'click',
            closeForgotModal
        );


        /* Click outside */

        forgotPasswordModal.addEventListener(
            'click',
            function (e) {

                if (e.target === forgotPasswordModal) {

                    closeForgotModal();

                }

            }
        );


        /* ESC */

        document.addEventListener(
            'keydown',
            function (e) {

                if (e.key === 'Escape') {

                    closeForgotModal();

                }

            }
        );



        const forgotPasswordForm =
            document.getElementById('forgotPasswordForm');

        const resetPasswordBtn =
            document.getElementById('resetPasswordBtn');

        const resetBtnText =
            document.getElementById('resetBtnText');

        const resetBtnIcon =
            document.getElementById('resetBtnIcon');


        forgotPasswordForm.addEventListener(
            'submit',
            function () {

                resetPasswordBtn.disabled = true;

                resetPasswordBtn.classList.add(
                    'opacity-80',
                    'cursor-not-allowed'
                );

                resetBtnText.textContent =
                    'Sending...';

                resetBtnIcon.className =
                    'fas fa-circle-notch fa-spin text-xs';

            }
        );

    });

</script>

</body>

</html>
