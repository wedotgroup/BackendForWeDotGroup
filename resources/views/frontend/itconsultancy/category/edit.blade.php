@extends('layouts.master')

@section('content')
    {{-- ==================== HEADER ==================== --}}
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center gap-3 px-4 py-4 sm:px-6">
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
                    Create a category on the left, then add subcategories on the right
                </p>
            </div>
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

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <p class="mb-1 font-semibold">Please fix the following:</p>
                <ul class="list-inside list-disc space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ============================================================
             TWO COLUMN LAYOUT
        ============================================================= --}}
        <div class="grid gap-6 lg:grid-cols-2">

            {{-- =========================================================
                 LEFT — CATEGORY FORM (name + slug only)
            ========================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div
                    class="flex items-center gap-3 border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-transparent px-5 py-4 sm:px-6">
                    <span
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">Add Category</h2>
                        <p class="text-xs text-slate-500 sm:text-sm">Top-level grouping</p>
                    </div>
                </div>

                <form action="" method="POST" class="space-y-5 p-5 sm:p-6">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="catName" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input id="catName" name="name" type="text" required
                            value="{{ old('name') }}"
                            data-slug-source="catSlug"
                            placeholder="e.g. IT Services"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="catSlug" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Slug
                        </label>
                        <input id="catSlug" name="slug" type="text" value="{{ old('slug') }}"
                            placeholder="auto-generated-from-name"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                        <p class="mt-1 text-xs text-slate-400">Leave blank to auto-generate from the name.</p>
                        @error('slug')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-1">
                        <button type="reset"
                            class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[.98]">
                            Reset
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:from-indigo-600 hover:to-violet-700 active:scale-[.98] focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2">
                            Save Category
                        </button>
                    </div>
                </form>
            </section>

            {{-- =========================================================
                 RIGHT — SUBCATEGORY FORM (parent + name + slug)
            ========================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div
                    class="flex items-center gap-3 border-b border-slate-100 bg-gradient-to-r from-violet-50/70 to-transparent px-5 py-4 sm:px-6">
                    <span
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-fuchsia-600 text-sm font-bold text-white shadow-md shadow-violet-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">Add Subcategory</h2>
                        <p class="text-xs text-slate-500 sm:text-sm">Nested under a parent category</p>
                    </div>
                </div>

                <form action="" method="POST" class="space-y-5 p-5 sm:p-6">
                    @csrf

                    {{-- Parent category --}}
                    <div>
                        <label for="subParent" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="subParent" name="category_id" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                            <option value="">— Select a category —</option>
                            @forelse ($categories ?? [] as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                                <option value="" disabled>No categories yet — create one first</option>
                            @endforelse
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @if (empty($categories) || $categories->isEmpty())
                            <p class="mt-1.5 text-xs text-amber-600">
                                You need at least one category before adding a subcategory.
                            </p>
                        @endif
                    </div>

                    {{-- Name --}}
                    <div>
                        <label for="subName" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Subcategory Name <span class="text-red-500">*</span>
                        </label>
                        <input id="subName" name="name" type="text" required
                            value="{{ old('name') }}"
                            data-slug-source="subSlug"
                            placeholder="e.g. Cloud Migration"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="subSlug" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Slug
                        </label>
                        <input id="subSlug" name="slug" type="text" value="{{ old('slug') }}"
                            placeholder="auto-generated-from-name"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100" />
                        <p class="mt-1 text-xs text-slate-400">Leave blank to auto-generate from the name.</p>
                        @error('slug')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-1">
                        <button type="reset"
                            class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[.98]">
                            Reset
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-gradient-to-br from-violet-500 to-fuchsia-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-violet-500/30 transition hover:from-violet-600 hover:to-fuchsia-700 active:scale-[.98] focus:outline-none focus:ring-2 focus:ring-violet-300 focus:ring-offset-2">
                            Save Subcategory
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>

    <script>
        /* ============================================================
           AUTO SLUG
           - Slug follows the name until the user types in the slug
             field manually, then it stops syncing.
        ============================================================ */
        function slugify(value) {
            return value
                .toString()
                .toLowerCase()
                .trim()
                .replace(/[\s_]+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        document.querySelectorAll('[data-slug-source]').forEach(function(source) {
            const target = document.getElementById(source.dataset.slugSource);
            if (!target) return;

            let manual = target.value.trim().length > 0;

            target.addEventListener('input', function() {
                manual = target.value.trim().length > 0;
            });

            source.addEventListener('input', function() {
                if (!manual) target.value = slugify(source.value);
            });
        });
    </script>
@endsection