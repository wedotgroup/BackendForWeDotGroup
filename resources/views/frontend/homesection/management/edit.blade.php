@extends('layouts.master')
@section('content')
   
<div class="bg-gray-50 min-h-screen py-10">

<div class="max-w-6xl mx-auto px-4">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Management Consultancy</h1>

    <form id="whyForm" enctype="multipart/form-data">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

            <!-- ============ LEFT BOX: TOP CONTENT ============ -->
            

            <!-- ============ RIGHT BOX: MULTIPLE DATA ============ -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4 pb-2 border-b">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        Multiple Data
                    </h2>
                    <button type="button" id="add-more"
                            class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                        + Add More
                    </button>
                </div>

                <div id="multiple-data-container" data-next-index="1" class="space-y-4 max-h-[600px] overflow-y-auto pr-1">

                    <!-- Row 1 -->
                    <div class="multiple-data-row rounded-md border border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="row-number text-xs font-semibold text-gray-500 uppercase">Item 1</span>
                            <button type="button" class="remove-row text-xs text-red-600 hover:underline">Remove</button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <!-- Text inputs (4) -->
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Icon</label>
                                <input type="text" name="icons" placeholder="fa-star"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                <input type="text" name="title" placeholder="Enter title"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                <textarea name="description" rows="2" placeholder="Enter description"
                                          class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Link Content</label>
                                <input type="text" name="link_text" placeholder="https://example.com"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>

                            <!-- File inputs (2) -->
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Upload PDF</label>
                                <input type="file" name="pdf_image" accept="image/*"
                                       class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Thumbnail</label>
                                <input type="file" name="thumbnail" accept="image/*"
                                       class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 lg:sticky lg:top-6">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4 pb-2 border-b">
                    Top Content
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="top_heading" placeholder="Enter heading"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="top_des" rows="4" placeholder="Enter description"
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= BUTTONS ================= -->
        <div class="flex justify-end gap-3 mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <a href="{{route('admin.hero.whychoose')}}"
                        class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 active:scale-[.98]">
                        Cancel
                    </a>
            <button type="submit"
                    class="rounded-md bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                ▶ Run / Submit
            </button>
        </div>
    </form>

    <!-- Output -->
    <div id="output" class="hidden mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-semibold text-gray-700 mb-2">Submitted Data:</h3>
        <pre class="bg-gray-50 border rounded-md p-3 text-xs text-gray-800 overflow-auto"></pre>
    </div>

</div>

<!-- Template -->
<template id="multiple-data-template">
    <div class="multiple-data-row rounded-md border border-gray-200 bg-gray-50 p-4">
        <div class="flex items-center justify-between mb-3">
            <span class="row-number text-xs font-semibold text-gray-500 uppercase"></span>
            <button type="button" class="remove-row text-xs text-red-600 hover:underline">Remove</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Icon</label>
                <input type="text" name="icons" placeholder="fa-star"
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                <input type="text" name="title" placeholder="Enter title"
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="2" placeholder="Enter description"
                          class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"></textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Link Content</label>
                <input type="text" name="link_text" placeholder=""
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
                <input type="file" name="pdf_image" accept="image/*"
                       class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
            </div>
        </div>
    </div>
</template>

<script>
    const container = document.getElementById('multiple-data-container');
    const template = document.getElementById('multiple-data-template');
    const addButton = document.getElementById('add-more');
    const form = document.getElementById('whyForm');
    const output = document.getElementById('output');
    const pre = output.querySelector('pre');

    function renumber() {
        container.querySelectorAll('.multiple-data-row').forEach((row, i) => {
            row.querySelector('.row-number').textContent = 'Item ' + (i + 1);
        });
    }

    addButton.addEventListener('click', () => {
        const index = parseInt(container.dataset.nextIndex) || 0;
        const html = template.innerHTML.replace(/__INDEX__/g, index);
        container.insertAdjacentHTML('beforeend', html);
        container.dataset.nextIndex = index + 1;
        renumber();
    });

    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-row')) {
            const row = e.target.closest('.multiple-data-row');
            if (container.querySelectorAll('.multiple-data-row').length > 1) {
                row.remove();
                renumber();
            } else {
                row.querySelectorAll('input, textarea').forEach(f => {
                    if (f.type === 'file') f.value = '';
                    else f.value = '';
                });
            }
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const fd = new FormData(form);
        const data = { top_content: {}, multiple_data: [] };

        for (const [key, value] of fd.entries()) {
            const mTop = key.match(/^top_content\[(.+)\]$/);
            const mMulti = key.match(/^multiple_data\[(\d+)\]\[(.+)\]$/);
            if (mTop) {
                data.top_content[mTop[1]] = value;
            } else if (mMulti) {
                const idx = parseInt(mMulti[1]);
                const field = mMulti[2];
                if (!data.multiple_data[idx]) data.multiple_data[idx] = {};
                data.multiple_data[idx][field] = (value instanceof File)
                    ? `[File: ${value.name || 'empty'}]`
                    : value;
            }
        }
        data.multiple_data = data.multiple_data.filter(Boolean);

        pre.textContent = JSON.stringify(data, null, 2);
        output.classList.remove('hidden');
        output.scrollIntoView({ behavior: 'smooth' });
    });

    renumber();
</script>
@endsection
