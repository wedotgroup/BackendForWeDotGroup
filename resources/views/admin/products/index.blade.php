@extends('layouts.master')
@section('content')

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        </script>
    @endif
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Products</h1>
                <p class="text-slate-500 text-sm mt-1">Manage your product catalog</p>
            </div>
            <a href="{{ url("admin/create") }}"
                class="inline-flex items-center justify-center gap-2 bg-[#011810] hover:bg-brand-700
               text-white text-sm font-medium px-4 py-2.5 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <!-- Toolbar -->
            <div class="p-4 border-b border-slate-200 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
                <div class="relative w-full md:max-w-xs">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                    <input id="searchInput" type="text" placeholder="Search products…"
                        class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-300 text-sm text-slate-800
                   placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500" />
                </div>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">#</th>
                            <th class="px-4 py-3 text-left font-semibold">Product</th>
                            <th class="px-4 py-3 text-left font-semibold">Category</th>
                            <th class="px-4 py-3 text-right font-semibold">Price</th>
                            <th class="px-4 py-3 text-right font-semibold">Stock Price</th>
                            <th class="px-4 py-3 text-center font-semibold">Rating</th>
                            <th class="px-4 py-3 text-center font-semibold">Coupon</th>
                            <th class="px-4 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse ($products as $index => $product)
                            <tr class="product-row hover:bg-slate-50 transition">

                                <!-- # -->
                                <td class="px-4 py-4">
                                    {{ $index + 1 }}
                                </td>

                                <!-- Product -->
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if ($product->images)
                                            <img src="{{ asset($product->images) }}" alt="{{ $product->title }}"
                                                class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4-4 4 4 4-5 4 5" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $product->title }}
                                            </p>

                                            @if ($product->top_highlights)
                                                <p class="text-xs text-slate-400 mt-1">
                                                    {{ Str::limit($product->top_highlights, 50) }}
                                                </p>
                                            @endif
                                        </div>

                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-4 py-4">
                                    @if ($product->category)
                                        <span
                                            class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium">
                                            {{ $product->category }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                <!-- Price -->
                                <td class="px-4 py-4 text-right">
                                    <div class="font-semibold text-slate-800">
                                        {{ $product->currency_code }} {{ number_format($product->price, 2) }}
                                    </div>
                                </td>

                                <!-- Stock Price -->
                                <td class="px-4 py-4 text-right">
                                    @if ($product->stock_price)
                                        <span class="font-medium text-slate-700">
                                            {{ $product->currency_code }}
                                            {{ number_format($product->stock_price, 2) }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                <!-- Rating -->
                                <td class="px-4 py-4 text-center">
                                    @if ($product->rating !== null)
                                        <div class="inline-flex items-center gap-1">
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921
                                    1.603-.921 1.902 0l1.07 3.292a1
                                    1 0 00.95.69h3.462c.969 0
                                    1.371 1.24.588 1.81l-2.8
                                    2.034a1 1 0 00-.364 1.118l1.07
                                    3.292c.3.921-.755 1.688-1.54
                                    1.118l-2.8-2.034a1 1 0
                                    00-1.175 0l-2.8 2.034c-.784.57
                                    -1.838-.197-1.539-1.118l1.07-3.292a1
                                    1 0 00-.364-1.118L2.91
                                    8.72c-.783-.57-.38-1.81.588-1.81H6.96a1
                                    1 0 00.95-.69l1.07-3.292z" />
                                            </svg>

                                            <span class="font-medium">
                                                {{ $product->rating }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                <!-- Coupon -->
                                <td class="px-4 py-4 text-center">

                                    @if ($product->cupon_code)
                                        <div class="flex flex-col items-center gap-1">

                                            <span
                                                class="px-2.5 py-1 rounded-md
                                     bg-green-50 text-green-700
                                     text-xs font-semibold">
                                                {{ $product->cupon_code }}
                                            </span>

                                            @if ($product->cupon_price)
                                                <span class="text-xs text-slate-500">
                                                    {{ $product->currency_code }}
                                                    {{ number_format($product->cupon_price, 2) }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif

                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit -->
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="inline-flex items-center justify-center
                              w-9 h-9 rounded-lg
                              bg-blue-50 text-blue-600
                              hover:bg-blue-100 transition"
                                            title="Edit">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2
                                          2v11a2 2 0 002 2h11a2
                                          2 0 002-2v-5M18.5
                                          2.5a2.121 2.121 0
                                          113 3L12 15l-4 1
                                          1-4 6.5-6.5z" />
                                            </svg>

                                        </a>


                                        <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST">
                                            @csrf
                                             @method('DELETE')
                                            <button type="submit"
                                                class="deleteBtn inline-flex items-center justify-center
                                                w-9 h-9 rounded-lg
                                                bg-red-50 text-red-600
                                                hover:bg-red-100 transition"
                                                title="Delete">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2
                                                        2 0 0116.138 21H7.862a2
                                                        2 0 01-1.995-1.858L5
                                                        7m5 4v6m4-6v6M9 7V4a1
                                                        1 0 011-1h4a1 1 0
                                                        011 1v3m-9 0h14" />
                                                </svg>

                                            </button>
                                        </form>


                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="py-14 text-center">

                                    <svg class="w-14 h-14 mx-auto text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16
                                  0l-8 4m8-4v10l-8
                                  4m0-10L4 7m8 4v10M4
                                  7v10l8 4" />

                                    </svg>

                                    <p class="mt-3 text-slate-500 font-medium">
                                        No products found
                                    </p>

                                    <p class="text-slate-400 text-xs">
                                        Add a new product to get started.
                                    </p>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <!-- Empty state -->
                <div id="emptyState" class="hidden py-14 text-center">
                    <svg class="w-14 h-14 mx-auto text-slate-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="mt-3 text-slate-500 font-medium">No products found</p>
                    <p class="text-slate-400 text-xs">Try adjusting your filters or add a new product.</p>
                </div>
            </div>

            <!-- Footer / Pagination -->
            <div class="p-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p id="pageInfo" class="text-xs text-slate-500">Showing 0 of 0 products</p>
                <div id="pagination" class="flex items-center gap-1"></div>
            </div>
        </div>
    </div>



    <!-- Toast -->
    <div id="toast"
        class="fixed bottom-6 right-6 px-5 py-3 rounded-lg shadow-lg text-white
           opacity-0 translate-y-3 pointer-events-none transition-all duration-300">
    </div>

@endsection
