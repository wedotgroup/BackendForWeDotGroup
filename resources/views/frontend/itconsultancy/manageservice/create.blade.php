@extends('layouts.master')

@section('content')
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
                        Manage IT Consultancy
                    </h1>
                    <p class="text-xs text-slate-500 sm:text-sm">
                        Edit page content, services &amp; repeating items
                    </p>
                </div>
            </div>

        </div>
    </header>

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:py-10">

        <form  action="{{ route('admin.itconsultancy.service.store') }}" method="POST"
            enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- ============================================================
                 SECTION 1
            ============================================================= --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">

                <!-- section header -->
                <div
                    class="flex items-center gap-3 border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-transparent px-5 py-4 sm:px-7">
                    <span
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-500/30">
                        1
                    </span>
                    <div>
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">First Section</h2>
                        <p class="text-xs text-slate-500 sm:text-sm">Hero content, services &amp; call-to-action buttons</p>
                    </div>
                </div>

                <div class="space-y-7 p-5 sm:p-7">

                    <!-- first heading -->
                    <div>
                        <label for="firstHeading" class="mb-1.5 block text-sm font-medium text-slate-700">
                            First Heading
                        </label>
                        <input id="firstHeading" name="first_heading" type="text"
                            placeholder="e.g. Smart IT Solutions For Your Business"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                    </div>

                    <!-- small paragraph (CKEditor) -->
                    <div>
                        <label for="smallParagraph" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Small Paragraph
                        </label>
                        <textarea id="smallParagraph" name="small_paragraph" rows="4"
                            placeholder="Write a short intro paragraph..."
                            class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"></textarea>
                    </div>

                    <!-- button texts -->
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="button1Text" class="mb-1.5 block text-sm font-medium text-slate-700">
                                Button 1 Text
                            </label>
                            <input id="button1Text" name="button1_text" type="text" placeholder="e.g. Get Started"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                        </div>

                        <div>
                            <label for="button2Text" class="mb-1.5 block text-sm font-medium text-slate-700">
                                Button 2 Text
                            </label>
                            <input id="button2Text" name="button2_text" type="text" placeholder="e.g. Our Services"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                        </div>
                    </div>

                    <!-- image -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700">Hero Image</label>
                        <div
                            class="rounded-xl border border-dashed border-slate-300 bg-slate-50/70 p-4 transition hover:border-indigo-300 hover:bg-indigo-50/40">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <img id="heroPreview" src="" alt="Preview"
                                    class="hidden h-28 w-full shrink-0 rounded-xl object-cover ring-1 ring-slate-200 sm:w-44" />

                                <label
                                    class="flex flex-1 cursor-pointer items-center justify-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-4 text-sm text-slate-500 transition hover:border-indigo-300 hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.6" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    <span class="font-medium">Click to upload image</span>
                                    <input id="heroImage" name="hero_image" type="file" accept="image/*"
                                        data-preview="heroPreview" class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- heading -->
                    <div>
                        <label for="sectionHeading" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Heading
                        </label>
                        <input id="sectionHeading" name="heading" type="text" placeholder="e.g. What We Offer"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                    </div>

                    <!-- description (CKEditor) -->
                    <div>
                        <label for="sectionDescription" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Description
                        </label>
                        <textarea id="sectionDescription" name="description" rows="4" placeholder="Describe this section..."
                            class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"></textarea>
                    </div>

                    <!-- listing services -->
                    <div>
                        <div class="mb-3 flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700">Listing Services</label>
                            <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-500">
                                <span id="serviceCount">0</span> items
                            </span>
                        </div>

                        <div id="servicesList" class="space-y-3"></div>

                        <button type="button" id="addServiceBtn"
                            class="mt-3 inline-flex items-center gap-2 rounded-xl border border-indigo-200 bg-indigo-50/70 px-4 py-2.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100 active:scale-[.98]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Item
                        </button>
                    </div>

                    <!-- button 3 -->
                    <div>
                        <label for="button3Text" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Button 3 Text
                        </label>
                        <input id="button3Text" name="button3_text" type="text" placeholder="e.g. Explore More"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />
                    </div>

                </div>
            </section>

            {{-- ============================================================
                 SECTION 2
            ============================================================= --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">

                <div
                    class="flex flex-col gap-4 border-b border-slate-100 bg-gradient-to-r from-violet-50/70 to-transparent px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-fuchsia-600 text-sm font-bold text-white shadow-md shadow-violet-500/30">
                            2
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-slate-900 sm:text-lg">Second Section</h2>
                            <p class="text-xs text-slate-500 sm:text-sm">
                                Repeating array items — image, heading, description &amp; link
                            </p>
                        </div>
                    </div>

                    <button type="button" id="addItemBtn"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-br from-violet-500 to-fuchsia-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-violet-500/30 transition hover:from-violet-600 hover:to-fuchsia-700 active:scale-[.98]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <div id="itemsList" class="space-y-5 p-5 sm:p-7"></div>
            </section>

            <!-- ==================== BOTTOM ACTIONS ==================== -->
            <div class="flex flex-col items-stretch justify-end gap-3 pb-6 sm:flex-row sm:items-center">
                <button type="reset"
                    class="order-2 rounded-xl border border-slate-300 bg-white px-6 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[.98] sm:order-1">
                    Reset Form
                </button>
                <button type="submit"
                    class="order-1 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 px-7 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:from-indigo-600 hover:to-violet-700 active:scale-[.98] focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 sm:order-2">
                    Save Changes
                </button>
            </div>

        </form>
    </div>

    <!-- ==================== TOAST ==================== -->
    <div id="toast"
        class="pointer-events-none fixed right-4 top-24 z-50 flex translate-x-[130%] items-center gap-3 rounded-xl border border-emerald-200 bg-white px-4 py-3 shadow-xl shadow-emerald-500/10 transition-transform duration-300">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="h-4 w-4 text-emerald-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        <div>
            <p class="text-sm font-semibold text-slate-800">Saved successfully</p>
            <p class="text-xs text-slate-500">IT Consultancy data updated.</p>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        const editors = new Map(); // id -> editor instance
        const hasCK = typeof ClassicEditor !== 'undefined';

        const TOOLBAR = [
            'bold', 'italic', 'underline', '|',
            'bulletedList', 'numberedList', '|',
            'link', 'blockQuote', '|',
            'undo', 'redo'
        ];

        function createEditor(id) {
            const el = document.getElementById(id);
            if (!el) return;

            if (!hasCK) {
                el.className =
                    'w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm ' +
                    'text-slate-700 placeholder-slate-400 shadow-sm outline-none transition ' +
                    'focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100';
                return;
            }

            ClassicEditor
                .create(el, {
                    toolbar: {
                        items: TOOLBAR
                    },
                    placeholder: el.getAttribute('placeholder') || 'Write something…'
                })
                .then(function(editor) {
                    editors.set(id, editor);

                    const editable = editor.ui.getEditableElement();
                    if (editable) {
                        editable.classList.add(
                            'min-h-[140px]', '!text-sm', '!text-slate-700', '!px-4', '!py-3',
                            '!border-slate-300', '!rounded-b-xl', '!shadow-none', 'focus:!shadow-none'
                        );
                    }

                    const toolbarEl = editor.ui.view.toolbar && editor.ui.view.toolbar.element;
                    if (toolbarEl) {
                        toolbarEl.classList.add(
                            '!border-slate-300', '!bg-slate-50/80', '!rounded-t-xl', '!px-2', '!py-1.5'
                        );
                    }
                })
                .catch(function(err) {
                    console.error('CKEditor init failed for #' + id, err);
                });
        }

        function getEditorData(id) {
            const editor = editors.get(id);
            if (editor) return editor.getData().trim();
            const el = document.getElementById(id);
            return el ? el.value.trim() : '';
        }

        function destroyEditor(id) {
            const editor = editors.get(id);
            if (!editor) return Promise.resolve();
            editors.delete(id);
            return editor.destroy().catch(function() {});
        }

        function destroyAllEditors() {
            return Promise.all(Array.from(editors.keys()).map(destroyEditor));
        }


        /* ============================================================
           FILE PREVIEW (delegated — works for dynamically added inputs)
        ============================================================ */
        document.addEventListener('change', function(e) {
            const input = e.target;
            if (!input.matches('input[type="file"][data-preview]')) return;

            const preview = document.getElementById(input.dataset.preview);
            const file = input.files && input.files[0];
            if (!preview || !file) return;

            const reader = new FileReader();
            reader.onload = function(evt) {
                preview.src = evt.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });


        /* ============================================================
           SERVICES (repeatable text inputs)
        ============================================================ */
        const servicesList = document.getElementById('servicesList');
        const addServiceBtn = document.getElementById('addServiceBtn');
        const serviceCount = document.getElementById('serviceCount');

        function updateServiceCount() {
            serviceCount.textContent = servicesList.querySelectorAll('.service-row').length;
        }

        function renumberServices() {
            servicesList.querySelectorAll('.service-row').forEach(function(row, i) {
                row.querySelector('.service-index').textContent = i + 1;
            });
            updateServiceCount();
        }

        function addServiceRow(value) {
            const row = document.createElement('div');
            row.className =
                'service-row group flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50/60 p-2 ' +
                'transition hover:border-indigo-200 hover:bg-indigo-50/40';

            row.innerHTML =
                '<span class="service-index inline-flex h-9 w-9 shrink-0 items-center justify-center ' +
                'rounded-lg bg-white text-xs font-bold text-slate-500 ring-1 ring-slate-200"></span>' +
                '<input type="text" name="services[]" placeholder="e.g. Cloud & DevOps Consulting" ' +
                'class="w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm text-slate-700 ' +
                'placeholder-slate-400 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" />' +
                '<button type="button" class="remove-service inline-flex h-9 w-9 shrink-0 items-center justify-center ' +
                'rounded-lg border border-slate-200 bg-white text-slate-400 transition hover:border-red-200 ' +
                'hover:bg-red-50 hover:text-red-500" aria-label="Remove service">' +
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" ' +
                'stroke="currentColor" class="h-4 w-4"><path stroke-linecap="round" stroke-linejoin="round" ' +
                'd="M6 18L18 6M6 6l12 12" /></svg></button>';

            row.querySelector('input').value = value || '';
            servicesList.appendChild(row);
            renumberServices();
        }

        addServiceBtn.addEventListener('click', function() {
            addServiceRow('');
            const inputs = servicesList.querySelectorAll('input');
            if (inputs.length) inputs[inputs.length - 1].focus();
        });

        servicesList.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-service');
            if (!btn) return;
            btn.closest('.service-row').remove();
            renumberServices();
        });


        /* ============================================================
           SECTION 2 ITEMS (image + heading + description + link)
        ============================================================ */
        const itemsList = document.getElementById('itemsList');
        const addItemBtn = document.getElementById('addItemBtn');
        let itemSeq = 0;

        function renumberItems() {
            itemsList.querySelectorAll('.item-card').forEach(function(card, i) {
                card.querySelector('.item-index').textContent = i + 1;
            });
        }

        function addItemCard() {
            itemSeq++;
            const uid = itemSeq;
            const previewId = 'itemPreview' + uid;
            const descId = 'itemDesc' + uid;

            const card = document.createElement('div');
            card.className =
                'item-card rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-50/80 to-white p-4 ' +
                'shadow-sm transition hover:border-violet-200 hover:shadow-md sm:p-5';

            card.innerHTML =
                '<div class="mb-4 flex items-center justify-between gap-3 border-b border-slate-200/70 pb-3">' +
                '<h4 class="flex items-center gap-2 text-sm font-semibold text-slate-700">' +
                '<span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-violet-100 ' +
                'text-xs font-bold text-violet-600">#<span class="item-index"></span></span>' +
                'Item' +
                '</h4>' +
                '<button type="button" class="remove-item inline-flex items-center gap-1.5 rounded-lg border ' +
                'border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 transition ' +
                'hover:border-red-200 hover:bg-red-50 hover:text-red-600">' +
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" ' +
                'stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" ' +
                'd="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 ' +
                '19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 ' +
                '48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 ' +
                '0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 ' +
                '2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>Remove</button>' +
                '</div>' +

                '<div class="grid gap-5 sm:grid-cols-3">' +

                /* image column */
                '<div class="sm:col-span-1">' +
                '<label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Image</label>' +
                '<img id="' + previewId + '" src="" alt="Preview" ' +
                'class="mb-3 hidden h-28 w-full rounded-xl object-cover ring-1 ring-slate-200" />' +
                '<label class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border ' +
                'border-dashed border-slate-300 bg-white px-3 py-3 text-xs font-medium text-slate-500 ' +
                'transition hover:border-violet-300 hover:text-violet-600">' +
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" ' +
                'stroke="currentColor" class="h-4 w-4"><path stroke-linecap="round" stroke-linejoin="round" ' +
                'd="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 ' +
                '0l4.5 4.5M12 3v13.5" /></svg>Upload' +
                '<input type="file" accept="image/*" name="ourservice_file[]" data-preview="' + previewId +
                '" class="hidden" />' +
                '</label>' +
                '</div>' +

                /* fields column */
                '<div class="space-y-4 sm:col-span-2">' +

                '<div>' +
                '<label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Heading</label>' +
                '<input type="text" data-field="heading" name="ourservice_heading[]" placeholder="e.g. Network Infrastructure" ' +
                'class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 ' +
                'placeholder-slate-400 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100" />' +
                '</div>' +

                '<div>' +
                '<label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Description</label>' +
                '<textarea name="ourservice_desc[]" id="' + descId + '" data-field="description" rows="4" ' +
                'placeholder="Short description..." ' +
                'class="w-full resize-y rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm ' +
                'text-slate-700 placeholder-slate-400 shadow-sm outline-none transition ' +
                'focus:border-violet-500 focus:ring-4 focus:ring-violet-100"></textarea>' +
                '</div>' +

                '<div>' +
                '<label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Link Text</label>' +
                '<input type="text" name="ourservice_link_text[]" data-field="link_text" placeholder="e.g. Learn More" ' +
                'class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-700 ' +
                'placeholder-slate-400 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100" />' +
                '</div>' +

                '</div>' +
                '</div>';

            itemsList.appendChild(card);
            renumberItems();
            createEditor(descId);
        }

        addItemBtn.addEventListener('click', function() {
            addItemCard();
            const cards = itemsList.querySelectorAll('.item-card');
            if (cards.length) cards[cards.length - 1].scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });

        itemsList.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-item');
            if (!btn) return;

            const card = btn.closest('.item-card');
            const desc = card.querySelector('textarea[data-field="description"]');

            if (desc) {
                destroyEditor(desc.id).finally(function() {
                    card.remove();
                    renumberItems();
                });
            } else {
                card.remove();
                renumberItems();
            }
        });


        /* ============================================================
           FORM SUBMIT
           - Remove e.preventDefault() below if you want the form to
             actually POST to the server after logging the payload.
        ============================================================ */
        const form = document.getElementById('consultancyForm');
        const toast = document.getElementById('toast');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // <-- keep for prototype, remove for real submit

            const services = Array.from(servicesList.querySelectorAll('input'))
                .map(function(i) {
                    return i.value.trim();
                })
                .filter(Boolean);

            const items = Array.from(itemsList.querySelectorAll('.item-card')).map(function(card) {
                const imgInput = card.querySelector('input[type="file"]');
                const desc = card.querySelector('textarea[data-field="description"]');
                return {
                    image: imgInput && imgInput.files[0] ? imgInput.files[0].name : '',
                    heading: card.querySelector('[data-field="heading"]').value.trim(),
                    description: desc ? getEditorData(desc.id) : '',
                    link_text: card.querySelector('[data-field="link_text"]').value.trim()
                };
            });

            const heroFile = document.getElementById('heroImage').files[0];

            const payload = {
                section_one: {
                    first_heading: form.first_heading.value.trim(),
                    small_paragraph: getEditorData('smallParagraph'),
                    button1_text: form.button1_text.value.trim(),
                    button2_text: form.button2_text.value.trim(),
                    image: heroFile ? heroFile.name : '',
                    heading: form.heading.value.trim(),
                    description: getEditorData('sectionDescription'),
                    services: services,
                    button3_text: form.button3_text.value.trim()
                },
                section_two: items
            };

            console.log('IT Consultancy Payload:', payload);
            console.log(JSON.stringify(payload, null, 2));

            /* toast */
            toast.classList.remove('translate-x-[130%]');
            window.clearTimeout(toast._timer);
            toast._timer = window.setTimeout(function() {
                toast.classList.add('translate-x-[130%]');
            }, 2800);
        });


        /* ============================================================
           FORM RESET
        ============================================================ */
        form.addEventListener('reset', function() {
            setTimeout(function() {
                destroyAllEditors().then(function() {
                    servicesList.innerHTML = '';
                    itemsList.innerHTML = '';
                    itemSeq = 0;

                    addServiceRow('');
                    addServiceRow('');
                    addItemCard();

                    const heroPreview = document.getElementById('heroPreview');
                    if (heroPreview) {
                        heroPreview.src = '';
                        heroPreview.classList.add('hidden');
                    }

                    createEditor('smallParagraph');
                    createEditor('sectionDescription');
                    updateServiceCount();
                });
            }, 0);
        });


        /* ============================================================
           INITIAL STATE
        ============================================================ */
        addServiceRow('Cloud & DevOps Consulting');
        addServiceRow('Cybersecurity Solutions');
        addItemCard();

        createEditor('smallParagraph');
        createEditor('sectionDescription');
    </script>
@endsection