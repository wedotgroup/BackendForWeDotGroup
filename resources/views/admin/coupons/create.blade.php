@extends('layouts.master')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}")
            </script>
        @endforeach
    @endif
    <div class="max-w-6xl mx-auto mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200/60">
                    <i class="fas fa-ticket-alt text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Add New Coupon</h1>
                    <p class="text-gray-500 text-sm mt-0.5">Create a new discount coupon for your customers</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span
                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 border border-indigo-200">
                    <i class="fas fa-circle text-[6px] mr-1.5 text-indigo-500"></i> Draft
                </span>
            </div>
        </div>
    </div>

    <!-- Main form container -->
    <form class="max-w-6xl mx-auto space-y-6" action="{{ route('admin.cuopon.store') }}" method="POST">
        @csrf
        <!-- ========== CARD 1: Coupon Information ========== -->
        <div
            class="bg-white rounded-2xl shadow-sm shadow-gray-200/60 border border-gray-100 overflow-hidden transition-shadow duration-300 hover:shadow-md hover:shadow-gray-200/80">
            <!-- Card header -->
            <div
                class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50/80 to-white flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                    <i class="fas fa-tag text-indigo-600 text-sm"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-800">Coupon Information</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Basic details about the coupon</p>
                </div>
            </div>
            <!-- Card body -->
            <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 gap-y-5">

                <!-- Code -->
                <div class="md:col-span-1">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1.5">Coupon Code <span
                            class="text-rose-500">*</span></label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-hashtag text-sm"></i>
                        </span>
                        <input type="text" id="code" name="code" placeholder="e.g. SUMMER20"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5 ml-1">Unique code, uppercase recommended.</p>
                </div>

                <!-- Type -->
                <div class="md:col-span-1">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1.5">Discount Type <span
                            class="text-rose-500">*</span></label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-percent text-sm"></i>
                        </span>
                        <select id="type" name="type"
                            class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium text-gray-800 appearance-none cursor-pointer">
                            <option value="" disabled selected>— Select type —</option>
                            <option value="fixed">Fixed Amount (₹)</option>
                            <option value="percentage">Percentage (%)</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <!-- Value -->
                <div class="md:col-span-1">
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-1.5">Discount Value <span
                            class="text-rose-500">*</span></label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-calculator text-sm"></i>
                        </span>
                        <input type="number" id="value" name="value" step="0.01" min="0" placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                </div>

                <!-- Status -->
                <div class="md:col-span-1">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-toggle-on text-sm"></i>
                        </span>
                        <select name="status"
                            class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium text-gray-800 appearance-none cursor-pointer">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== CARD 2: Conditions & Limits ========== -->
        <div
            class="bg-white rounded-2xl shadow-sm shadow-gray-200/60 border border-gray-100 overflow-hidden transition-shadow duration-300 hover:shadow-md hover:shadow-gray-200/80">
            <div
                class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50/80 to-white flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                    <i class="fas fa-sliders-h text-amber-600 text-sm"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-800">Conditions & Limits</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Set usage rules and restrictions</p>
                </div>
            </div>
            <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 gap-y-5">

                <!-- Minimum Order Amount -->
                <div class="md:col-span-1">
                    <label for="minimum_order_amount" class="block text-sm font-medium text-gray-700 mb-1.5">Minimum Order
                        Amount (₹)</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-rupee-sign text-sm"></i>
                        </span>
                        <input type="number" id="minimum_order_amount" name="minimum_order_amount" step="0.01"
                            min="0" placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                </div>

                <!-- Maximum Discount -->
                <div class="md:col-span-1">
                    <label for="maximum_discount" class="block text-sm font-medium text-gray-700 mb-1.5">Maximum Discount
                        (₹)</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-arrow-up text-sm"></i>
                        </span>
                        <input type="number" id="maximum_discount" name="maximum_discount" step="0.01"
                            min="0" placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                </div>

                <!-- Usage Limit -->
                <div class="md:col-span-1">
                    <label for="usage_limit" class="block text-sm font-medium text-gray-700 mb-1.5">Usage Limit</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-users text-sm"></i>
                        </span>
                        <input type="number" id="usage_limit" name="usage_limit" min="1" step="1"
                            placeholder="e.g. 100"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5 ml-1">Leave empty for unlimited.</p>
                </div>

                <!-- Used Count (readonly) -->
                <div class="md:col-span-1">
                    <label for="used_count" class="block text-sm font-medium text-gray-700 mb-1.5">Used Count</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                            <i class="fas fa-check-circle text-sm"></i>
                        </span>
                        <input type="number" id="used_count" name="used_count" value="0" readonly
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-100/70 text-gray-500 cursor-not-allowed focus:outline-none text-sm font-medium">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5 ml-1">Auto-set to 0 for new coupons.</p>
                </div>
            </div>
        </div>

        <!-- ========== CARD 3: Validity Period ========== -->
        <div
            class="bg-white rounded-2xl shadow-sm shadow-gray-200/60 border border-gray-100 overflow-hidden transition-shadow duration-300 hover:shadow-md hover:shadow-gray-200/80">
            <div
                class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50/80 to-white flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center border border-emerald-100">
                    <i class="fas fa-calendar-alt text-emerald-600 text-sm"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-800">Validity Period</h2>
                    <p class="text-xs text-gray-400 mt-0.5">When the coupon is active</p>
                </div>
            </div>
            <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 gap-y-5">

                <!-- Start Date -->
                <div class="md:col-span-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">Start Date</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-play-circle text-sm"></i>
                        </span>
                        <input type="datetime-local" id="start_date" name="start_date"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                </div>

                <!-- Expiry Date -->
                <div class="md:col-span-1">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1.5">Expiry Date</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-stop-circle text-sm"></i>
                        </span>
                        <input type="datetime-local" id="expiry_date" name="expiry_date"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 text-gray-800 bg-gray-50/40 hover:bg-white focus:bg-white text-sm font-medium">
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== Message area ========== -->
        <div id="formMessage" class="hidden p-4 rounded-2xl text-sm font-medium border transition-all duration-300"></div>

        <!-- ========== Action bar (sticky-like card) ========== -->
        <div
            class="bg-white rounded-2xl shadow-sm shadow-gray-200/60 border border-gray-100 px-6 sm:px-8 py-5 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
            <button type="button" id="resetBtn"
                class="inline-flex justify-center items-center px-6 py-3 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500/30 transition-all duration-200 shadow-sm">
                <i class="fas fa-undo-alt mr-2 text-gray-400"></i> Reset Form
            </button>
            <button type="submit"
                class="inline-flex justify-center items-center px-8 py-3 border border-transparent rounded-xl shadow-md shadow-indigo-200/60 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                <i class="fas fa-save mr-2"></i> Save Coupon
            </button>
        </div>
    </form>


@endsection
