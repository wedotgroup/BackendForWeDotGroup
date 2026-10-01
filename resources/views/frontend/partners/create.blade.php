@extends('layouts.master')
@section('content')
@if($errors->any())
@foreach ($errors->all() as $error)
    <script>
        toastr.error("{{ $error }}");
    </script>
@endforeach
@endif
    <div class="mx-auto w-full max-w-5xl">

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

                <div class="flex flex-col">

                    <!-- Header -->
                    <div class="mb-6 flex items-start gap-4">
                        <div
                            class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                                stroke="currentColor" class="h-6 w-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">Upload Logos</h1>
                            <p class="mt-1 text-sm text-slate-500">
                                Drag &amp; drop or browse · PNG, JPG, SVG, WEBP · up to 5&nbsp;MB each
                            </p>
                        </div>
                    </div>

                    <form  action="{{ route('admin.partner.store') }}" method="POST"
                        class="flex flex-1 flex-col space-y-5" enctype="multipart/form-data">
                        @csrf

                        <!-- Drop zone -->
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
                                    Drop your logos here, or <span
                                        class="text-indigo-600 group-hover:text-indigo-500">browse files</span>
                                </p>
                                <p class="mt-1 text-xs text-slate-500">You can select multiple images at once</p>
                            </div>
                        </div>

                        <!-- Real submitted field -->
                        <input id="fileInput" type="file" name="logos[]" accept="image/*" multiple class="hidden" />

                        <!-- Progress -->
                        <div id="progressWrap" class="hidden">
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-200">
                                <div id="progressBar"
                                    class="h-full w-0 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 transition-all duration-200">
                                </div>
                            </div>
                            <p id="progressText" class="mt-2 text-center text-xs text-slate-500">Uploading… 0%</p>
                        </div>

                        <!-- Status -->
                        <div id="statusBox"
                            class="hidden items-start gap-2.5 rounded-xl px-3.5 py-3 text-sm font-medium ring-1"></div>

                        <!-- Run button -->
                        <button type="submit"
                            class="group relative mt-auto flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition duration-200 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 active:scale-[0.99] disabled:cursor-not-allowed disabled:opacity-60 disabled:active:scale-100">
                            <svg id="runIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-4 w-4">
                                <path d="M8 5.14v13.72a1 1 0 001.5.86l11-6.86a1 1 0 000-1.72l-11-6.86A1 1 0 008 5.14z" />
                            </svg>
                            <span id="runLabel">Run Upload</span>
                        </button>
                    </form>
                </div>

                <div class="flex flex-col rounded-2xl border border-slate-200 bg-slate-50/60 p-5">

                    <!-- Right header -->
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <h2 class="text-sm font-semibold text-slate-800">Selected Logos</h2>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-white px-2.5 py-0.5 text-[11px] font-medium text-slate-600 ring-1 ring-slate-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                <span id="counter">0 logos</span>
                            </span>
                        </div>

                        <button type="button" id="clearBtn"
                            class="hidden rounded-lg px-2.5 py-1 text-xs font-semibold text-slate-500 transition hover:bg-red-50 hover:text-red-600">
                            Clear all
                        </button>
                    </div>

                    <p id="sizeInfo" class="mb-3 hidden text-xs text-slate-500"></p>

                    <!-- Logo list -->
                    <div id="listWrap" class="hidden max-h-[520px] space-y-3 overflow-y-auto pr-1"></div>

                    <!-- Empty state -->
                    <div id="emptyState"
                        class="flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                        <span class="grid h-14 w-14 place-items-center rounded-full bg-slate-100 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6"
                                stroke="currentColor" class="h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M18 9h.008v.008H18V9zm-1.5-6.75h3A2.25 2.25 0 0121.75 4.5v15A2.25 2.25 0 0119.5 21.75h-15A2.25 2.25 0 012.25 19.5v-15A2.25 2.25 0 014.5 2.25h12z" />
                            </svg>
                        </span>
                        <p class="mt-3 text-sm font-medium text-slate-500">No logo selected yet</p>
                        <p class="mt-1 text-xs text-slate-400">Your selected logos will appear here</p>
                    </div>

                </div>
            </div>
        </div>

        <p class="mt-5 text-center text-xs text-slate-400">
            Field name: <code class="rounded bg-slate-100 px-1.5 py-0.5 text-slate-600">upload logos</code>
        </p>
    </div>

    <script>
        (function() {
            "use strict";

            /* ---------- Elements ---------- */
            const form = document.getElementById("uploadForm");
            const dropZone = document.getElementById("dropZone");
            const fileInput = document.getElementById("fileInput");
            const listWrap = document.getElementById("listWrap");
            const emptyState = document.getElementById("emptyState");
            const counter = document.getElementById("counter");
            const sizeInfo = document.getElementById("sizeInfo");
            const clearBtn = document.getElementById("clearBtn");
            const runBtn = document.getElementById("runBtn");
            const runLabel = document.getElementById("runLabel");
            const runIcon = document.getElementById("runIcon");
            const statusBox = document.getElementById("statusBox");
            const progressWrap = document.getElementById("progressWrap");
            const progressBar = document.getElementById("progressBar");
            const progressText = document.getElementById("progressText");

            const MAX_SIZE = 5 * 1024 * 1024; // 5 MB

            /** @type {{id:string, file:File, url:string}[]} */
            let items = [];
            let uid = 0;
            let dragDepth = 0;
            let busy = false;

            /* ---------- Utils ---------- */
            const formatBytes = (b) =>
                b < 1024 ? b + " B" :
                b < 1048576 ? (b / 1024).toFixed(0) + " KB" :
                (b / 1048576).toFixed(1) + " MB";

            const escapeHtml = (s) =>
                String(s).replace(/[&<>"']/g, (c) => ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    '"': "&quot;",
                    "'": "&#39;"
                } [c]));

            const shortType = (mime) => {
                if (!mime) return "—";
                const sub = mime.split("/")[1] || mime;
                return sub.toUpperCase().replace("SVG+XML", "SVG").replace("JPEG", "JPG");
            };

            const ICONS = {
                success: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 shrink-0"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>',
                error: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 shrink-0"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>',
                info: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 shrink-0"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>'
            };

            const STATUS_STYLES = {
                success: "bg-emerald-50 text-emerald-700 ring-emerald-200",
                error: "bg-red-50 text-red-700 ring-red-200",
                info: "bg-indigo-50 text-indigo-700 ring-indigo-200"
            };

            function setStatus(message, type) {
                statusBox.className =
                    "flex items-start gap-2.5 rounded-xl px-3.5 py-3 text-sm font-medium ring-1 " +
                    STATUS_STYLES[type];
                statusBox.innerHTML = ICONS[type] + "<span>" + escapeHtml(message) + "</span>";
                statusBox.classList.remove("hidden");
            }

            function hideStatus() {
                statusBox.classList.add("hidden");
            }

            /* ---------- Sync real input ---------- */
            function syncInput() {
                const dt = new DataTransfer();
                items.forEach((i) => dt.items.add(i.file));
                fileInput.files = dt.files;
            }

            /* ---------- Add / remove ---------- */
            function addFiles(fileList) {
                const rejected = [];

                Array.from(fileList).forEach((file) => {
                    if (!file.type.startsWith("image/")) {
                        rejected.push(file.name + " is not an image");
                        return;
                    }
                    if (file.size > MAX_SIZE) {
                        rejected.push(file.name + " exceeds 5 MB");
                        return;
                    }
                    const dup = items.some(
                        (i) =>
                        i.file.name === file.name &&
                        i.file.size === file.size &&
                        i.file.lastModified === file.lastModified
                    );
                    if (dup) return;

                    items.push({
                        id: "f" + ++uid,
                        file: file,
                        url: URL.createObjectURL(file)
                    });
                });

                if (rejected.length) setStatus(rejected.join(" · "), "error");
                else hideStatus();

                syncInput();
                render();
            }

            function removeItem(id) {
                const i = items.findIndex((x) => x.id === id);
                if (i === -1) return;
                URL.revokeObjectURL(items[i].url);
                items.splice(i, 1);
                syncInput();
                render();
            }

            function clearAll() {
                items.forEach((i) => URL.revokeObjectURL(i.url));
                items = [];
                syncInput();
                render();
                hideStatus();
            }

            /* ---------- Render right-side list ---------- */
            function render() {
                listWrap.innerHTML = "";

                items.forEach((item) => {
                    const row = document.createElement("div");
                    row.className =
                        "flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-indigo-200 hover:shadow-md";

                    /* LEFT — thumbnail */
                    const left = document.createElement("div");
                    left.className =
                        "grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-2";

                    const img = document.createElement("img");
                    img.src = item.url;
                    img.alt = item.file.name;
                    img.className = "h-full w-full object-contain";
                    left.appendChild(img);

                    /* RIGHT — details */
                    const right = document.createElement("div");
                    right.className = "min-w-0 flex-1";

                    const nameEl = document.createElement("p");
                    nameEl.className = "truncate text-sm font-semibold text-slate-800";
                    nameEl.title = item.file.name;
                    nameEl.textContent = item.file.name;

                    const meta = document.createElement("div");
                    meta.className = "mt-1.5 flex flex-wrap items-center gap-2";

                    const typePill = document.createElement("span");
                    typePill.className =
                        "inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-[11px] font-semibold text-indigo-700 ring-1 ring-indigo-200";
                    typePill.textContent = shortType(item.file.type);

                    const sizeEl = document.createElement("span");
                    sizeEl.className = "text-xs text-slate-500";
                    sizeEl.textContent = formatBytes(item.file.size);

                    meta.append(typePill, sizeEl);
                    right.append(nameEl, meta);

                    /* Remove */
                    const remove = document.createElement("button");
                    remove.type = "button";
                    remove.setAttribute("aria-label", "Remove " + item.file.name);
                    remove.className =
                        "grid h-9 w-9 shrink-0 place-items-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-300";
                    remove.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-4 w-4"><path d="M6 6l12 12M18 6L6 18" /></svg>';
                    remove.addEventListener("click", () => removeItem(item.id));

                    row.append(left, right, remove);
                    listWrap.appendChild(row);
                });

                const n = items.length;
                const total = items.reduce((s, i) => s + i.file.size, 0);

                counter.textContent = n === 1 ? "1 logo" : n + " logos";

                if (n > 0) {
                    sizeInfo.textContent = "Total size: " + formatBytes(total);
                    sizeInfo.classList.remove("hidden");
                    clearBtn.classList.remove("hidden");
                    emptyState.classList.add("hidden");
                    listWrap.classList.remove("hidden");
                } else {
                    sizeInfo.classList.add("hidden");
                    clearBtn.classList.add("hidden");
                    emptyState.classList.remove("hidden");
                    listWrap.classList.add("hidden");
                }
            }

            /* ---------- Drop zone events ---------- */
            const setDragStyle = (on) => {
                dropZone.classList.toggle("border-indigo-500", on);
                dropZone.classList.toggle("bg-indigo-50", on);
                dropZone.classList.toggle("scale-[1.01]", on);
            };

            dropZone.addEventListener("click", () => {
                if (!busy) fileInput.click();
            });

            dropZone.addEventListener("keydown", (e) => {
                if (e.key === "Enter" || e.key === " ") {
                    e.preventDefault();
                    if (!busy) fileInput.click();
                }
            });

            ["dragenter", "dragover"].forEach((evt) =>
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    if (evt === "dragenter") dragDepth++;
                    setDragStyle(true);
                })
            );

            dropZone.addEventListener("dragleave", (e) => {
                e.preventDefault();
                dragDepth = Math.max(0, dragDepth - 1);
                if (dragDepth === 0) setDragStyle(false);
            });

            dropZone.addEventListener("drop", (e) => {
                e.preventDefault();
                dragDepth = 0;
                setDragStyle(false);
                if (busy) return;
                if (e.dataTransfer && e.dataTransfer.files.length) {
                    addFiles(e.dataTransfer.files);
                }
            });

            fileInput.addEventListener("change", () => {
                if (fileInput.files.length) addFiles(fileInput.files);
            });

            clearBtn.addEventListener("click", clearAll);

            /* ---------- Run (simulated upload) ---------- */
            function setBusy(state) {
                busy = state;
                runBtn.disabled = state;
                runLabel.textContent = state ? "Uploading…" : "Run Upload";
                runIcon.outerHTML = state ?
                    '<svg id="runIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4 animate-spin"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.3" stroke-width="3" /><path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" /></svg>' :
                    '<svg id="runIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M8 5.14v13.72a1 1 0 001.5.86l11-6.86a1 1 0 000-1.72l-11-6.86A1 1 0 008 5.14z" /></svg>';
            }

            runBtn.addEventListener("click", () => {
                if (busy) return;

                if (items.length === 0) {
                    setStatus("Please add at least one logo before running.", "error");
                    dropZone.focus();
                    return;
                }

                hideStatus();
                setBusy(true);

                progressWrap.classList.remove("hidden");
                progressBar.style.width = "0%";
                progressText.textContent = "Uploading… 0%";

                let pct = 0;
                const timer = setInterval(() => {
                    pct = Math.min(100, pct + Math.random() * 16 + 7);
                    const rounded = Math.round(pct);

                    progressBar.style.width = pct + "%";
                    progressText.textContent = "Uploading… " + rounded + "%";

                    if (pct >= 100) {
                        clearInterval(timer);

                        setTimeout(() => {
                            progressWrap.classList.add("hidden");
                            setBusy(false);

                            const totalSize = items.reduce((s, i) => s + i.file.size, 0);
                            setStatus(
                                "Successfully uploaded " +
                                items.length +
                                (items.length === 1 ? " logo" : " logos") +
                                " (" + formatBytes(totalSize) + ").",
                                "success"
                            );


                        }, 350);
                    }
                }, 200);
            });

            form.addEventListener("submit", (e) => e.preventDefault());


            render();
        })();
    </script>
@endsection
