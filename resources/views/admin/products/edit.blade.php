@extends('layouts.master')

@section('content')

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}")
    </script>
@endif

@if($errors->any())
<script>
    @foreach ($errors->all() as $error)
        toastr.error("{{ $error }}")
    @endforeach
</script>
@endif
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Edit Product</h1>
                <p class="text-slate-500 mt-1">
                    Update the product details below.
                </p>
            </div>

            <a href="{{ route('admin.product.list') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">
                ← Back to Products
            </a>
        </div>


        <!-- Form -->
        <form id="productForm" action="{{ route('admin.product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data"
            class="bg-white shadow-sm rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-8">

            @csrf
            @method('PUT')


            <!-- =========================
                     Basic Information
                ========================== -->
            <section>

                <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-5 bg-brand-500 rounded"></span>
                    Basic Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Title <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="title" value="{{ old('title', $product->title) }}" required
                            placeholder="e.g. Wireless Noise-Cancelling Headphones"
                            class="w-full rounded-lg border-slate-300 border px-3 py-2.5 text-slate-800
                                   placeholder-slate-400 focus:outline-none focus:ring-2
                                   focus:ring-brand-500 focus:border-brand-500">

                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="category" value="{{ old('category', $product->category) }}" required
                            placeholder="Enter category name"
                            class="w-full rounded-lg border-slate-300 border px-3 py-2.5 text-slate-800
                                   placeholder-slate-400 focus:outline-none focus:ring-2
                                   focus:ring-brand-500 focus:border-brand-500">
                    </div>


                    <!-- Currency -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Currency <span class="text-red-500">*</span>
                        </label>

                        <select name="currency_code" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">

                            <option value="USD"
                                {{ old('currency_code', $product->currency_code) == 'USD' ? 'selected' : '' }}>
                                USD — US Dollar
                            </option>

                            <option value="EUR"
                                {{ old('currency_code', $product->currency_code) == 'EUR' ? 'selected' : '' }}>
                                EUR — Euro
                            </option>

                            <option value="GBP"
                                {{ old('currency_code', $product->currency_code) == 'GBP' ? 'selected' : '' }}>
                                GBP — British Pound
                            </option>

                            <option value="INR"
                                {{ old('currency_code', $product->currency_code) == 'INR' ? 'selected' : '' }}>
                                INR — Indian Rupee
                            </option>

                            <option value="AED"
                                {{ old('currency_code', $product->currency_code) == 'AED' ? 'selected' : '' }}>
                                AED — UAE Dirham
                            </option>

                        </select>
                    </div>


                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Price <span class="text-red-500">*</span>
                        </label>

                        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                            min="0" required placeholder="0.00"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">
                    </div>


                    <!-- Stock Price -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Stock Price
                        </label>

                        <input type="number" name="stock_price" value="{{ old('stock_price', $product->stock_price) }}"
                            step="0.01" min="0" placeholder="0.00"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">
                    </div>


                    <!-- Rating -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Rating (0–5)
                        </label>

                        <input type="number" name="rating" value="{{ old('rating', $product->rating) }}" step="0.1"
                            min="0" max="5" placeholder="4.5"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">
                    </div>


                    <!-- Rating Text -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Rating Text
                        </label>

                        <input type="text" name="rating_text" value="{{ old('rating_text', $product->rating_text) }}"
                            placeholder="e.g. 120 reviews"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">
                    </div>

                </div>
            </section>


            <!-- =========================
                     Description
                ========================== -->
            <section>

                <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-5 bg-brand-500 rounded"></span>
                    Description
                </h2>

                <textarea name="description" rows="5" placeholder="Write a detailed product description…"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                           focus:outline-none focus:ring-2 focus:ring-brand-500
                           focus:border-brand-500">{{ old('description', $product->description) }}</textarea>

            </section>


            <!-- =========================
                     Package Includes
                ========================== -->
            <section>

                <div class="flex items-center justify-between mb-4">

                    <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-brand-500 rounded"></span>
                        Package Includes
                    </h2>

                    <button type="button" id="addPackage" class="text-sm font-medium text-[#011810] hover:text-brand-700">
                        + Add item
                    </button>

                </div>


                <div id="packageWrap" class="space-y-3">

                    @php
                        $packages = old('package_includes', $product->package_includes ?? []);

                        if (is_string($packages)) {
                            $packages = json_decode($packages, true) ?? [];
                        }
                    @endphp


                    @forelse($packages as $package)
                        <div class="package-row flex gap-2">

                            <input type="text" name="package_includes[]" value="{{ $package }}"
                                placeholder="e.g. 1x Charging cable"
                                class="flex-1 rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                       focus:outline-none focus:ring-2 focus:ring-brand-500
                                       focus:border-brand-500">

                            <button type="button"
                                class="removeRow px-3 rounded-lg text-slate-400
                                       hover:text-red-500 hover:bg-red-50">
                                ✕
                            </button>

                        </div>

                    @empty

                        <div class="package-row flex gap-2">

                            <input type="text" name="package_includes[]" placeholder="e.g. 1x Charging cable"
                                class="flex-1 rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                       focus:outline-none focus:ring-2 focus:ring-brand-500
                                       focus:border-brand-500">

                            <button type="button"
                                class="removeRow px-3 rounded-lg text-slate-400
                                       hover:text-red-500 hover:bg-red-50">
                                ✕
                            </button>

                        </div>
                    @endforelse

                </div>

            </section>


            <!-- =========================
                     Product Image
                ========================== -->
            <section>

                <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-5 bg-brand-500 rounded"></span>
                    Product Image
                </h2>


                <!-- Existing Image -->
                <div id="imagePreview" class="mb-4">

                    @if ($product->images)
                        <div class="relative w-40 h-40 rounded-xl overflow-hidden border border-slate-200">

                            <img src="{{ asset( $product->images) }}" class="w-full h-full object-cover"
                                alt="{{ $product->title }}">

                            <span
                                class="absolute bottom-0 left-0 right-0 bg-black/60
                                       text-white text-xs text-center py-1">
                                Current Image
                            </span>

                        </div>
                    @endif

                </div>


                <!-- Upload -->
                <label for="imagesInput"
                    class="flex flex-col items-center justify-center w-full h-40
                           border-2 border-dashed border-slate-300 rounded-xl
                           cursor-pointer bg-slate-50 hover:bg-slate-100 transition">

                    <svg class="w-10 h-10 text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.9A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />

                    </svg>

                    <p class="text-sm text-slate-600">
                        <span class="font-medium text-brand-600">
                            Click to upload
                        </span>
                        or drag and drop
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        PNG, JPG, WEBP up to 5MB
                    </p>

                    <input id="imagesInput" type="file" name="images[]" accept="image/png,image/jpeg,image/webp"
                        class="hidden">

                </label>

            </section>


            <!-- =========================
                     Coupon
                ========================== -->
            <section>

                <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-5 bg-brand-500 rounded"></span>
                    Coupon (optional)
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Coupon Code
                        </label>

                        <input type="text" name="cupon_code" value="{{ old('cupon_code', $product->cupon_code) }}"
                            placeholder="e.g. SAVE10"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">

                    </div>


                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Coupon Price
                        </label>

                        <input type="number" name="cupon_price" value="{{ old('cupon_price', $product->cupon_price) }}"
                            step="0.01" min="0" placeholder="0.00"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-brand-500
                                   focus:border-brand-500">

                    </div>

                </div>

            </section>


            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">

                <a href="{{ route('admin.product.list') }}"
                    class="px-5 py-2.5 rounded-lg text-white font-medium
                           bg-[#d4af37] transition">
                    Back
                </a>

                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-[#011810]
                           hover:bg-brand-700 text-white font-medium
                           shadow-sm transition">
                    Update Product
                </button>

            </div>

        </form>

    </div>


    <!-- =========================
             JavaScript
        ========================== -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const addPackage = document.getElementById('addPackage');
            const packageWrap = document.getElementById('packageWrap');

            /*
            |--------------------------------------------------------------------------
            | Add Package
            |--------------------------------------------------------------------------
            */

            addPackage.addEventListener('click', function() {

                const row = document.createElement('div');

                row.className = 'package-row flex gap-2';

                row.innerHTML = `
                    <input
                        type="text"
                        name="package_includes[]"
                        placeholder="e.g. 1x Charging cable"
                        class="flex-1 rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800
                               focus:outline-none focus:ring-2 focus:ring-brand-500
                               focus:border-brand-500">

                    <button
                        type="button"
                        class="removeRow px-3 rounded-lg text-slate-400
                               hover:text-red-500 hover:bg-red-50">
                        ✕
                    </button>
                `;

                packageWrap.appendChild(row);

                row.querySelector('input').focus();
            });


            /*
            |--------------------------------------------------------------------------
            | Remove Package
            |--------------------------------------------------------------------------
            */

            packageWrap.addEventListener('click', function(e) {

                const removeButton = e.target.closest('.removeRow');

                if (!removeButton) {
                    return;
                }

                const row = removeButton.closest('.package-row');

                const rows = packageWrap.querySelectorAll('.package-row');

                if (rows.length > 1) {

                    row.remove();

                } else {

                    row.querySelector('input').value = '';

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Image Preview
            |--------------------------------------------------------------------------
            */

            const imagesInput = document.getElementById('imagesInput');
            const imagePreview = document.getElementById('imagePreview');


            if (imagesInput && imagePreview) {

                imagesInput.addEventListener('change', function() {

                    const file = this.files[0];

                    if (!file) {
                        return;
                    }


                    // Validate type
                    if (!file.type.startsWith('image/')) {

                        alert('Please select an image.');

                        this.value = '';

                        return;
                    }


                    // Validate size
                    if (file.size > 5 * 1024 * 1024) {

                        alert('Image must be less than 5MB.');

                        this.value = '';

                        return;
                    }


                    const reader = new FileReader();


                    reader.onload = function(e) {

                        imagePreview.innerHTML = `
                            <div class="relative w-40 h-40 rounded-xl overflow-hidden border border-slate-200">

                                <img
                                    src="${e.target.result}"
                                    class="w-full h-full object-cover"
                                    alt="New Product Image">

                                <button
                                    type="button"
                                    id="removeImage"
                                    class="absolute top-2 right-2 w-7 h-7
                                           flex items-center justify-center
                                           rounded-full bg-red-500 text-white
                                           hover:bg-red-600">
                                    ✕
                                </button>

                                <span
                                    class="absolute bottom-0 left-0 right-0
                                           bg-black/60 text-white text-xs
                                           text-center py-1">
                                    New Image
                                </span>

                            </div>
                        `;


                        // Remove new image
                        document
                            .getElementById('removeImage')
                            .addEventListener('click', function() {

                                imagesInput.value = '';

                                // Existing image ko wapas show karna
                                @if ($product->image)

                                    imagePreview.innerHTML = `
                                        <div class="relative w-40 h-40 rounded-xl overflow-hidden border border-slate-200">

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                class="w-full h-full object-cover"
                                                alt="{{ $product->title }}">

                                            <span
                                                class="absolute bottom-0 left-0 right-0
                                                       bg-black/60 text-white text-xs
                                                       text-center py-1">
                                                Current Image
                                            </span>

                                        </div>
                                    `;
                                @else

                                    imagePreview.innerHTML = '';
                                @endif

                            });

                    };


                    reader.readAsDataURL(file);

                });

            }

        });
    </script>
@endsection
