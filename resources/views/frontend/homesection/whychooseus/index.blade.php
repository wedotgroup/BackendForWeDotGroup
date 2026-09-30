@extends('layouts.master')
@section('content')
 
<div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Why Choose Us</h1>
            <p class="text-sm text-gray-500 mt-1">All entries listing</p>
        </div>
        <a href="{{ route('admin.hero.whychoose.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            + Add New
        </a>
    </div>

    <!-- ================= TOP CONTENT TABLE ================= -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-3 border-b bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Top Content</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-3 w-48 font-medium text-gray-600 bg-gray-50">Heading</td>
                    <td class="px-4 py-3 text-gray-800">Why Choose Us</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Description</td>
                    <td class="px-4 py-3 text-gray-800">We deliver excellence with quality and trust.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ================= MULTIPLE DATA TABLE ================= -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Multiple Data</h2>
            <span class="text-xs text-gray-500">3 item(s)</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3 font-semibold w-12">#</th>
                        <th class="px-4 py-3 font-semibold">Icon</th>
                        <th class="px-4 py-3 font-semibold">Title</th>
                        <th class="px-4 py-3 font-semibold">Description</th>
                        <th class="px-4 py-3 font-semibold">Link</th>
                        <th class="px-4 py-3 font-semibold">Image</th>
                        <th class="px-4 py-3 font-semibold">Thumbnail</th>
                        <th class="px-4 py-3 font-semibold text-center w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-500">1</td>
                        <td class="px-4 py-3">
                            <i class="fa-solid fa-star text-lg text-blue-600"></i>
                            <span class="text-xs text-gray-500 block">fa-star</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">Quality Service</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs">We provide top quality service to all customers.</td>
                        <td class="px-4 py-3">
                            <a href="https://example.com" target="_blank" class="text-blue-600 hover:underline">example.com</a>
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50" alt="image"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50" alt="thumbnail"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="rounded-md bg-yellow-500 px-2.5 py-1 text-xs font-semibold text-white hover:bg-yellow-600">Edit</button>
                                <button class="rounded-md bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-500">2</td>
                        <td class="px-4 py-3">
                            <i class="fa-solid fa-truck-fast text-lg text-blue-600"></i>
                            <span class="text-xs text-gray-500 block">fa-truck-fast</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">Fast Delivery</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs">Quick and reliable delivery at your doorstep.</td>
                        <td class="px-4 py-3">
                            <a href="https://example.com/delivery" target="_blank" class="text-blue-600 hover:underline">example.com/delivery</a>
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50/3b82f6" alt="image"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50/3b82f6" alt="thumbnail"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="rounded-md bg-yellow-500 px-2.5 py-1 text-xs font-semibold text-white hover:bg-yellow-600">Edit</button>
                                <button class="rounded-md bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-500">3</td>
                        <td class="px-4 py-3">
                            <i class="fa-solid fa-shield-halved text-lg text-blue-600"></i>
                            <span class="text-xs text-gray-500 block">fa-shield-halved</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">Secure Payment</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs">100% safe and secure payment gateway.</td>
                        <td class="px-4 py-3">
                            <a href="https://example.com/payment" target="_blank" class="text-blue-600 hover:underline">example.com/payment</a>
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50/10b981" alt="image"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3">
                            <img src="https://via.placeholder.com/50/10b981" alt="thumbnail"
                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="rounded-md bg-yellow-500 px-2.5 py-1 text-xs font-semibold text-white hover:bg-yellow-600">Edit</button>
                                <button class="rounded-md bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
