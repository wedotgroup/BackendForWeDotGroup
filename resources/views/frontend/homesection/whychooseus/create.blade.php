@extends('layouts.master')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif
    <div class="bg-gray-50 min-h-screen py-10">

        <div class="max-w-6xl mx-auto px-4">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Why Choose Us</h1>

            <form action="{{ route('admin.hero.whychoose.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 items-start">


                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">


                        <div id="multiple-data-container" data-next-index="1"
                            class="space-y-4 max-h-[600px] overflow-y-auto pr-1">

                            <!-- Row 1 -->
                            <div class="multiple-data-row rounded-md border border-gray-200 bg-gray-50 p-4">


                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <!-- Text inputs (4) -->
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Icon</label>
                                        <textarea name="icons" placeholder="<svg ...>...</svg>" rows="3"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ old('icons') }}</textarea>
                                        <p class="text-sm text-gray-400">Only SVG icons are allowed</p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                        <input type="text" name="title" placeholder="Enter title" value="{{old("title")}}"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                        <textarea name="description" rows="2" placeholder="Enter description"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ old("description") }}</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Link Content</label>
                                        <input type="text" name="link_text" value="{{ old('link_text') }}" placeholder=""
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                                    </div>

                                    <!-- File inputs (2) -->
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Upload PDF</label>
                                        <input type="file" name="pdf_file" value="{{ old("pdf_file") }}" accept="image/*"
                                            class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Thumbnail</label>
                                        <input type="file" name="thumbnail" value="{{ old("thumbnail") }}"
                                            class="w-full text-xs rounded-md border border-gray-300 bg-white file:mr-3 file:rounded-l-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= BUTTONS ================= -->
                <div class="flex justify-end gap-3 mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <a href="{{ route('admin.hero.whychoose') }}"
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




    @endsection
