@extends('layouts.master')

@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Partner Logo Data
        |--------------------------------------------------------------------------
        | PartnerLogo model should have:
        |
        | protected $casts = [
        |     'logos' => 'array',
        | ];
        |
        */

        $raw = $logosdata?->logos ?? [];

        // Safety: if old data is still a JSON string
        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            $raw = is_array($decoded) ? $decoded : [];
        }

        // Make sure we always have an array
        $raw = is_array($raw) ? $raw : [];


        /*
        |--------------------------------------------------------------------------
        | Normalize logos
        |--------------------------------------------------------------------------
        |
        | Supported:
        |
        | Old:
        | [
        |     "logo1.png",
        |     "logo2.jpg"
        | ]
        |
        | New:
        | [
        |     [
        |         "id" => "...",
        |         "filename" => "logo1.png"
        |     ]
        | ]
        |
        */

        $logos = collect($raw)
            ->map(function ($item, $index) {

                if (is_array($item)) {
                    return [
                        'index' => $index,
                        'id' => $item['id'] ?? null,
                        'filename' => $item['filename'] ?? '',
                    ];
                }

                return [
                    'index' => $index,
                    'id' => null,
                    'filename' => (string) $item,
                ];
            })
            ->filter(function ($item) {
                return !empty($item['filename']);
            })
            ->values();

        $total = $logos->count();
    @endphp


    <div class="mx-auto w-full max-w-5xl">

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-2.5 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 ring-1 ring-emerald-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="mt-0.5 h-4 w-4 shrink-0">

                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>

                <span>{{ session('success') }}</span>
            </div>
        @endif


        {{-- Main Card --}}
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">


            {{-- Header --}}
            <div
                class="mb-6 flex flex-col gap-4 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">

                {{-- Title --}}
                <div class="flex items-center gap-3">

                    <div
                        class="relative grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/25">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5 text-white">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />
                        </svg>

                        <span
                            class="absolute -right-1 -top-1 h-3 w-3 rounded-full bg-amber-400 ring-2 ring-white">
                        </span>
                    </div>


                    <div>

                        <div class="flex items-center gap-2">

                            <h1 class="text-lg font-bold tracking-tight text-slate-900 sm:text-xl">
                                Logos
                            </h1>

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-medium text-slate-600 ring-1 ring-slate-200">

                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                {{ $total }} {{ Str::plural('item', $total) }}

                            </span>

                        </div>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Manage all your uploaded brand logos
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex flex-wrap gap-2">

                    @if ($total > 0)

                        {{-- Edit All Logos --}}
                        <a href="{{ route('admin.partner.edit', $logosdata->id) }}"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition duration-200 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 active:scale-[0.98]">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487a2.25 2.25 0 013.182 3.182L8.25 19.463 4.5 20.25l.788-3.75L16.862 4.487z" />
                            </svg>

                            <span>Edit Logos</span>

                        </a>


                        {{-- Delete All Logos --}}
                        <form action="{{ route('admin.partner.destroy', $logosdata->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete all logos?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-red-500/30 transition duration-200 hover:from-red-500 hover:to-rose-500 hover:shadow-red-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-400 focus-visible:ring-offset-2 active:scale-[0.98]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-4 w-4">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 7.5h12m-9 0v10.5m6-10.5v10.5M9 4.5h6l1.5 3h-9l1.5-3z" />
                                </svg>

                                <span>Delete Logos</span>

                            </button>

                        </form>

                    @else

                        {{-- Upload Logo --}}
                        <a href="{{ route('admin.partner.create') }}"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition duration-200 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 active:scale-[0.98]">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4 transition group-hover:rotate-90">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15" />

                            </svg>

                            <span>Upload Logo</span>

                        </a>

                    @endif

                </div>

            </div>


            {{-- Logos --}}
            @if ($total > 0)

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

                    @foreach ($logos as $logo)

                        <div
                            class="group relative flex flex-col rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-500/10">


                            {{-- Image --}}
                            <div
                                class="grid aspect-square w-full place-items-center overflow-hidden rounded-xl border border-slate-100 bg-slate-50 p-2">

                                <img
                                    src="{{ asset('uploads/logos/' . $logo['filename']) }}"
                                    alt="{{ $logo['filename'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-contain">

                            </div>


                            {{-- File name --}}
                            <p
                                class="mt-2 truncate text-[11px] font-medium text-slate-500"
                                title="{{ $logo['filename'] }}">

                                {{ $logo['filename'] }}

                            </p>

                        </div>

                    @endforeach

                </div>


                {{-- Count --}}
                <p class="mt-5 text-xs text-slate-400">

                    Showing
                    <span class="font-semibold text-slate-500">
                        {{ $total }}
                    </span>

                    {{ Str::plural('logo', $total) }}

                </p>

            @else

                {{-- Empty State --}}
                <div
                    class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50/60 px-6 py-14 text-center">

                    <div
                        class="grid h-14 w-14 place-items-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-7 w-7 text-slate-400">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />

                        </svg>

                    </div>


                    <h3 class="mt-4 text-sm font-semibold text-slate-800">
                        No logos uploaded yet
                    </h3>

                    <p class="mt-1 max-w-sm text-xs text-slate-500">
                        Upload your first brand logo to start building your partner showcase.
                    </p>


                    <a href="{{ route('admin.partner.create') }}"
                        class="group mt-5 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition duration-200 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 active:scale-[0.98]">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-4 w-4 transition group-hover:rotate-90">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4.5v15m7.5-7.5h-15" />

                        </svg>

                        <span>Upload Logo</span>

                    </a>

                </div>

            @endif

        </div>

    </div>

@endsection