{{-- resources/views/admin/itconsultancy/index.blade.php --}}
@extends('layouts.master')

@section('content')
    @php
        // ============================================================
        // STATIC SAMPLE DATA — replace with $records from controller
        // ============================================================
        $records = collect([
            (object) [
                'id' => 1,
                'first_heading' => 'Smart IT Solutions For Your Business',
                'small_paragraph' =>
                    '<p>We deliver <strong>end-to-end IT consultancy</strong> that helps your business scale securely.</p>',
                'button1_text' => 'Get Started',
                'button2_text' => 'Our Services',
                'image' => 'it-consultancy/hero-1.jpg',
                'heading' => 'What We Offer',
                'description' =>
                    '<p>Our team of certified engineers builds resilient systems tailored to your needs.</p>',
                'services' => [
                    'Cloud & DevOps Consulting',
                    'Cybersecurity Solutions',
                    'Network Infrastructure',
                    'Data & Analytics',
                    'Managed IT Support',
                    'Software Modernisation',
                ],
                'button3_text' => 'Explore More',
                'status' => 'active',
                'updated_at' => '2026-10-05 14:32:00',
                'items' => [
                    [
                        'image' => 'it-consultancy/network.jpg',
                        'heading' => 'Network Infrastructure',
                        'description' =>
                            '<p>Design, deploy and manage <strong>high-availability networks</strong>.</p>',
                        'link_text' => 'Learn More',
                    ],
                    [
                        'image' => 'it-consultancy/cloud.jpg',
                        'heading' => 'Cloud Migration',
                        'description' => '<p>Seamlessly move workloads to AWS, Azure or GCP.</p>',
                        'link_text' => 'Explore Cloud',
                    ],
                    [
                        'image' => 'it-consultancy/security.jpg',
                        'heading' => 'Cybersecurity',
                        'description' => '<p>Protect your business with layered defence.</p>',
                        'link_text' => 'Read More',
                    ],
                ],
            ],
            (object) [
                'id' => 2,
                'first_heading' => 'Modernise Your Infrastructure',
                'small_paragraph' =>
                    '<p>Upgrade legacy systems to <em>cloud-native</em> architecture with zero downtime.</p>',
                'button1_text' => 'Talk To Us',
                'button2_text' => 'Case Studies',
                'image' => 'it-consultancy/hero-2.jpg',
                'heading' => 'Our Approach',
                'description' => '<p>A phased migration strategy that keeps your business running.</p>',
                'services' => ['Legacy Assessment', 'Cloud Strategy', 'DevOps Enablement', 'Cost Optimisation'],
                'button3_text' => 'Learn More',
                'status' => 'active',
                'updated_at' => '2026-10-03 09:15:00',
                'items' => [
                    [
                        'image' => 'it-consultancy/assess.jpg',
                        'heading' => 'Legacy Assessment',
                        'description' => '<p>Full audit of your current stack.</p>',
                        'link_text' => 'Start Audit',
                    ],
                    [
                        'image' => 'it-consultancy/strategy.jpg',
                        'heading' => 'Cloud Strategy',
                        'description' => '<p>Roadmap for cloud adoption.</p>',
                        'link_text' => 'See Roadmap',
                    ],
                ],
            ],
            (object) [
                'id' => 3,
                'first_heading' => '24/7 Managed IT Support',
                'small_paragraph' =>
                    '<p>Round-the-clock monitoring and support for <strong>mission-critical</strong> systems.</p>',
                'button1_text' => 'Contact Support',
                'button2_text' => 'Pricing',
                'image' => 'it-consultancy/hero-3.jpg',
                'heading' => 'Support Tiers',
                'description' => '<p>Choose the SLA that fits your business size.</p>',
                'services' => ['Basic Monitoring', 'Proactive Maintenance', 'Emergency Response'],
                'button3_text' => 'Compare Plans',
                'status' => 'draft',
                'updated_at' => '2026-09-28 18:47:00',
                'items' => [
                    [
                        'image' => 'it-consultancy/tier1.jpg',
                        'heading' => 'Basic Monitoring',
                        'description' => '<p>24/7 uptime monitoring.</p>',
                        'link_text' => 'Details',
                    ],
                ],
            ],
        ]);
    @endphp

    {{-- ==================== HEADER ==================== --}}
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div class="flex items-center gap-3">
                <span
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </span>
                <div>
                    <h1 class="text-lg font-bold leading-tight tracking-tight text-slate-900 sm:text-xl">
                        IT Consultancy
                    </h1>
                    <p class="text-xs text-slate-500 sm:text-sm">
                        Manage all saved page records
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.itconsultancy.service.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:from-indigo-600 hover:to-violet-700 active:scale-[.98]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add New
            </a>
        </div>
    </header>

    {{-- ==================== BODY ==================== --}}
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:py-10">

        {{-- Flash --}}
        @if (session('success'))
            <div
                class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="mt-0.5 h-4 w-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Toolbar --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:max-w-xs">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor"
                    class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input id="tableSearch" type="text" placeholder="Search records..."
                    class="w-full rounded-xl border border-slate-300 bg-white pl-9 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
            </div>

            <p class="text-xs text-slate-500">
                Showing <span class="font-semibold text-slate-700">{{ $records->count() }}</span> records
            </p>
        </div>

        {{-- ============================================================
             MAIN TABLE — one row per IT Consultancy record
        ============================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/80 text-xs uppercase tracking-wide text-slate-500">
                            <th class="w-12 px-4 py-3 font-semibold sm:px-5">#</th>
                            <th class="w-24 px-4 py-3 font-semibold sm:px-5">Image</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">First Heading</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Section Heading</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Buttons</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Services</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Items</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Status</th>
                            <th class="px-4 py-3 font-semibold sm:px-5">Updated</th>
                            <th class="w-32 px-4 py-3 text-right font-semibold sm:px-5">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($records as $index => $record)
                            @php
                                $services = is_array($record->services)
                                    ? $record->services
                                    : (json_decode($record->services ?? '[]', true) ?:
                                    []);
                                $items = $record->items ?? [];
                            @endphp

                            {{-- MAIN ROW --}}
                            <tr class="record-row group transition hover:bg-indigo-50/40"
                                data-search="{{ strtolower($record->first_heading . ' ' . $record->heading . ' ' . implode(' ', $services)) }}">

                                {{-- # --}}
                                <td class="px-4 py-4 align-middle text-slate-500 sm:px-5">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Image --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    @if (!empty($record->image))
                                        <img src="{{ asset('storage/' . $record->image) }}" alt=""
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                            class="h-12 w-16 rounded-lg object-cover ring-1 ring-slate-200" />
                                        <div style="display:none"
                                            class="h-12 w-16 items-center justify-center rounded-lg border border-dashed border-slate-200 bg-slate-50 text-[10px] text-slate-400">
                                            No img
                                        </div>
                                    @else
                                        <div
                                            class="flex h-12 w-16 items-center justify-center rounded-lg border border-dashed border-slate-200 bg-slate-50 text-[10px] text-slate-400">
                                            No img
                                        </div>
                                    @endif
                                </td>

                                {{-- First Heading --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    <p class="font-semibold text-slate-800 line-clamp-2 max-w-xs">
                                        {{ $record->first_heading }}
                                    </p>
                                </td>

                                {{-- Section Heading --}}
                                <td class="px-4 py-4 align-middle text-slate-600 sm:px-5">
                                    <span class="line-clamp-1">{{ $record->heading }}</span>
                                </td>

                                {{-- Buttons --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    <div class="flex flex-wrap gap-1.5 max-w-[180px]">
                                        @if ($record->button1_text)
                                            <span
                                                class="rounded-md bg-indigo-50 px-2 py-0.5 text-[11px] font-semibold text-indigo-700 ring-1 ring-indigo-100">
                                                {{ $record->button1_text }}
                                            </span>
                                        @endif
                                        @if ($record->button2_text)
                                            <span
                                                class="rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600 ring-1 ring-slate-200">
                                                {{ $record->button2_text }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Services count --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.4" stroke="currentColor" class="h-3 w-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        {{ count($services) }}
                                    </span>
                                </td>

                                {{-- Items count --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-2.5 py-0.5 text-xs font-semibold text-violet-700 ring-1 ring-violet-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="h-3 w-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6z" />
                                        </svg>
                                        {{ count($items) }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    @if ($record->status === 'active')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-amber-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                {{-- Updated --}}
                                <td class="px-4 py-4 align-middle whitespace-nowrap text-xs text-slate-500 sm:px-5">
                                    {{ \Carbon\Carbon::parse($record->updated_at)->format('d M Y') }}
                                    <span
                                        class="block text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($record->updated_at)->format('H:i') }}</span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-4 align-middle sm:px-5">
                                    <div class="flex items-center justify-end gap-1">
                                        {{-- Expand --}}
                                        <button type="button" data-toggle-row title="View details"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.4" stroke="currentColor"
                                                class="toggle-icon h-3.5 w-3.5 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.itconsultancy.service.edit', $record->id) }}"
                                            title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.itconsultancy.service.destroy', $record->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                    class="h-4 w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- EXPANDABLE DETAIL ROW --}}
                            <tr class="detail-row hidden bg-slate-50/60" data-parent-row>
                                <td colspan="10" class="px-4 py-5 sm:px-6">

                                    <div class="grid gap-5 lg:grid-cols-2">

                                        {{-- Description + Paragraph --}}
                                        <div class="space-y-4">
                                            <div class="rounded-xl border border-slate-200 bg-white p-4">
                                                <p
                                                    class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                                    Small Paragraph
                                                </p>
                                                <div class="prose prose-sm max-w-none text-slate-700">
                                                    {!! $record->small_paragraph !!}
                                                </div>
                                            </div>

                                            <div class="rounded-xl border border-slate-200 bg-white p-4">
                                                <p
                                                    class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                                    Description
                                                </p>
                                                <div class="prose prose-sm max-w-none text-slate-700">
                                                    {!! $record->description !!}
                                                </div>
                                            </div>

                                            <div class="rounded-xl border border-slate-200 bg-white p-4">
                                                <p
                                                    class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                                    Services ({{ count($services) }})
                                                </p>
                                                @if (count($services))
                                                    <div class="flex flex-wrap gap-1.5">
                                                        @foreach ($services as $service)
                                                            <span
                                                                class="rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-emerald-100">
                                                                {{ $service }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-xs italic text-slate-400">No services</p>
                                                @endif

                                                @if ($record->button3_text)
                                                    <p class="mt-3 text-xs text-slate-500">
                                                        Button 3:
                                                        <span
                                                            class="ml-1 rounded-md bg-indigo-50 px-2 py-0.5 font-semibold text-indigo-700 ring-1 ring-indigo-100">
                                                            {{ $record->button3_text }}
                                                        </span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Repeating items --}}
                                        <div>
                                            <div class="rounded-xl border border-slate-200 bg-white p-4">
                                                <p
                                                    class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                                    Repeating Items ({{ count($items) }})
                                                </p>

                                                @if (count($items))
                                                    <div class="space-y-3">
                                                        @foreach ($items as $i => $item)
                                                            <div
                                                                class="flex gap-3 rounded-xl border border-slate-100 bg-slate-50/60 p-3">
                                                                @if (!empty($item['image']))
                                                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                                                        alt=""
                                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                                        class="h-14 w-20 shrink-0 rounded-lg object-cover ring-1 ring-slate-200" />
                                                                    <div style="display:none"
                                                                        class="h-14 w-20 shrink-0 items-center justify-center rounded-lg border border-dashed border-slate-200 bg-white text-[10px] text-slate-400">
                                                                        No img
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="flex h-14 w-20 shrink-0 items-center justify-center rounded-lg border border-dashed border-slate-200 bg-white text-[10px] text-slate-400">
                                                                        No img
                                                                    </div>
                                                                @endif

                                                                <div class="min-w-0 flex-1">
                                                                    <div class="flex items-center justify-between gap-2">
                                                                        <p
                                                                            class="truncate text-sm font-semibold text-slate-800">
                                                                            <span
                                                                                class="mr-1.5 inline-flex h-5 w-5 items-center justify-center rounded bg-violet-100 text-[10px] font-bold text-violet-600">
                                                                                {{ $i + 1 }}
                                                                            </span>
                                                                            {{ $item['heading'] }}
                                                                        </p>
                                                                        @if (!empty($item['link_text']))
                                                                            <span
                                                                                class="shrink-0 rounded-md bg-fuchsia-50 px-2 py-0.5 text-[10px] font-semibold text-fuchsia-700 ring-1 ring-fuchsia-100">
                                                                                {{ $item['link_text'] }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div
                                                                        class="prose prose-xs mt-1 max-w-none text-xs text-slate-600 line-clamp-2">
                                                                        {!! $item['description'] !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-xs italic text-slate-400">No repeating items</p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <span
                                            class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.6" stroke="currentColor" class="h-7 w-7 text-slate-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                        <h3 class="mb-1 text-base font-semibold text-slate-800">
                                            No records yet
                                        </h3>
                                        <p class="mb-5 text-sm text-slate-500">
                                            Get started by creating your first IT Consultancy record.
                                        </p>
                                        <a href="{{ route('admin.itconsultancy.service.create') }}"
                                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:from-indigo-600 hover:to-violet-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.2" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Add Record
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination footer --}}
            @if ($records->count())
                <div
                    class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-xs text-slate-500">
                        Showing <span class="font-semibold text-slate-700">1</span> to
                        <span class="font-semibold text-slate-700">{{ $records->count() }}</span> of
                        <span class="font-semibold text-slate-700">{{ $records->count() }}</span> records
                    </p>

                    <div class="flex items-center gap-1">
                        <button type="button" disabled
                            class="inline-flex h-8 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-xs font-medium text-slate-400 cursor-not-allowed">
                            Previous
                        </button>
                        <button type="button"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-semibold text-white shadow-sm">
                            1
                        </button>
                        <button type="button" disabled
                            class="inline-flex h-8 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-xs font-medium text-slate-400 cursor-not-allowed">
                            Next
                        </button>
                    </div>
                </div>
            @endif
        </div>

        {{-- No results message --}}
        <div id="noResults" class="hidden mt-6 text-center text-sm text-slate-500">
            No records matched your search.
        </div>
    </div>

    <script>
        /* ============================================================
               EXPAND / COLLAPSE DETAIL ROWS
            ============================================================ */
        document.querySelectorAll('[data-toggle-row]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const row = btn.closest('.record-row');
                const icon = btn.querySelector('.toggle-icon');
                const detail = row.nextElementSibling;

                if (!detail || !detail.hasAttribute('data-parent-row')) return;

                const isOpen = !detail.classList.contains('hidden');
                detail.classList.toggle('hidden', isOpen);
                icon.classList.toggle('rotate-180', !isOpen);
            });
        });


        /* ============================================================
           LIVE SEARCH
        ============================================================ */
        const searchInput = document.getElementById('tableSearch');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const q = searchInput.value.trim().toLowerCase();
            const rows = document.querySelectorAll('.record-row');
            let visible = 0;

            rows.forEach(function(row) {
                const haystack = row.dataset.search || '';
                const match = q === '' || haystack.includes(q);
                row.classList.toggle('hidden', !match);

                // Hide its detail row too if the parent is hidden
                const detail = row.nextElementSibling;
                if (detail && detail.hasAttribute('data-parent-row') && !match) {
                    detail.classList.add('hidden');
                    const icon = row.querySelector('.toggle-icon');
                    if (icon) icon.classList.remove('rotate-180');
                }

                if (match) visible++;
            });

            noResults.classList.toggle('hidden', visible > 0);
        });
    </script>
@endsection
