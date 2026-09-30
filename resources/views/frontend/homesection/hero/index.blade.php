@extends('layouts.master')
@section('content')
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    <div class="mx-auto w-full max-w-7xl space-y-6">

        <div id="listingView" class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/70 overflow-hidden">

            <!-- Header -->
            <header class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-5">
                <div class="flex items-center gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-md shadow-indigo-500/20">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Hero Sections</h1>
                        <p class="mt-0.5 text-sm text-slate-500">
                            Manage all hero sections. Click "Add Hero" to create a new one.
                        </p>
                    </div>
                </div>

                <a href="{{ route('admin.hero.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white
                          shadow-md shadow-indigo-500/20 transition hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5
                          focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[.98]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Hero
                </a>
            </header>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 w-[60px]">
                                #
                            </th>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 min-w-[200px]">
                                Title / Heading
                            </th>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 min-w-[220px]">
                                Description
                            </th>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 min-w-[160px]">
                                Badges
                            </th>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 min-w-[180px]">
                                Extra List
                            </th>
                            <th class="px-4 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 min-w-[140px]">
                                Video
                            </th>
                            <th class="px-4 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500 w-[130px]">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($heros as $key => $data)
                            <tr class="group transition hover:bg-indigo-50/40">

                                {{-- # --}}
                                <td class="px-4 py-4">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-xs font-semibold text-slate-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                                        {{ $key + 1 }}
                                    </span>
                                </td>

                                {{-- Title / Heading --}}
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-slate-900 leading-tight">
                                        {{ $data->hero_title ?? '-' }}
                                    </div>

                                    @if (!empty($data->hero_heading))
                                        <div class="mt-1 inline-flex items-center gap-1 text-xs text-slate-500">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                            </svg>
                                            {{ $data->hero_heading }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Description --}}
                                <td class="max-w-xs px-4 py-4 text-sm text-slate-600 leading-relaxed">
                                    {{ Str::limit($data->description ?? '', 80) }}
                                </td>

                                {{-- Badges --}}
                                <td class="px-4 py-4">
                                    @php
                                        $badges = is_array($data->badges)
                                            ? $data->badges
                                            : json_decode($data->badges ?? '[]', true);
                                    @endphp

                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse ($badges ?? [] as $badge)
                                            <span class="inline-flex items-center gap-1 rounded-full border border-blue-200/60 bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                {{ is_array($badge) ? $badge['title'] ?? '' : $badge }}
                                            </span>
                                        @empty
                                            <span class="text-xs italic text-slate-400">No badges</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Extra List --}}
                                <td class="px-4 py-4">
                                    @php
                                        $extraList = is_array($data->extra_lists)
                                            ? $data->extra_lists
                                            : json_decode($data->extra_lists ?? '[]', true);
                                    @endphp

                                    <div class="space-y-1.5">
                                        @forelse ($extraList ?? [] as $item)
                                            <div class="flex items-center gap-1.5 text-xs text-slate-600">
                                                <svg class="h-3 w-3 shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ is_array($item) ? $item['title'] ?? '' : $item }}
                                            </div>
                                        @empty
                                            <span class="text-xs italic text-slate-400">No items</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Video --}}
                                <td class="px-4 py-4">
                                    @if(!empty($data->video_file))
                                        <div class="group/vid relative h-14 w-24 overflow-hidden rounded-lg border border-slate-200 bg-slate-900 shadow-sm">
                                            <video src="{{ asset($data->video_file) }}"
                                                   autoplay muted loop playsinline
                                                   class="h-full w-full object-cover opacity-90 transition group-hover/vid:opacity-100"></video>
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition group-hover/vid:opacity-100 bg-slate-900/30">
                                                <svg class="h-5 w-5 text-white drop-shadow" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs italic text-slate-400">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            No video
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('admin.hero.edit', $data->id) }}"
                                           title="Edit"
                                           class="inline-flex items-center gap-1 rounded-lg border border-blue-200 bg-blue-50 px-2.5 py-1.5 text-xs font-semibold text-blue-700 transition
                                                  hover:bg-blue-100 hover:border-blue-300 active:scale-95">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.hero.destroy', $data->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this hero?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Delete"
                                                    class="inline-flex items-center gap-1 rounded-lg border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-700 transition
                                                           hover:bg-red-100 hover:border-red-300 active:scale-95">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200">
                                        <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor"
                                             stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        No hero sections yet
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Click "Add Hero" to create your first one.
                                    </p>

                                    <a href="{{ route('admin.hero.create') }}"
                                       class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Hero
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        <!-- ================= ADD FORM VIEW ================= -->
        <div id="formView" class="hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70 sm:p-8">

            <header class="mb-6 flex items-start justify-between gap-3 border-b border-slate-100 pb-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-md shadow-indigo-500/20">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Add Hero Section</h1>
                        <p class="mt-0.5 text-sm text-slate-500">Fill in the details below and click Save Hero.</p>
                    </div>
                </div>
                <button type="button" id="closeFormBtn"
                        class="rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 transition
                               hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-slate-200 active:scale-95">
                    Cancel
                </button>
            </header>

        </div>

    </div>
@endsection