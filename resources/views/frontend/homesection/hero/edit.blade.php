@extends('layouts.master')

@section('content')
<div class="mx-auto w-full max-w-4xl">

    {{-- Page Heading --}}
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-1.5 text-xs text-slate-500">
                <a href="#" class="transition hover:text-indigo-600">Dashboard</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                <a href="#" class="transition hover:text-indigo-600">Hero Section</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                <span class="font-medium text-slate-700">Edit</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Edit Hero Section</h1>
            <p class="mt-0.5 text-sm text-slate-500">
                Fill in the details below. Each section is stored as a card-wise array.
            </p>
        </div>

        <span class="inline-flex items-center gap-1.5 self-start rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 ring-1 ring-indigo-100 sm:self-auto">
            <span class="relative flex h-1.5 w-1.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
            </span>
            Editing Record #{{ $hero->id }}
        </span>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-slate-200 sm:p-8">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-red-800">Please fix the following:</p>
                    <ul class="mt-1 list-inside list-disc space-y-0.5 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Success flash --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form 
              action="{{ route('admin.hero.update', $hero->id) }}"
              method="POST"
              class="space-y-6"
              novalidate>
            @csrf
           

            {{-- ================= SECTION 1: HERO CONTENT ================= --}}
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <header class="flex items-center gap-2 border-b border-slate-100 px-5 py-3">
                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-xs font-bold text-slate-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">Hero Content</h2>
                        <p class="text-xs text-slate-500">Main title, heading and description</p>
                    </div>
                </header>

                <div class="space-y-3 p-5">
                    <div class="grid items-center gap-2 sm:grid-cols-[180px_1fr]">
                        <label for="title" class="text-sm font-medium text-slate-700">Hero Title</label>
                        <input id="title" name="hero_title" type="text"
                               value="{{ old('title', $hero->hero_title ?? '') }}"
                               placeholder="e.g. Build faster with us"
                               class="w-full rounded-lg border bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:ring-2
                                      @error('title') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-200 @enderror">
                    </div>
                    @error('title') <p class="-mt-1 text-xs text-red-600 sm:pl-[190px]">{{ $message }}</p> @enderror

                    <div class="grid items-center gap-2 sm:grid-cols-[180px_1fr]">
                        <label for="subtitle" class="text-sm font-medium text-slate-700">Hero Heading</label>
                        <input id="subtitle" name="hero_heading" type="text"
                               value="{{ old('subtitle', $hero->hero_heading ?? '') }}"
                               placeholder="e.g. Modern tools for modern teams"
                               class="w-full rounded-lg border bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:ring-2
                                      @error('subtitle') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-200 @enderror">
                    </div>
                    @error('subtitle') <p class="-mt-1 text-xs text-red-600 sm:pl-[190px]">{{ $message }}</p> @enderror

                    <div class="grid gap-2 sm:grid-cols-[180px_1fr]">
                        <label for="description" class="pt-2 text-sm font-medium text-slate-700">Short Description</label>
                        <textarea id="description" name="description" rows="3"
                                  placeholder="e.g. Everything you need in one place"
                                  class="w-full rounded-lg border bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:ring-2
                                         @error('description') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-slate-300 focus:border-indigo-500 focus:ring-indigo-200 @enderror">{{ old('description', $hero->description ?? '') }}</textarea>
                    </div>
                    @error('description') <p class="-mt-1 text-xs text-red-600 sm:pl-[190px]">{{ $message }}</p> @enderror
                </div>
            </section>

            {{-- ================= SECTION 2: ACTION BUTTONS ================= --}}
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <header class="flex items-center gap-2 border-b border-slate-100 px-5 py-3">
                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-amber-100 text-xs font-bold text-amber-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9m3 6v-3a3 3 0 00-3-3H3"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">Action Buttons</h2>
                        <p class="text-xs text-slate-500">Two buttons with their links</p>
                    </div>
                </header>

                <div class="space-y-3 p-5">
                    <div class="grid items-center gap-2 sm:grid-cols-[180px_1fr_1fr]">
                        <label for="btn1Text" class="text-sm font-medium text-slate-700">Button 1</label>
                        <input id="btn1Text" name="button_one" type="text"
                               value="{{ old('button_one', $hero->button_one ?? '') }}"
                               placeholder="Text e.g. Get Started"
                               class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <input id="btn1Link" name="link_one" type="text"
                               value="{{ old('link_one', $hero->link_one ?? '') }}"
                               placeholder="Link e.g. https://example.com/start"
                               class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <div class="grid items-center gap-2 sm:grid-cols-[180px_1fr_1fr]">
                        <label for="btn2Text" class="text-sm font-medium text-slate-700">Button 2</label>
                        <input id="btn2Text" name="button_two" type="text"
                               value="{{ old('button_two', $hero->button_two ?? '') }}"
                               placeholder="Text e.g. Learn More"
                               class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <input id="btn2Link" name="link_two" type="text"
                               value="{{ old('link_two', $hero->link_two ?? '') }}"
                               placeholder="Link e.g. https://example.com/about"
                               class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                </div>
            </section>

            {{-- ================= SECTION 3: BADGES ================= --}}
            @php
                $existingBadges = old('badges', is_array($hero->badges ?? null) ? $hero->badges : (json_decode($hero->badges ?? '[]', true) ?: []));
            @endphp
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <header class="flex items-center justify-between gap-2 border-b border-slate-100 px-5 py-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-indigo-100 text-xs font-bold text-indigo-600">#</span>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Badges</h2>
                            <p class="text-xs text-slate-500">Short tags shown above the hero title</p>
                        </div>
                    </div>
                    <button type="button" id="addBadgeBtn"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 active:scale-[.98]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Badge
                    </button>
                </header>

                <div class="p-5">
                    <div id="badgeContainer" class="space-y-2.5">
                        {{-- Pre-rendered server-side for existing / old values --}}
                        @foreach($existingBadges as $badge)
                            <div class="badge-group flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-indigo-300 hover:bg-white">
                                <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-indigo-100 text-xs font-bold text-indigo-600">#</span>
                                <input type="text" name="badges[]" value="{{ $badge }}"
                                       placeholder="e.g. New Feature"
                                       class="badge-input w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                                <button type="button"
                                        class="remove-badge-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <p id="badgeEmpty"
                       class="rounded-lg border border-dashed border-slate-300 px-3 py-4 text-center text-xs text-slate-400 {{ count($existingBadges) ? 'hidden' : '' }}">
                        No badges yet. Click "Add Badge" to create one.
                    </p>
                </div>
            </section>

            {{-- ================= SECTION 4: EXTRA LIST ================= --}}
            @php
                $existingExtras = old('extra_lists', is_array($hero->extra_lists ?? null) ? $hero->extra_lists : (json_decode($hero->extra_lists ?? '[]', true) ?: []));
            @endphp
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <header class="flex items-center justify-between gap-2 border-b border-slate-100 px-5 py-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-purple-100 text-xs font-bold text-purple-600">+</span>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Extra List</h2>
                            <p class="text-xs text-slate-500">Single-value items stored in an array</p>
                        </div>
                    </div>
                    <button type="button" id="addExtraBtn"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-purple-600 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 active:scale-[.98]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Extra
                    </button>
                </header>

                <div class="p-5">
                    <div id="extraContainer" class="space-y-2.5">
                        @foreach($existingExtras as $extra)
                            <div class="extra-group flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-purple-300 hover:bg-white">
                                <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-purple-100 text-xs font-bold text-purple-600">+</span>
                                <input type="text" name="extra_lists[]" value="{{ $extra }}"
                                       placeholder="e.g. Extra item value"
                                       class="extra-input w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                                <button type="button"
                                        class="remove-extra-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <p id="extraEmpty"
                       class="rounded-lg border border-dashed border-slate-300 px-3 py-4 text-center text-xs text-slate-400 {{ count($existingExtras) ? 'hidden' : '' }}">
                        No extra items yet. Click "Add Extra" to create one.
                    </p>
                </div>
            </section>

            {{-- ================= SECTION 5: HERO LIST ================= --}}
            @php
                $existingList = old('list_items', is_array($hero->list_items ?? null) ? $hero->list_items : (json_decode($hero->list_items ?? '[]', true) ?: []));
                if (old('list_items_title') && old('list_items_value')) {
                    $existingList = [];
                    foreach (old('list_items_title') as $i => $t) {
                        $existingList[] = ['title' => $t, 'value' => old('list_items_value')[$i] ?? ''];
                    }
                }
            @endphp
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <header class="flex items-center justify-between gap-2 border-b border-slate-100 px-5 py-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-md bg-emerald-100 text-xs font-bold text-emerald-600">≡</span>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Hero List Items</h2>
                            <p class="text-xs text-slate-500">First value = title, second value = content</p>
                        </div>
                    </div>
                    <button type="button" id="addListBtn"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-300 active:scale-[.98]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add List
                    </button>
                </header>

                <div class="p-5">
                    <div id="listInputsContainer" class="space-y-2.5">
                        @foreach($existingList as $item)
                            <div class="list-group rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-emerald-300 hover:bg-white">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                    <input type="text" name="list_items_title[]"
                                           value="{{ $item['title'] ?? '' }}"
                                           placeholder="First value (title)"
                                           class="list-title w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                                    <input type="text" name="list_items_value[]"
                                           value="{{ $item['value'] ?? '' }}"
                                           placeholder="Second value (content)"
                                           class="list-content w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                                    <button type="button"
                                            class="remove-list-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p id="listEmpty"
                       class="rounded-lg border border-dashed border-slate-300 px-3 py-4 text-center text-xs text-slate-400 {{ count($existingList) ? 'hidden' : '' }}">
                        No list items yet. Click "Add List" to create one.
                    </p>
                </div>
            </section>

            {{-- ================= FORM ACTIONS ================= --}}
            <div class="flex flex-wrap items-center gap-3 border-t border-slate-200 pt-5">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300 active:scale-[.98]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Update Hero
                </button>
                <a href="{{ url()->previous() }}"
                   class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 active:scale-[.98]">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
    // ---------- Elements ----------
    const form = document.getElementById('heroForm');

    const badgeContainer = document.getElementById('badgeContainer');
    const addBadgeBtn    = document.getElementById('addBadgeBtn');
    const badgeEmpty     = document.getElementById('badgeEmpty');

    const extraContainer = document.getElementById('extraContainer');
    const addExtraBtn    = document.getElementById('addExtraBtn');
    const extraEmpty     = document.getElementById('extraEmpty');

    const listInputsContainer = document.getElementById('listInputsContainer');
    const addListBtn          = document.getElementById('addListBtn');
    const listEmpty           = document.getElementById('listEmpty');

    // ---------- Empty state helper ----------
    function toggleEmpty(container, emptyEl) {
        emptyEl.classList.toggle('hidden', container.children.length > 0);
    }

    // ================= BADGES =================
    function createBadgeCard(value = '') {
        const card = document.createElement('div');
        card.className = 'badge-group flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-indigo-300 hover:bg-white';

        const icon = document.createElement('span');
        icon.className = 'inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-indigo-100 text-xs font-bold text-indigo-600';
        icon.textContent = '#';

        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'e.g. New Feature';
        input.value = value;
        input.name = 'badges[]';
        input.className = 'badge-input w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.className = 'remove-badge-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]';

        card.append(icon, input, removeBtn);
        return card;
    }

    addBadgeBtn.addEventListener('click', () => {
        const card = createBadgeCard();
        badgeContainer.appendChild(card);
        toggleEmpty(badgeContainer, badgeEmpty);
        card.querySelector('.badge-input').focus();
    });

    badgeContainer.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-badge-btn');
        if (!btn) return;
        btn.closest('.badge-group')?.remove();
        toggleEmpty(badgeContainer, badgeEmpty);
    });

    // ================= EXTRA LIST =================
    function createExtraCard(value = '') {
        const card = document.createElement('div');
        card.className = 'extra-group flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-purple-300 hover:bg-white';

        const icon = document.createElement('span');
        icon.className = 'inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-purple-100 text-xs font-bold text-purple-600';
        icon.textContent = '+';

        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'e.g. Extra item value';
        input.value = value;
        input.name = 'extra_lists[]';
        input.className = 'extra-input w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-200';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.className = 'remove-extra-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]';

        card.append(icon, input, removeBtn);
        return card;
    }

    addExtraBtn.addEventListener('click', () => {
        const card = createExtraCard();
        extraContainer.appendChild(card);
        toggleEmpty(extraContainer, extraEmpty);
        card.querySelector('.extra-input').focus();
    });

    extraContainer.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-extra-btn');
        if (!btn) return;
        btn.closest('.extra-group')?.remove();
        toggleEmpty(extraContainer, extraEmpty);
    });

    // ================= HERO LIST =================
    function createListCard(title = '', content = '') {
        const card = document.createElement('div');
        card.className = 'list-group rounded-lg border border-slate-200 bg-slate-50 p-2 transition hover:border-emerald-300 hover:bg-white';

        const row = document.createElement('div');
        row.className = 'flex flex-col gap-2 sm:flex-row sm:items-center';

        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.placeholder = 'First value (title)';
        titleInput.value = title;
        titleInput.name = 'list_items_title[]';
        titleInput.className = 'list-title w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200';

        const contentInput = document.createElement('input');
        contentInput.type = 'text';
        contentInput.placeholder = 'Second value (content)';
        contentInput.value = content;
        contentInput.name = 'list_items_value[]';
        contentInput.className = 'list-content w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.className = 'remove-list-btn shrink-0 rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 active:scale-[.97]';

        row.append(titleInput, contentInput, removeBtn);
        card.appendChild(row);
        return card;
    }

    addListBtn.addEventListener('click', () => {
        const card = createListCard();
        listInputsContainer.appendChild(card);
        toggleEmpty(listInputsContainer, listEmpty);
        card.querySelector('.list-title').focus();
    });

    listInputsContainer.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-list-btn');
        if (!btn) return;
        btn.closest('.list-group')?.remove();
        toggleEmpty(listInputsContainer, listEmpty);
    });

    // ================= INIT =================
    (function init() {
        toggleEmpty(badgeContainer, badgeEmpty);
        toggleEmpty(extraContainer, extraEmpty);
        toggleEmpty(listInputsContainer, listEmpty);
    })();

    // ================= OPTIONAL: AJAX SUBMIT (commented fallback to normal POST) =================
    // The form now submits normally to route('hero-section.update', $hero->id).
    // If you want AJAX, uncomment below and comment out the native <form> submit.

    /*
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        const original = btn.innerHTML;
        btn.innerHTML = 'Saving...';
        btn.disabled = true;

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: new FormData(form),
            });
            if (!res.ok) throw new Error('Save failed');
            btn.innerHTML = 'Saved ✓';
            setTimeout(() => { btn.innerHTML = original; btn.disabled = false; }, 1200);
        } catch (err) {
            btn.innerHTML = original;
            btn.disabled = false;
            alert('Error: ' + err.message);
        }
    });
    */
</script>
@endsection