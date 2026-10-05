@extends('layouts.master')

@section('content')

<div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">
            Add About Us
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create and manage your website About Us content.
        </p>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100">
                    <i class="fas fa-check text-emerald-600"></i>
                </div>

                <p class="text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif


    {{-- ALL VALIDATION ERRORS --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif


    {{-- FORM --}}
    <form
        action="{{ route('admin.about.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-10"
        autocomplete="off">

        @csrf

        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-lg font-bold text-slate-900">
                    1. Heading Section
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Main heading and buttons for the About Us page.
                </p>
            </div>


            <div class="mt-6 grid gap-5 sm:grid-cols-2">

                {{-- Slug --}}
                <div class="sm:col-span-2">

                    <label for="slugtext"
                           class="block text-sm font-medium text-slate-700">
                        Slug Text
                    </label>

                    <input
                        id="slugtext"
                        name="slugtext"
                        type="text"
                        value="{{ old('slugtext') }}"
                        placeholder="e.g. about-us"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none transition
                        {{ $errors->has('slugtext')
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-100'
                            : 'border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100' }}"
                    >

                    @error('slugtext')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Heading --}}
                <div class="sm:col-span-2">

                    <label for="heading"
                           class="block text-sm font-medium text-slate-700">
                        Heading
                    </label>

                    <input
                        id="heading"
                        name="heading"
                        type="text"
                        value="{{ old('heading') }}"
                        placeholder="Enter main heading"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none transition
                        {{ $errors->has('heading')
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-100'
                            : 'border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100' }}"
                    >

                    @error('heading')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Small Text --}}
                <div class="sm:col-span-2">

                    <label for="smallText"
                           class="block text-sm font-medium text-slate-700">
                        Small Text
                    </label>

                    <input
                        id="smallText"
                        name="smallText"
                        type="text"
                        value="{{ old('smallText') }}"
                        placeholder="Enter small text"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none transition
                        {{ $errors->has('smallText')
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-100'
                            : 'border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100' }}"
                    >

                    @error('smallText')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Button 1 --}}
                <div>

                    <label for="button1"
                           class="block text-sm font-medium text-slate-700">
                        Button Text (1)
                    </label>

                    <input
                        id="button1"
                        name="button1"
                        type="text"
                        value="{{ old('button1') }}"
                        placeholder="Get Started"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none transition
                        {{ $errors->has('button1')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('button1')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Button 2 --}}
                <div>

                    <label for="button2"
                           class="block text-sm font-medium text-slate-700">
                        Button Text (2)
                    </label>

                    <input
                        id="button2"
                        name="button2"
                        type="text"
                        value="{{ old('button2') }}"
                        placeholder="Learn More"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none transition
                        {{ $errors->has('button2')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('button2')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =========================================================
             2. ABOUT COMPANY
        ========================================================== --}}
        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-lg font-bold text-slate-900">
                    2. About Company
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Add your company information and description.
                </p>
            </div>


            <div class="mt-6 grid gap-5 sm:grid-cols-2">

                {{-- About Title --}}
                <div>

                    <label for="aboutTitle"
                           class="block text-sm font-medium text-slate-700">
                        Title
                    </label>

                    <input
                        id="aboutTitle"
                        name="aboutTitle"
                        type="text"
                        value="{{ old('aboutTitle') }}"
                        placeholder="About Us"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('aboutTitle')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('aboutTitle')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- About Image --}}
                <div>

                    <label for="aboutImage"
                           class="block text-sm font-medium text-slate-700">
                        Image
                    </label>

                    <input
                        id="aboutImage"
                        name="aboutImage"
                        type="file"
                        accept="image/*"
                        class="mt-1 w-full rounded-lg border px-3 py-2 text-sm outline-none
                        file:mr-3 file:rounded file:border-0 file:bg-indigo-50
                        file:px-3 file:py-1 file:text-sm file:font-medium
                        file:text-indigo-700 hover:file:bg-indigo-100
                        {{ $errors->has('aboutImage')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('aboutImage')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <div id="aboutImagePreview" class="mt-3 hidden">
                        <img
                            src=""
                            alt="About image preview"
                            class="h-24 w-auto rounded-lg object-cover ring-1 ring-slate-200"
                        >
                    </div>

                </div>


                {{-- About Heading --}}
                <div class="sm:col-span-2">

                    <label for="aboutHeading"
                           class="block text-sm font-medium text-slate-700">
                        Heading
                    </label>

                    <input
                        id="aboutHeading"
                        name="aboutHeading"
                        type="text"
                        value="{{ old('aboutHeading') }}"
                        placeholder="Who We Are"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('aboutHeading')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('aboutHeading')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- About Paragraph --}}
                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-slate-700">
                        Paragraph
                    </label>

                    <div
                        id="editor-aboutParagraph"
                        class="mt-1 rounded-lg border border-slate-300 bg-white">
                    </div>

                    <input
                        type="hidden"
                        name="aboutParagraph"
                        id="aboutParagraph"
                        value="{{ old('aboutParagraph') }}"
                    >

                    @error('aboutParagraph')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- About Button --}}
                <div class="sm:col-span-2">

                    <label for="aboutButton"
                           class="block text-sm font-medium text-slate-700">
                        Button Text
                    </label>

                    <input
                        id="aboutButton"
                        name="aboutButton"
                        type="text"
                        value="{{ old('aboutButton') }}"
                        placeholder="Read More"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('aboutButton')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('aboutButton')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =========================================================
             3. OUR MISSION
        ========================================================== --}}
        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-lg font-bold text-slate-900">
                    3. Our Mission
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Define your company's mission.
                </p>
            </div>


            <div class="mt-6 grid gap-5 sm:grid-cols-2">

                {{-- Mission Icon --}}
                <div>

                    <label for="missionIcon"
                           class="block text-sm font-medium text-slate-700">
                        Icon
                    </label>

                    <input
                        id="missionIcon"
                        name="missionIcon"
                        type="text"
                        value="{{ old('missionIcon') }}"
                        placeholder="e.g. fas fa-bullseye"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('missionIcon')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('missionIcon')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Mission Heading --}}
                <div>

                    <label for="missionHeading"
                           class="block text-sm font-medium text-slate-700">
                        Heading
                    </label>

                    <input
                        id="missionHeading"
                        name="missionHeading"
                        type="text"
                        value="{{ old('missionHeading') }}"
                        placeholder="Our Mission"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('missionHeading')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('missionHeading')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Mission Paragraph --}}
                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-slate-700">
                        Paragraph
                    </label>

                    <div
                        id="editor-missionParagraph"
                        class="mt-1 rounded-lg border border-slate-300 bg-white">
                    </div>

                    <input
                        type="hidden"
                        name="missionParagraph"
                        id="missionParagraph"
                        value="{{ old('missionParagraph') }}"
                    >

                    @error('missionParagraph')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =========================================================
             4. OUR VISION
        ========================================================== --}}
        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-lg font-bold text-slate-900">
                    4. Our Vision
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Define your company's vision.
                </p>
            </div>


            <div class="mt-6 grid gap-5 sm:grid-cols-2">

                {{-- Vision Icon --}}
                <div>

                    <label for="visionIcon"
                           class="block text-sm font-medium text-slate-700">
                        Icon
                    </label>

                    <input
                        id="visionIcon"
                        name="visionIcon"
                        type="text"
                        value="{{ old('visionIcon') }}"
                        placeholder="e.g. fas fa-eye"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('visionIcon')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('visionIcon')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Vision Heading --}}
                <div>

                    <label for="visionHeading"
                           class="block text-sm font-medium text-slate-700">
                        Heading
                    </label>

                    <input
                        id="visionHeading"
                        name="visionHeading"
                        type="text"
                        value="{{ old('visionHeading') }}"
                        placeholder="Our Vision"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('visionHeading')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('visionHeading')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Vision Paragraph --}}
                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-slate-700">
                        Paragraph
                    </label>

                    <div
                        id="editor-visionParagraph"
                        class="mt-1 rounded-lg border border-slate-300 bg-white">
                    </div>

                    <input
                        type="hidden"
                        name="visionParagraph"
                        id="visionParagraph"
                        value="{{ old('visionParagraph') }}"
                    >

                    @error('visionParagraph')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =========================================================
             5. ABOUT FOUNDER
        ========================================================== --}}
        <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-lg font-bold text-slate-900">
                    5. About Founder
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Add founder information, description and statistics.
                </p>
            </div>


            <div class="mt-6 grid gap-5 sm:grid-cols-2">

                {{-- Founder Title --}}
                <div>

                    <label for="founderTitle"
                           class="block text-sm font-medium text-slate-700">
                        Title
                    </label>

                    <input
                        id="founderTitle"
                        name="founderTitle"
                        type="text"
                        value="{{ old('founderTitle') }}"
                        placeholder="Meet Our Founder"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('founderTitle')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderTitle')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Founder Heading --}}
                <div>

                    <label for="founderHeading"
                           class="block text-sm font-medium text-slate-700">
                        Heading
                    </label>

                    <input
                        id="founderHeading"
                        name="founderHeading"
                        type="text"
                        value="{{ old('founderHeading') }}"
                        placeholder="A Word From Our Founder"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('founderHeading')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderHeading')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Founder Image --}}
                <div>

                    <label for="founderImage"
                           class="block text-sm font-medium text-slate-700">
                        Founder Image
                    </label>

                    <input
                        id="founderImage"
                        name="founderImage"
                        type="file"
                        accept="image/*"
                        class="mt-1 w-full rounded-lg border px-3 py-2 text-sm outline-none
                        file:mr-3 file:rounded file:border-0 file:bg-indigo-50
                        file:px-3 file:py-1 file:text-sm file:font-medium
                        file:text-indigo-700 hover:file:bg-indigo-100
                        {{ $errors->has('founderImage')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderImage')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <div id="founderImagePreview" class="mt-3 hidden">
                        <img
                            src=""
                            alt="Founder image preview"
                            class="h-24 w-auto rounded-lg object-cover ring-1 ring-slate-200"
                        >
                    </div>

                </div>


                {{-- Founder Name --}}
                <div>

                    <label for="founderName"
                           class="block text-sm font-medium text-slate-700">
                        Founder Name
                    </label>

                    <input
                        id="founderName"
                        name="founderName"
                        type="text"
                        value="{{ old('founderName') }}"
                        placeholder="John Doe"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('founderName')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderName')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Short Description --}}
                <div class="sm:col-span-2">

                    <label for="founderShortDesc"
                           class="block text-sm font-medium text-slate-700">
                        Short Description
                    </label>

                    <input
                        id="founderShortDesc"
                        name="founderShortDesc"
                        type="text"
                        value="{{ old('founderShortDesc') }}"
                        placeholder="Founder & CEO"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('founderShortDesc')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderShortDesc')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Founder Paragraph --}}
                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-slate-700">
                        Founder Paragraph
                    </label>

                    <div
                        id="editor-founderParagraph"
                        class="mt-1 rounded-lg border border-slate-300 bg-white">
                    </div>

                    <input
                        type="hidden"
                        name="founderParagraph"
                        id="founderParagraph"
                        value="{{ old('founderParagraph') }}"
                    >

                    @error('founderParagraph')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Founder Note --}}
                <div class="sm:col-span-2">

                    <label for="founderNote"
                           class="block text-sm font-medium text-slate-700">
                        Note
                    </label>

                    <input
                        id="founderNote"
                        name="founderNote"
                        type="text"
                        value="{{ old('founderNote') }}"
                        placeholder="Available for talks"
                        class="mt-1 w-full rounded-lg border px-3 py-2.5 text-sm outline-none
                        {{ $errors->has('founderNote')
                            ? 'border-red-500'
                            : 'border-slate-300' }}"
                    >

                    @error('founderNote')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- FOUNDER STATS --}}
            <div class="mt-8 border-t border-slate-200 pt-8">

                <h3 class="text-base font-bold text-slate-900">
                    Founder Stats
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Add three statistics displayed on the website.
                </p>


                <div class="mt-5 grid gap-5 sm:grid-cols-3">

                    {{-- STAT 1 --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <div class="mb-4 flex items-center gap-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-600">
                                1
                            </span>

                            <span class="text-sm font-semibold text-slate-700">
                                Statistic 1
                            </span>
                        </div>


                        <label for="statTitle1"
                               class="block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Title
                        </label>

                        <input
                            id="statTitle1"
                            name="statTitle1"
                            type="text"
                            value="{{ old('statTitle1') }}"
                            placeholder="Experience"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm outline-none
                            {{ $errors->has('statTitle1')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statTitle1')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror


                        <label for="statValue1"
                               class="mt-4 block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Value
                        </label>

                        <input
                            id="statValue1"
                            name="statValue1"
                            type="text"
                            value="{{ old('statValue1') }}"
                            placeholder="15+"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm font-semibold outline-none
                            {{ $errors->has('statValue1')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statValue1')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STAT 2 --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <div class="mb-4 flex items-center gap-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-600">
                                2
                            </span>

                            <span class="text-sm font-semibold text-slate-700">
                                Statistic 2
                            </span>
                        </div>


                        <label for="statTitle2"
                               class="block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Title
                        </label>

                        <input
                            id="statTitle2"
                            name="statTitle2"
                            type="text"
                            value="{{ old('statTitle2') }}"
                            placeholder="Projects"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm outline-none
                            {{ $errors->has('statTitle2')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statTitle2')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror


                        <label for="statValue2"
                               class="mt-4 block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Value
                        </label>

                        <input
                            id="statValue2"
                            name="statValue2"
                            type="text"
                            value="{{ old('statValue2') }}"
                            placeholder="320"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm font-semibold outline-none
                            {{ $errors->has('statValue2')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statValue2')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STAT 3 --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <div class="mb-4 flex items-center gap-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-600">
                                3
                            </span>

                            <span class="text-sm font-semibold text-slate-700">
                                Statistic 3
                            </span>
                        </div>


                        <label for="statTitle3"
                               class="block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Title
                        </label>

                        <input
                            id="statTitle3"
                            name="statTitle3"
                            type="text"
                            value="{{ old('statTitle3') }}"
                            placeholder="Clients"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm outline-none
                            {{ $errors->has('statTitle3')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statTitle3')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror


                        <label for="statValue3"
                               class="mt-4 block text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Value
                        </label>

                        <input
                            id="statValue3"
                            name="statValue3"
                            type="text"
                            value="{{ old('statValue3') }}"
                            placeholder="180+"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm font-semibold outline-none
                            {{ $errors->has('statValue3')
                                ? 'border-red-500'
                                : 'border-slate-300' }}"
                        >

                        @error('statValue3')
                            <p class="mt-1 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
             BUTTONS
        ========================================================== --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

            <button
                type="reset"
                id="resetBtn"
                class="rounded-lg border border-slate-300 bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Reset
            </button>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                <i class="fas fa-save"></i>

                Save Content

            </button>

        </div>

    </form>

</div>


{{-- ================================================================
     CKEDITOR
================================================================ --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let aboutEditor;
    let missionEditor;
    let visionEditor;
    let founderEditor;


    /*
    |--------------------------------------------------------------------------
    | CKEditor Helper
    |--------------------------------------------------------------------------
    */

    function createEditor(elementId, hiddenInputId) {

        const element = document.getElementById(elementId);
        const hiddenInput = document.getElementById(hiddenInputId);

        if (!element || !hiddenInput) {
            return null;
        }

        return ClassicEditor
            .create(element)
            .then(editor => {

                // Restore old value after validation failure
                editor.setData(hiddenInput.value || '');

                // Keep hidden input synchronized
                editor.model.document.on('change:data', () => {
                    hiddenInput.value = editor.getData();
                });

                return editor;
            })
            .catch(error => {
                console.error('CKEditor error:', error);
                return null;
            });
    }


    /*
    |--------------------------------------------------------------------------
    | Initialize Editors
    |--------------------------------------------------------------------------
    */

    createEditor('editor-aboutParagraph', 'aboutParagraph')
        .then(editor => {
            aboutEditor = editor;
        });

    createEditor('editor-missionParagraph', 'missionParagraph')
        .then(editor => {
            missionEditor = editor;
        });

    createEditor('editor-visionParagraph', 'visionParagraph')
        .then(editor => {
            visionEditor = editor;
        });

    createEditor('editor-founderParagraph', 'founderParagraph')
        .then(editor => {
            founderEditor = editor;
        });


    /*
    |--------------------------------------------------------------------------
    | Image Preview Helper
    |--------------------------------------------------------------------------
    */

    function imagePreview(inputId, previewId) {

        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        if (!input || !preview) {
            return;
        }

        const image = preview.querySelector('img');

        input.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                preview.classList.add('hidden');
                image.removeAttribute('src');
                return;
            }

            if (!file.type.startsWith('image/')) {
                preview.classList.add('hidden');
                image.removeAttribute('src');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                image.src = event.target.result;
                preview.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Image Previews
    |--------------------------------------------------------------------------
    */

    imagePreview(
        'aboutImage',
        'aboutImagePreview'
    );

    imagePreview(
        'founderImage',
        'founderImagePreview'
    );


    /*
    |--------------------------------------------------------------------------
    | Form Submit
    |--------------------------------------------------------------------------
    */

    const form = document.querySelector('form');

    if (form) {

        form.addEventListener('submit', function () {

            if (aboutEditor) {
                document.getElementById('aboutParagraph').value =
                    aboutEditor.getData();
            }

            if (missionEditor) {
                document.getElementById('missionParagraph').value =
                    missionEditor.getData();
            }

            if (visionEditor) {
                document.getElementById('visionParagraph').value =
                    visionEditor.getData();
            }

            if (founderEditor) {
                document.getElementById('founderParagraph').value =
                    founderEditor.getData();
            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    const resetBtn = document.getElementById('resetBtn');

    if (resetBtn) {

        resetBtn.addEventListener('click', function () {

            setTimeout(function () {

                if (aboutEditor) {
                    aboutEditor.setData('');
                }

                if (missionEditor) {
                    missionEditor.setData('');
                }

                if (visionEditor) {
                    visionEditor.setData('');
                }

                if (founderEditor) {
                    founderEditor.setData('');
                }


                document
                    .querySelectorAll('[id$="ImagePreview"]')
                    .forEach(preview => {
                        preview.classList.add('hidden');

                        const image = preview.querySelector('img');

                        if (image) {
                            image.removeAttribute('src');
                        }
                    });

            }, 50);

        });

    }

});
</script>

@endsection
