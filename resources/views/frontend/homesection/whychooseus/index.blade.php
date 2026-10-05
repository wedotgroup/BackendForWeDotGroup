@extends('layouts.master')

@section('content')
    {{-- Toastr Messages --}}
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

    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Why Choose Us List
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage all Why Choose Us entries
                    </p>
                </div>

                <a href="{{ route('admin.hero.whychoose.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5
                           text-sm font-semibold text-white shadow-sm transition
                           hover:bg-blue-700 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:ring-offset-2">

                    <span class="text-lg leading-none">+</span>
                    Add New
                </a>

            </div>


            {{-- Table Card --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-gray-200 px-5 py-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h2 class="text-base font-semibold text-gray-800">
                                Why Choose Us
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                List of all available entries
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Responsive Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px] text-left text-sm">

                        {{-- Table Head --}}
                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-16">
                                    #
                                </th>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Icon
                                </th>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Title
                                </th>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Description
                                </th>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    PDF / Image
                                </th>

                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Thumbnail
                                </th>

                                <th
                                    class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        {{-- Table Body --}}
                        <tbody class="divide-y divide-gray-100">


                            @foreach ($whyChooses as $item)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                                            <div class="h-6 w-6">
                                                {!! $item->icons ?? '' !!}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-gray-800">
                                            {{ $item->title }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="max-w-xs truncate text-gray-500">
                                            {{ $item->description }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($item->pdf_file)
                                            <a href="{{ asset($item->pdf_file) }}" target="_blank"
                                                class="text-blue-600 underline">
                                                Open PDF
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">
                                                No file
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($item->thumbnail)
                                            <img src="{{ asset($item->thumbnail) }}"
                                                class="h-12 w-12 rounded-lg object-cover border border-gray-200">
                                        @else
                                            <span class="text-xs text-gray-400">
                                                No thumbnail
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-2">

                                            <a href="{{ route('admin.hero.whychoose.edit', $item->id) }}"
                                                class="rounded-md bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-600 hover:bg-blue-100">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('admin.hero.whychoose.destroy', $item->id) }}"method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are your sure delete this data')"
                                                    class="rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-100">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>

                    </table>

                </div>



            </div>

        </div>
    </div>
@endsection
