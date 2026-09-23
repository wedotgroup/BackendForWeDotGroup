@extends('layouts.master')

@section('content')

<div class="min-h-[80vh] flex items-center justify-center px-4 py-8">

<div class="w-full max-w-md">

    {{-- Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">

        {{-- Icon --}}
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center">
                <svg
                    class="w-7 h-7 text-[#011810]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 7a2 2 0 114 0v2a2 2 0 01-2 2h-1m-4-4a2 2 0 11-4 0v2a2 2 0 002 2h1m-4 0v2a4 4 0 004 4h2a4 4 0 004-4v-2"
                    />
                </svg>
            </div>
        </div>

        {{-- Heading --}}
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Forgot Password?
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Enter your registered email address and we'll
                send you a password reset link.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3">
                <p class="text-sm text-green-700">
                    {{ session('status') }}
                </p>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form
            action=
            method="POST"
            class="space-y-5"
        >

            @csrf

            {{-- Email --}}
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Email Address
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg
                            class="w-5 h-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                        class="w-full rounded-lg border border-gray-300
                               bg-white py-3 pl-10 pr-4 text-sm
                               text-gray-900 outline-none
                               transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-100"
                    >

                </div>

                @error('email')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="w-full rounded-lg bg-[#011810] px-4 py-3
                       text-sm font-semibold text-white
                       transition hover:bg-[#E1C562]
                       focus:outline-none focus:ring-2
                       focus:ring-blue-500 focus:ring-offset-2"
            >
                Send Password Reset Link
            </button>

        </form>


        {{-- Back to Login --}}
        <div class="mt-6 text-center">

            <a
                href="{{ route('login') }}"
                class="inline-flex items-center gap-2 text-sm
                       font-medium text-gray-600
                       hover:text-blue-600 transition"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back to Login

            </a>

        </div>

    </div>

</div>

</div>

@endsection
