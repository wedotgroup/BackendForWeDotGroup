{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.master')

@section('content')
    {{-- ==================== HEADER ==================== --}}
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div class="flex items-center gap-3">
                <span
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </span>
                <div>
                    <h1 class="text-lg font-bold leading-tight tracking-tight text-slate-900 sm:text-xl">
                        Categories &amp; Subcategories
                    </h1>
                    <p class="text-xs text-slate-500 sm:text-sm">
                        All categories with their subcategories in one view
                    </p>
                </div>
            </div>

            <a href="{{ route("admin.itconsultancy.category.create") }}"
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

        {{-- Flash messages --}}
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
                <input id="tableSearch" type="text" placeholder="Search categories or subcategories..."
                    class="w-full rounded-xl border border-slate-300 bg-white pl-9 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
            </div>

            <p class="text-xs text-slate-500">
                Total: <span class="font-semibold text-slate-700">{{ $categories->count() ?? 0 }}</span> categories
            </p>
        </div>

        {{-- ============================================================
             TABLE
        ============================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/80 text-xs uppercase tracking-wide text-slate-500">
                            <th class="px-4 py-3 font-semibold sm:px-6">#</th>
                            <th class="px-4 py-3 font-semibold sm:px-6">Category</th>
                            <th class="px-4 py-3 font-semibold sm:px-6">Slug</th>
                            <th class="px-4 py-3 font-semibold sm:px-6">Subcategories</th>
                            <th class="px-4 py-3 text-right font-semibold sm:px-6">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($categories ?? [] as $index => $category)
                            {{-- ==================== CATEGORY ROW ==================== --}}
                            <tr class="category-row transition hover:bg-indigo-50/40"
                                data-search="{{ strtolower($category->name . ' ' . $category->slug . ' ' . $category->subcategory->pluck('name')->implode(' ')) }}">

                                <td class="px-4 py-4 align-top text-slate-500 sm:px-6">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-4 py-4 align-top sm:px-6">
                                    <div class="flex items-start gap-3">
                                        {{-- Expand toggle (only if subcategories exist) --}}
                                        @if ($category->subcategory->count())
                                            <button type="button" data-toggle-row
                                                class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-indigo-300 hover:text-indigo-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="toggle-icon h-3.5 w-3.5 transition-transform">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </button>
                                        @else
                                            <span class="mt-0.5 inline-block h-6 w-6 shrink-0"></span>
                                        @endif

                                        <div class="min-w-0">
                                            <p class="font-semibold text-slate-800">
                                                {{ $category->name }}
                                            </p>
                                            <p class="mt-0.5 inline-flex items-center gap-1.5 text-xs text-slate-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                    class="h-3.5 w-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                </svg>
                                                {{ $category->subcategory->count() }}
                                                {{ Str::plural('subcategory', $category->subcategory->count()) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 align-top sm:px-6">
                                    <code
                                        class="rounded-lg bg-slate-100 px-2 py-1 text-xs text-slate-600">{{ $category->slug }}</code>
                                </td>

                                <td class="px-4 py-4 align-top sm:px-6">
                                    @if ($category->subcategory->count())
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($category->subcategory->take(3) as $sub)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-violet-50 px-2.5 py-0.5 text-xs font-medium text-violet-700 ring-1 ring-violet-100">
                                                    {{ $sub->name }}
                                                </span>
                                            @endforeach

                                            @if ($category->subcategory->count() > 3)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-500">
                                                    +{{ $category->subcategory->count() - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs italic text-slate-400">No subcategories</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 align-top sm:px-6">
                                    <div class="flex items-center justify-end gap-1.5">
                                        

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.itconsultancy.category.edit',$category->id ?? "") }}" title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.itconsultancy.category.destroy',$category->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this category and all its subcategories?');">
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

                            {{-- ==================== SUBCATEGORY ROWS ==================== --}}
                            @foreach ($category->subcategory as $subIndex => $sub)
                                <tr class="subcategory-row hidden bg-slate-50/50 transition hover:bg-violet-50/40"
                                    data-parent-row>
                                    <td class="px-4 py-3 text-slate-400 sm:px-6"></td>

                                    <td class="px-4 py-3 sm:px-6">
                                        <div class="flex items-center gap-3 pl-8">
                                            <span
                                                class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-violet-100 text-[10px] font-bold text-violet-600">
                                                {{ $subIndex + 1 }}
                                            </span>
                                            <span class="text-sm text-slate-700">{{ $sub->name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 sm:px-6">
                                        <code
                                            class="rounded-lg bg-white px-2 py-1 text-xs text-slate-500 ring-1 ring-slate-200">{{ $sub->slug }}</code>
                                    </td>

                                    <td class="px-4 py-3 sm:px-6">
                                        <span class="text-xs text-slate-400">—</span>
                                    </td>

                                    <td class="px-4 py-3 sm:px-6">
                                        <div class="flex items-center justify-end gap-1.5">
                                            {{-- Edit --}}
                                            <a href="{{ route("admin.itconsultancy.subcate.edit",$sub->id) }}"
                                                title="Edit subcategory"
                                                class="inline-flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                    class="h-3.5 w-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                                                </svg>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.itconsultancy.subcate.destroy',$sub->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Delete this subcategory?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete subcategory"
                                                    class="inline-flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                        class="h-3.5 w-3.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @empty
                            {{-- ==================== EMPTY STATE ==================== --}}
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <span
                                            class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"
                                                class="h-7 w-7 text-slate-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                            </svg>
                                        </span>
                                        <h3 class="mb-1 text-base font-semibold text-slate-800">
                                            No categories yet
                                        </h3>
                                        <p class="mb-5 text-sm text-slate-500">
                                            Get started by creating your first category.
                                        </p>
                                        <a href="{{ route('admin.itconsultancy.category.create') }}"
                                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:from-indigo-600 hover:to-violet-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"
                                                class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Add Category
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- No-results message (shown by JS when search finds nothing) --}}
        <div id="noResults" class="hidden mt-6 text-center text-sm text-slate-500">
            No categories matched your search.
        </div>
    </div>

    <script>
        /* ============================================================
           EXPAND / COLLAPSE SUBCATEGORY ROWS
        ============================================================ */
        document.querySelectorAll('[data-toggle-row]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const row = btn.closest('.category-row');
                const icon = btn.querySelector('.toggle-icon');
                let next = row.nextElementSibling;
                let open = icon.classList.contains('rotate-90');

                // Toggle all following subcategory rows
                while (next && next.hasAttribute('data-parent-row')) {
                    next.classList.toggle('hidden', open);
                    next = next.nextElementSibling;
                }

                icon.classList.toggle('rotate-90', !open);
            });
        });


        /* ============================================================
           LIVE SEARCH
        ============================================================ */
        const searchInput = document.getElementById('tableSearch');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const q = searchInput.value.trim().toLowerCase();
            const rows = document.querySelectorAll('.category-row');
            let visible = 0;

            rows.forEach(function(row) {
                const haystack = row.dataset.search || '';
                const match = q === '' || haystack.includes(q);
                row.classList.toggle('hidden', !match);

                // Hide subcategory rows too when the parent is hidden
                let next = row.nextElementSibling;
                while (next && next.hasAttribute('data-parent-row')) {
                    if (!match) next.classList.add('hidden');
                    next = next.nextElementSibling;
                }

                if (match) visible++;
            });

            noResults.classList.toggle('hidden', visible > 0);
        });
    </script>
@endsection