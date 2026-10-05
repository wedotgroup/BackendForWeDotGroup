@extends('layouts.master')

@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif

    <div class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-800">About Us</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Manage your website About Us content.
                </p>
            </div>

            <a href="{{ route('admin.about.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add New
            </a>
        </div>


        {{-- Main Card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Toolbar --}}
            <div
                class="flex flex-col gap-3 border-b border-slate-200 bg-white p-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        About Us Records
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        View and manage all About Us sections.
                    </p>
                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1600px] text-left text-sm">

                    {{-- =========================================================
            TABLE HEADER
        ========================================================== --}}
                    <thead class="border-b border-slate-200 bg-slate-50">

                        {{-- Grouped Header --}}
                        <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">

                            <th rowspan="2" class="border-r border-slate-200 px-4 py-3 text-center">
                                #
                            </th>

                            <th colspan="5" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                Heading Section
                            </th>

                            <th colspan="5" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                About Company
                            </th>

                            <th colspan="3" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                Mission
                            </th>

                            <th colspan="3" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                Vision
                            </th>

                            <th colspan="7" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                Founder
                            </th>

                            <th colspan="6" class="border-r border-slate-200 px-4 py-3 text-indigo-600">
                                Stats
                            </th>

                            <th colspan="3" class="px-4 py-3 text-indigo-600">
                                Action
                            </th>

                        </tr>


                        {{-- Individual Header --}}
                        <tr class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">

                            {{-- ================= Heading ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                Slug
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Heading
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Small Text
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Btn 1
                            </th>

                            <th class="border-r border-slate-200 whitespace-nowrap px-4 py-2.5">
                                Btn 2
                            </th>


                            {{-- ================= About ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                Title
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Image
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Heading
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Paragraph
                            </th>

                            <th class="border-r border-slate-200 whitespace-nowrap px-4 py-2.5">
                                Btn
                            </th>


                            {{-- ================= Mission ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                Icon
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Heading
                            </th>

                            <th class="border-r border-slate-200 whitespace-nowrap px-4 py-2.5">
                                Paragraph
                            </th>


                            {{-- ================= Vision ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                Icon
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Heading
                            </th>

                            <th class="border-r border-slate-200 whitespace-nowrap px-4 py-2.5">
                                Paragraph
                            </th>


                            {{-- ================= Founder ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                Title
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Heading
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Image
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Name
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Short Desc
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Paragraph
                            </th>

                            <th class="border-r border-slate-200 whitespace-nowrap px-4 py-2.5">
                                Note
                            </th>


                            {{-- ================= Stats ================= --}}
                            <th class="whitespace-nowrap px-4 py-2.5">
                                T1
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                V1
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                T2
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                V2
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                T3
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                V3
                            </th>


                            

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Edit
                            </th>

                            <th class="whitespace-nowrap px-4 py-2.5">
                                Delete
                            </th>

                        </tr>

                    </thead>


                    {{-- =========================================================
            TABLE BODY
        ========================================================== --}}
                    <tbody class="divide-y divide-slate-100">

                        @foreach ($aboutUs as $key => $Aboutdata)
                            @php

                                $herosection = json_decode($Aboutdata->hero_section, true) ?? [];

                                $aboutComapny = json_decode($Aboutdata->about_company, true) ?? [];

                                $mission = json_decode($Aboutdata->mission, true) ?? [];

                                $vision = json_decode($Aboutdata->vision, true) ?? [];

                                $founder = json_decode($Aboutdata->ceo_message, true) ?? [];

                            @endphp


                            <tr class="transition hover:bg-indigo-50/40">


                                {{-- =================================================
                        #
                    ================================================== --}}
                                <td
                                    class="border-r border-slate-100 px-4 py-4 text-center align-top text-xs font-semibold text-slate-400">
                                    {{ $key + 1 }}
                                </td>


                                {{-- =================================================
                        HEADING SECTION
                    ================================================== --}}

                                {{-- Slug --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[140px] truncate text-slate-700"
                                        title="{{ $herosection['slugtext'] ?? '' }}">
                                        {{ $herosection['slugtext'] ?? 'N/A' }}
                                    </div>
                                </td>


                                {{-- Heading --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[160px] truncate text-slate-700"
                                        title="{{ $herosection['heading'] ?? '' }}">
                                        {{ $herosection['heading'] ?? 'N/A' }}
                                    </div>
                                </td>


                                {{-- Small Text --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[160px] truncate text-slate-600"
                                        title="{{ $herosection['smalltext'] ?? '' }}">
                                        {{ Str::limit($herosection['smalltext'] ?? '', 20) }}
                                    </div>
                                </td>


                                {{-- Button 1 --}}
                                <td class="px-4 py-4 align-top">
                                    <span
                                        class="inline-block rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-600">
                                        {{ $herosection['button1'] ?? '' }}
                                    </span>
                                </td>


                                {{-- Button 2 --}}
                                <td class="border-r border-slate-100 px-4 py-4 align-top">
                                    <span
                                        class="inline-block rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">
                                        {{ $herosection['button2'] ?? '' }}
                                    </span>
                                </td>


                                {{-- =================================================
                        ABOUT COMPANY
                    ================================================== --}}

                                {{-- Title --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[120px] truncate font-medium text-slate-700"
                                        title="{{ $aboutComapny['aboutTitle'] ?? '' }}">
                                        {{ $aboutComapny['aboutTitle'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Image --}}
                                <td class="px-4 py-4 align-top">

                                    @if (!empty($aboutComapny['aboutImage']))
                                        <img src="{{ asset($aboutComapny['aboutImage']) }}" alt="About"
                                            class="h-10 w-10 rounded-lg object-cover ring-1 ring-slate-200">
                                    @else
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-xs text-slate-400">
                                            N/A
                                        </div>
                                    @endif

                                </td>


                                {{-- Heading --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[140px] truncate text-slate-700"
                                        title="{{ $aboutComapny['aboutHeading'] ?? '' }}">
                                        {{ $aboutComapny['aboutHeading'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Paragraph --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[180px] truncate text-slate-600"
                                        title="{{ strip_tags($aboutComapny['aboutParagraph'] ?? '') }}">
                                        {{ Str::limit(strip_tags($aboutComapny['aboutParagraph'] ?? ''), 30) }}
                                    </div>
                                </td>


                                {{-- Button --}}
                                <td class="border-r border-slate-100 px-4 py-4 align-top">
                                    <span
                                        class="inline-block rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-600">
                                        {{ $aboutComapny['aboutButton'] ?? '' }}
                                    </span>
                                </td>


                                {{-- =================================================
                        MISSION
                    ================================================== --}}

                                {{-- Icon --}}
                                <td class="px-4 py-4 align-top">

                                    <div class="text-lg text-indigo-600">
                                        {!! $mission['missionIcon'] ?? '' !!}
                                    </div>

                                </td>


                                {{-- Heading --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[120px] truncate text-slate-700"
                                        title="{{ $mission['missionHeading'] ?? '' }}">
                                        {{ $mission['missionHeading'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Paragraph --}}
                                <td class="border-r border-slate-100 px-4 py-4 align-top">
                                    <div class="max-w-[180px] truncate text-slate-600"
                                        title="{{ strip_tags($mission['missionParagraph'] ?? '') }}">
                                        {{ Str::limit(strip_tags($mission['missionParagraph'] ?? ''), 30) }}
                                    </div>
                                </td>


                                {{-- =================================================
                        VISION
                    ================================================== --}}

                                {{-- Icon --}}
                                <td class="px-4 py-4 align-top">

                                    <div class="text-lg text-indigo-600">
                                        {!! $vision['visionIcon'] ?? '' !!}
                                    </div>

                                </td>


                                {{-- Heading --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[120px] truncate text-slate-700"
                                        title="{{ $vision['visionHeading'] ?? '' }}">
                                        {{ $vision['visionHeading'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Paragraph --}}
                                <td class="border-r border-slate-100 px-4 py-4 align-top">
                                    <div class="max-w-[180px] truncate text-slate-600"
                                        title="{{ strip_tags($vision['visionParagraph'] ?? '') }}">
                                        {{ Str::limit(strip_tags($vision['visionParagraph'] ?? ''), 30) }}
                                    </div>
                                </td>


                                {{-- =================================================
                        FOUNDER
                    ================================================== --}}

                                {{-- Title --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[110px] truncate text-slate-700"
                                        title="{{ $founder['founderTitle'] ?? '' }}">
                                        {{ $founder['founderTitle'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Heading --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[130px] truncate text-slate-700"
                                        title="{{ $founder['founderHeading'] ?? '' }}">
                                        {{ $founder['founderHeading'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Image --}}
                                <td class="px-4 py-4 align-top">

                                    @if (!empty($founder['founderImage']))
                                        <img src="{{ asset($founder['founderImage']) }}" alt="Founder"
                                            class="h-10 w-10 rounded-lg object-cover ring-1 ring-slate-200">
                                    @else
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-xs text-slate-400">
                                            N/A
                                        </div>
                                    @endif

                                </td>


                                {{-- Name --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[110px] truncate font-medium text-slate-700"
                                        title="{{ $founder['founderName'] ?? '' }}">
                                        {{ $founder['founderName'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Short Description --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[140px] truncate text-slate-600"
                                        title="{{ $founder['founderShortDesc'] ?? '' }}">
                                        {{ $founder['founderShortDesc'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Paragraph --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="max-w-[180px] truncate text-slate-600"
                                        title="{{ strip_tags($founder['founderParagraph'] ?? '') }}">
                                        {{ Str::limit(strip_tags($founder['founderParagraph'] ?? ''), 30) }}
                                    </div>
                                </td>


                                {{-- Note --}}
                                <td class="border-r border-slate-100 px-4 py-4 align-top">

                                    <span
                                        class="inline-block rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-600">
                                        {{ $founder['founderNote'] ?? '' }}
                                    </span>

                                </td>


                                {{-- =================================================
                        STATS
                    ================================================== --}}

                                {{-- Title 1 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="text-xs text-slate-500">
                                        {{ $founder['statTitle1'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Value 1 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="font-semibold text-slate-700">
                                        {{ $founder['statValue1'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Title 2 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="text-xs text-slate-500">
                                        {{ $founder['statTitle2'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Value 2 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="font-semibold text-slate-700">
                                        {{ $founder['statValue2'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Title 3 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="text-xs text-slate-500">
                                        {{ $founder['statTitle3'] ?? '' }}
                                    </div>
                                </td>


                                {{-- Value 3 --}}
                                <td class="px-4 py-4 align-top">
                                    <div class="font-semibold text-slate-700">
                                        {{ $founder['statValue3'] ?? '' }}
                                    </div>
                                </td>


                                {{-- =================================================
                        ACTION
                    ================================================== --}}

                                
                                </td>


                                {{-- Edit --}}
                                <td class="px-4 py-4 align-top">

                                    <a href="{{ route('admin.about.edit',$Aboutdata->id) }}"
                                        class="inline-flex items-center justify-center rounded-md bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-600 transition hover:bg-indigo-100">

                                        Edit

                                    </a>

                                </td>


                                {{-- Delete --}}
                                <td class="px-4 py-4 align-top">

                                    <form action="{{ route("admin.about.destroy",$Aboutdata->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-md bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-100">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>



            {{-- Footer --}}
            <div
                class="flex flex-col items-center justify-between gap-3 border-t border-slate-200 bg-slate-50 px-4 py-3 sm:flex-row">

                <p class="text-xs text-slate-500">
                    Showing
                    <span class="font-semibold text-slate-700">1</span>
                    –
                    <span class="font-semibold text-slate-700">1</span>
                    of
                    <span class="font-semibold text-slate-700">1</span>
                    records
                </p>


                <div class="flex items-center gap-1">

                    <button type="button" disabled
                        class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-300">
                        Prev
                    </button>

                    <button type="button"
                        class="rounded-lg border border-indigo-600 bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm">
                        1
                    </button>

                    <button type="button" disabled
                        class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-300">
                        Next
                    </button>

                </div>

            </div>

        </div>

    </div>
@endsection
