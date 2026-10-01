@extends('layouts.master')

@section('content')

@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

<div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
               Management Consultancy
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                All entries listing
            </p>
        </div>

        <a href="{{ route('admin.manageconsul.create') }}"
           class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            + Add New
        </a>
    </div>


    @forelse($whyChooses as $whyChoose)

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">

            <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">

                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Top Content
                </h2>

                <div class="flex gap-2">

                    <a href="{{ route('admin.hero.whychoose.edit', $whyChoose->id) }}"
                       class="rounded-md bg-yellow-500 px-3 py-1 text-xs font-semibold text-white hover:bg-yellow-600">
                        Edit
                    </a>

                    <form action="{{ route('admin.hero.whychoose.destroy', $whyChoose->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this data?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="rounded-md bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700">
                            Delete
                        </button>

                    </form>

                </div>

            </div>


            <table class="w-full text-sm">

                <tbody class="divide-y divide-gray-100">

                    <tr>
                        <td class="px-4 py-3 w-48 font-medium text-gray-600 bg-gray-50">
                            Heading
                        </td>

                        <td class="px-4 py-3 text-gray-800">
                            {{ $whyChoose->top_content['top_heading'] ?? 'N/A' }}
                        </td>
                    </tr>


                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-600 bg-gray-50">
                            Description
                        </td>

                        <td class="px-4 py-3 text-gray-800">
                            {{ $whyChoose->top_content['top_des'] ?? 'N/A' }}
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>


        <!-- ================= MULTIPLE DATA ================= -->

        @php
            $multipleData = $whyChoose->multiple_data ?? [];
        @endphp

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">

            <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">

                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Multiple Data
                </h2>

                <span class="text-xs text-gray-500">
                    {{ count($multipleData) }} item(s)
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">

                        <tr>

                            <th class="px-4 py-3 font-semibold w-12">
                                #
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Icon
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Title
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Description
                            </th>

                            

                            <th class="px-4 py-3 font-semibold">
                                Thumbnail
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($multipleData as $key => $item)

                            <tr class="hover:bg-gray-50">

                                <!-- Number -->
                                <td class="px-4 py-3 font-medium text-gray-500">
                                    {{ $key + 1 }}
                                </td>


                                <!-- Icon -->
                                <td class="px-4 py-3">

                                    @if(!empty($item['icon']))

                                        <i class="{{ $item['icon'] }} text-lg text-blue-600"></i>

                                        <span class="text-xs text-gray-500 block">
                                            {{ $item['icon'] }}
                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            No icon
                                        </span>

                                    @endif

                                </td>


                                <!-- Title -->
                                <td class="px-4 py-3 font-medium text-gray-800">

                                    {{ $item['title'] ?? 'N/A' }}

                                </td>


                                <!-- Description -->
                                <td class="px-4 py-3 text-gray-600 max-w-xs">

                                    {{ $item['description'] ?? 'N/A' }}

                                </td>


                                


                                <!-- Thumbnail -->
                                <td class="px-4 py-3">

                                    @if(!empty($item['thumbnail']))

                                        <a href="{{ asset('uploads/whychoose/thumbnail/' . $item['thumbnail']) }}"
                                           target="_blank">

                                            <img src="{{ asset('uploads/whychoose/thumbnail/' . $item['thumbnail']) }}"
                                                 alt="thumbnail"
                                                 class="h-12 w-12 rounded-md object-cover border border-gray-200">

                                        </a>

                                    @else

                                        <span class="text-gray-400">
                                            No thumbnail
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-4 py-8 text-center text-gray-500">

                                    No multiple data found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    @empty

        <!-- No data -->

        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">

            <p class="text-gray-500 mb-4">
                No Management Consultancy data found.
            </p>

            <a href="{{ route('admin.manageconsul.create') }}"
               class="inline-block rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">

                + Add New

            </a>

        </div>

    @endforelse

</div>

@endsection
