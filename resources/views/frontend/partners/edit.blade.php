@extends('layouts.master')

@section('content')

    {{-- Validation Errors --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error(@json($error));
                });
            </script>
        @endforeach
    @endif

    <div class="mx-auto w-full max-w-6xl">

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">

            {{-- Header --}}
            <div class="mb-8 flex items-start gap-4">

                <div
                    class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/25">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                        stroke="currentColor" class="h-6 w-6 text-white">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />

                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
                        Edit Logos
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Replace your existing logos with new images.
                    </p>
                </div>

            </div>


            <form action="{{ route('admin.partner.update', $logo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf



                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">


                    {{-- LEFT --}}
                    <div class="flex flex-col">


                        {{-- Drop Zone --}}
                        <div id="dropZone" role="button" tabindex="0" aria-label="Choose logo images"
                            class="group relative flex cursor-pointer flex-col items-center justify-center gap-3 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center outline-none transition duration-200 hover:border-indigo-400 hover:bg-indigo-50/60 focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-indigo-200">

                            <span
                                class="grid h-12 w-12 place-items-center rounded-full bg-white ring-1 ring-slate-200 transition duration-200 group-hover:scale-105 group-hover:ring-indigo-300">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.6" stroke="currentColor" class="h-6 w-6 text-indigo-500">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />

                                </svg>

                            </span>


                            <div>

                                <p class="text-sm font-semibold text-slate-700">

                                    Drop your new logos here, or

                                    <span class="text-indigo-600">
                                        browse files
                                    </span>

                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    You can select multiple images at once
                                </p>

                                <p class="mt-2 text-xs font-medium text-slate-400">
                                    JPG, JPEG, PNG, WEBP, SVG · Maximum 5 MB each
                                </p>

                            </div>

                        </div>


                        {{-- File Input --}}
                        <input id="fileInput" type="file" name="logos[]" accept=".jpg,.jpeg,.png,.webp,.svg,image/*"
                            multiple class="hidden">


                        {{-- Status --}}
                        <div id="statusBox"
                            class="mt-4 hidden items-start gap-2.5 rounded-xl px-3.5 py-3 text-sm font-medium ring-1">
                        </div>


                        {{-- Submit --}}
                        <button type="submit" id="runBtn"
                            class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition duration-200 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 active:scale-[0.99] disabled:cursor-not-allowed disabled:opacity-60">

                            <svg id="runIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-4 w-4">

                                <path d="M8 5.14v13.72a1 1 0 001.5.86l11-6.86a1 1 0 000-1.72l-11-6.86A1 1 0 008 5.14z" />

                            </svg>

                            <span id="runLabel">
                                Update Logos
                            </span>

                        </button>

                    </div>


                    {{-- RIGHT --}}
                    <div class="flex flex-col rounded-2xl border border-slate-200 bg-slate-50/60 p-5">


                        {{-- Header --}}
                        <div class="mb-4 flex items-center justify-between gap-3">

                            <div class="flex items-center gap-2">

                                <h2 class="text-sm font-semibold text-slate-800">
                                    New Logos
                                </h2>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-white px-2.5 py-0.5 text-[11px] font-medium text-slate-600 ring-1 ring-slate-200">

                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                    <span id="counter">
                                        0 logos
                                    </span>

                                </span>

                            </div>


                            <button type="button" id="clearBtn"
                                class="hidden rounded-lg px-2.5 py-1 text-xs font-semibold text-slate-500 transition hover:bg-red-50 hover:text-red-600">

                                Clear all

                            </button>

                        </div>


                        {{-- New Logo List --}}
                        <div id="listWrap" class="hidden max-h-[520px] space-y-3 overflow-y-auto pr-1">
                        </div>


                        {{-- Empty --}}
                        <div id="emptyState"
                            class="flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">

                            <span class="grid h-14 w-14 place-items-center rounded-full bg-slate-100 text-slate-400">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.6" stroke="currentColor" class="h-7 w-7">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />

                                </svg>

                            </span>

                            <p class="mt-3 text-sm font-medium text-slate-500">
                                No new logo selected
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Select new logos to replace the existing ones
                            </p>

                        </div>

                    </div>

                </div>

            </form>


            {{-- Existing Logos --}}
            <div class="mt-8 border-t border-slate-200 pt-8">

                <div class="mb-4 flex items-center justify-between">

                    <div>
                        <h2 class="text-base font-bold text-slate-800">
                            Current Logos
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            These logos will be replaced when you submit new logos.
                        </p>
                    </div>

                </div>
                @php
                    $logodata = $logo->logos ?? [];

                    
                    if (is_string($logodata)) {
                        $decoded = json_decode($logodata, true);
                        $logodata = is_array($decoded) ? $decoded : [];
                    }

                    $logodata = is_array($logodata) ? $logodata : [];
                @endphp

                @if (!empty($logodata))
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

                        @foreach ($logodata as $file)
                            <div
                                class="group relative flex aspect-square items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                                <img src="{{ asset('uploads/logos/' . $file) }}" alt="Logo"
                                    class="h-full w-full object-contain transition duration-300 group-hover:scale-105">

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">

                        <p class="text-sm text-slate-500">
                            No logos uploaded yet.
                        </p>

                    </div>
                @endif

            </div>


        </div>


        <p class="mt-5 text-center text-xs text-slate-400">
            Existing logos are replaced when you upload new logos.
        </p>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            "use strict";


            const form = document.getElementById("uploadForm");
            const dropZone = document.getElementById("dropZone");
            const fileInput = document.getElementById("fileInput");
            const listWrap = document.getElementById("listWrap");
            const emptyState = document.getElementById("emptyState");
            const counter = document.getElementById("counter");
            const clearBtn = document.getElementById("clearBtn");
            const runBtn = document.getElementById("runBtn");
            const runLabel = document.getElementById("runLabel");
            const statusBox = document.getElementById("statusBox");


            const MAX_SIZE = 5 * 1024 * 1024;


            let items = [];
            let uid = 0;
            let dragDepth = 0;


            /*
            |--------------------------------------------------------------------------
            | Helpers
            |--------------------------------------------------------------------------
            */

            function formatBytes(bytes) {

                if (bytes < 1024) {
                    return bytes + " B";
                }

                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(0) + " KB";
                }

                return (bytes / (1024 * 1024)).toFixed(1) + " MB";
            }


            function setStatus(message, type = "error") {

                const colors = {
                    error: "bg-red-50 text-red-700 ring-red-200",
                    success: "bg-emerald-50 text-emerald-700 ring-emerald-200",
                    info: "bg-indigo-50 text-indigo-700 ring-indigo-200"
                };

                statusBox.className =
                    "mt-4 flex items-start gap-2.5 rounded-xl px-3.5 py-3 text-sm font-medium ring-1 " +
                    colors[type];

                statusBox.textContent = message;

                statusBox.classList.remove("hidden");
            }


            function hideStatus() {

                statusBox.classList.add("hidden");

            }


            /*
            |--------------------------------------------------------------------------
            | Sync files with input
            |--------------------------------------------------------------------------
            */

            function syncInput() {

                const dataTransfer = new DataTransfer();

                items.forEach(function(item) {

                    dataTransfer.items.add(item.file);

                });

                fileInput.files = dataTransfer.files;

            }


            /*
            |--------------------------------------------------------------------------
            | Add files
            |--------------------------------------------------------------------------
            */

            function addFiles(fileList) {

                const rejected = [];

                Array.from(fileList).forEach(function(file) {


                    if (!file.type.startsWith("image/")) {

                        rejected.push(file.name + " is not an image.");

                        return;

                    }


                    if (file.size > MAX_SIZE) {

                        rejected.push(file.name + " exceeds 5 MB.");

                        return;

                    }


                    const duplicate = items.some(function(item) {

                        return (
                            item.file.name === file.name &&
                            item.file.size === file.size &&
                            item.file.lastModified === file.lastModified
                        );

                    });


                    if (duplicate) {
                        return;
                    }


                    items.push({

                        id: "file-" + (++uid),

                        file: file,

                        url: URL.createObjectURL(file)

                    });

                });


                syncInput();

                render();


                if (rejected.length) {

                    setStatus(
                        rejected.join(" "),
                        "error"
                    );

                } else {

                    hideStatus();

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Remove item
            |--------------------------------------------------------------------------
            */

            function removeItem(id) {

                const index = items.findIndex(function(item) {

                    return item.id === id;

                });


                if (index === -1) {
                    return;
                }


                URL.revokeObjectURL(items[index].url);

                items.splice(index, 1);

                syncInput();

                render();

            }


            /*
            |--------------------------------------------------------------------------
            | Clear all
            |--------------------------------------------------------------------------
            */

            function clearAll() {

                items.forEach(function(item) {

                    URL.revokeObjectURL(item.url);

                });


                items = [];

                syncInput();

                render();

                hideStatus();

            }


            /*
            |--------------------------------------------------------------------------
            | Render
            |--------------------------------------------------------------------------
            */

            function render() {

                listWrap.innerHTML = "";


                items.forEach(function(item) {


                    const row = document.createElement("div");

                    row.className =
                        "flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-indigo-200 hover:shadow-md";


                    const left = document.createElement("div");

                    left.className =
                        "grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-2";


                    const img = document.createElement("img");

                    img.src = item.url;

                    img.alt = item.file.name;

                    img.className = "h-full w-full object-contain";


                    left.appendChild(img);


                    const right = document.createElement("div");

                    right.className = "min-w-0 flex-1";


                    const name = document.createElement("p");

                    name.className =
                        "truncate text-sm font-semibold text-slate-800";

                    name.textContent = item.file.name;

                    name.title = item.file.name;


                    const meta = document.createElement("p");

                    meta.className = "mt-1 text-xs text-slate-500";

                    meta.textContent =
                        formatBytes(item.file.size);


                    right.appendChild(name);

                    right.appendChild(meta);


                    const remove = document.createElement("button");

                    remove.type = "button";

                    remove.className =
                        "grid h-9 w-9 shrink-0 place-items-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600";


                    remove.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/>' +
                        '</svg>';


                    remove.addEventListener("click", function() {

                        removeItem(item.id);

                    });


                    row.appendChild(left);

                    row.appendChild(right);

                    row.appendChild(remove);


                    listWrap.appendChild(row);

                });


                const count = items.length;


                counter.textContent =
                    count === 1 ?
                    "1 logo" :
                    count + " logos";


                if (count > 0) {

                    listWrap.classList.remove("hidden");

                    emptyState.classList.add("hidden");

                    clearBtn.classList.remove("hidden");

                } else {

                    listWrap.classList.add("hidden");

                    emptyState.classList.remove("hidden");

                    clearBtn.classList.add("hidden");

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Drop zone
            |--------------------------------------------------------------------------
            */

            dropZone.addEventListener("click", function() {

                fileInput.click();

            });


            dropZone.addEventListener("keydown", function(event) {

                if (
                    event.key === "Enter" ||
                    event.key === " "
                ) {

                    event.preventDefault();

                    fileInput.click();

                }

            });


            ["dragenter", "dragover"].forEach(function(eventName) {

                dropZone.addEventListener(eventName, function(event) {

                    event.preventDefault();

                    dragDepth++;

                    dropZone.classList.add(
                        "border-indigo-500",
                        "bg-indigo-50"
                    );

                });

            });


            dropZone.addEventListener("dragleave", function(event) {

                event.preventDefault();

                dragDepth = Math.max(
                    0,
                    dragDepth - 1
                );


                if (dragDepth === 0) {

                    dropZone.classList.remove(
                        "border-indigo-500",
                        "bg-indigo-50"
                    );

                }

            });


            dropZone.addEventListener("drop", function(event) {

                event.preventDefault();

                dragDepth = 0;


                dropZone.classList.remove(
                    "border-indigo-500",
                    "bg-indigo-50"
                );


                if (
                    event.dataTransfer &&
                    event.dataTransfer.files.length
                ) {

                    addFiles(
                        event.dataTransfer.files
                    );

                }

            });


            /*
            |--------------------------------------------------------------------------
            | File input
            |--------------------------------------------------------------------------
            */

            fileInput.addEventListener("change", function() {

                if (fileInput.files.length) {

                    addFiles(fileInput.files);

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Clear
            |--------------------------------------------------------------------------
            */

            clearBtn.addEventListener(
                "click",
                clearAll
            );


            /*
            |--------------------------------------------------------------------------
            | Actual form submit
            |--------------------------------------------------------------------------
            */

            form.addEventListener("submit", function(event) {


                if (items.length === 0) {

                    event.preventDefault();

                    setStatus(
                        "Please select at least one new logo.",
                        "error"
                    );

                    dropZone.focus();

                    return;

                }


                runBtn.disabled = true;

                runLabel.textContent =
                    "Updating Logos...";

            });



            render();

        });
    </script>

@endsection
