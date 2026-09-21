@extends('layouts.master')
@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}")
        </script>
    @endif
    <div class="max-w-7xl mx-auto mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200/60">
                    <i class="fas fa-ticket-alt text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Coupons</h1>
                    <p class="text-gray-500 text-sm mt-0.5">Manage all your discount coupons in one place</p>
                </div>
            </div>
            <div class="flex items-center gap-3">

                <a href="{{ route('admin.cuopon.create') }}"
                    class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 shadow-md shadow-indigo-200/60">
                    <i class="fas fa-plus mr-2"></i> Add Coupon
                </a>
            </div>
        </div>
    </div>

    <!-- Table card -->
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-sm shadow-gray-200/60 border border-gray-100 overflow-hidden">

        <!-- Toolbar -->
        <div
            class="px-6 sm:px-8 py-5 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Search (pure HTML, uses form GET to simulate search visually) -->
            <form method="GET" action="#" class="relative w-full lg:max-w-xs">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                    <i class="fas fa-search text-sm"></i>
                </span>
                <input type="text" name="q" placeholder="Search coupons..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-200 placeholder-gray-400 text-gray-800 bg-gray-50/50 hover:bg-white focus:bg-white text-sm">
            </form>


        </div>

        <!-- Table wrapper -->
        <div class="table-scroll overflow-x-auto">
            <table class="w-full text-sm min-w-[1100px]">
                <!-- Table head -->
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>

                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Code</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Value</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Min. Order</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Max Discount</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Usage</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Validity</th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Status</th>
                        <th
                            class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Actions</th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($cuopons as $coupon)
                        <tr class="hover:bg-indigo-50/30 group">

                            {{-- Code --}}
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-50 to-violet-50 border border-indigo-100 flex items-center justify-center">
                                        <i class="fas fa-tag text-indigo-500 text-xs"></i>
                                    </div>

                                    <span class="font-semibold text-gray-800 tracking-wide">
                                        {{ $coupon->code }}
                                    </span>
                                </div>
                            </td>

                            {{-- Value --}}
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="font-semibold text-gray-900">
                                    {{ number_format($coupon->value, 2) }}
                                    {{ $coupon->type === 'percentage' ? '%' : '₹' }}
                                </span>
                            </td>

                            {{-- Minimum Order --}}
                            <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                {{ $coupon->minimum_order_amount !== null ? '₹' . number_format($coupon->minimum_order_amount, 2) : '—' }}
                            </td>

                            {{-- Maximum Discount --}}
                            <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                {{ $coupon->maximum_discount !== null ? '₹' . number_format($coupon->maximum_discount, 2) : '—' }}
                            </td>

                            {{-- Usage --}}
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if ($coupon->usage_limit)
                                    @php
                                        $usagePercentage = min(100, ($coupon->used_count / $coupon->usage_limit) * 100);
                                    @endphp

                                    <div class="w-24">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span class="font-medium text-gray-700">
                                                {{ $coupon->used_count }}
                                            </span>
                                            <span>
                                                / {{ $coupon->usage_limit }}
                                            </span>
                                        </div>

                                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-indigo-500 rounded-full"
                                                style="width: {{ $usagePercentage }}%"></div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500">Unlimited</span>
                                @endif
                            </td>

                            {{-- Validity --}}
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-600">

                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-play-circle text-emerald-400 text-[10px]"></i>

                                        <span>
                                            {{ \Carbon\Carbon::parse($coupon->start_date)->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <i class="fas fa-stop-circle text-rose-400 text-[10px]"></i>

                                        <span>
                                            {{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d M Y') }}
                                        </span>
                                    </div>

                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4 whitespace-nowrap">

                                @if ($coupon->status === 'active')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-600 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div
                                    class="flex items-center justify-end gap-1 opacity-60 group-hover:opacity-100 transition-opacity">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.cuopon.edit', $coupon->id) }}"
                                        class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.cuopon.delete', $coupon->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="p-2 rounded-lg text-gray-400 hover:text-rose-600 hover:bg-rose-50 transition-colors"
                                            title="Delete">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">

                                    <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-ticket-alt text-gray-400 text-xl"></i>
                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-700">
                                        No coupons found
                                    </h3>

                                    <p class="text-sm text-gray-400 mt-1">
                                        Create your first coupon to get started.
                                    </p>

                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <div>
               {{ $cuopons->links() }}
            </div>
        </div>

        <!-- Footer / pagination (pure HTML, no JS) -->
        <div
            class="px-6 sm:px-8 py-5 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-sm text-gray-500">
                Showing <span class="font-semibold text-gray-700">1</span> to
                <span class="font-semibold text-gray-700">10</span> of
                <span class="font-semibold text-gray-700">20</span> coupons
            </div>
            <div class="flex items-center gap-1.5">
                <!-- Previous (disabled) -->
                <span
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium text-gray-300 cursor-not-allowed">
                    <i class="fas fa-chevron-left text-xs"></i>
                </span>

                <!-- Page 1 (active) -->
                <span
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                    1
                </span>

                <!-- Page 2 -->
                <a href="#"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    2
                </a>

                <!-- Next -->
                <a href="#"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>


@endsection
