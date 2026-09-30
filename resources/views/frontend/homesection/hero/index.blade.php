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
    <div class="mx-auto w-full max-w-6xl space-y-6">

        <div id="listingView" class="rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">

            <!-- Header -->
            <header class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-4">
                <div>
                    <h1 class="text-xl font-bold text-slate-900">Hero Sections</h1>
                    <p class="mt-0.5 text-sm text-slate-500">
                        Manage all hero sections. Click "Add Hero" to create a new one.
                    </p>
                </div>
                <a href="{{ route('admin.hero.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white
                       transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300 active:scale-[.98]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Hero
                </a>
            </header>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600 w-[50px]">
                                #</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                                Title / Heading</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                                Description</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                                Badges</th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                                Extra List</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                                Video</th>

                            <th
                                class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-600 w-[100px]">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($heros as $key => $data)
                            <tr class="hover:bg-slate-50">

                                {{-- # --}}
                                <td class="px-4 py-4 text-sm text-slate-500">
                                    {{ $key + 1 }}
                                </td>

                                {{-- Title / Heading --}}
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-slate-900">
                                        {{ $data->hero_title ?? '-' }}
                                    </div>

                                    @if (!empty($data->heading))
                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $data->hero_heading }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Description --}}
                                <td class="max-w-xs px-4 py-4 text-sm text-slate-600">
                                    {{ Str::limit($data->description ?? '', 80) }}
                                </td>

                                {{-- Badges --}}
                                <td class="px-4 py-4">
                                    @php
                                        $badges = is_array($data->badges)
                                            ? $data->badges
                                            : json_decode($data->badges ?? '[]', true);
                                    @endphp

                                    <div class="flex flex-wrap gap-1">
                                        @forelse ($badges ?? [] as $badge)
                                            <span
                                                class="rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                                                {{ is_array($badge) ? $badge['title'] ?? '' : $badge }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400">No badges</span>
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

                                    <div class="space-y-1">
                                        @forelse ($extraList ?? [] as $item)
                                            <div class="text-xs text-slate-600">
                                                {{ is_array($item) ? $item['title'] ?? '' : $item }}
                                            </div>
                                        @empty
                                            <span class="text-xs text-slate-400">No items</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Description --}}
                                <td class="max-w-xs px-4 py-4 text-sm text-slate-600">
                                    <video src="{{ asset($data->video_file ?? '') }}" autoplay muted loop></video>
                                </td>


                                {{-- Actions --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('admin.hero.edit', $data->id) }}"
                                            class="rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 hover:bg-blue-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.hero.destroy', $data->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this hero?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-100">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div
                                        class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>

                                    <p class="text-sm font-medium text-slate-700">
                                        No hero sections yet
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Click "Add Hero" to create your first one.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Empty state -->

        </div>

        <!-- ================= ADD FORM VIEW ================= -->
        <div id="formView" class="hidden rounded-2xl bg-white p-6 shadow-lg ring-1 ring-slate-200 sm:p-8">

            <header class="mb-6 flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Add Hero Section</h1>
                    <p class="mt-1 text-sm text-slate-500">Fill in the details below and click Save Hero.</p>
                </div>
                <button type="button" id="closeFormBtn"
                    class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 transition
                       hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    Cancel
                </button>
            </header>


        </div>
    </div>
@endsection
