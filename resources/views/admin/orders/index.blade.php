@extends('layouts.master')
@section('content')

  <div class="w-full max-w-7xl bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-white flex flex-wrap items-center justify-between gap-3">
      <h1 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <span class="text-indigo-600">🛒</span> Orders
      </h1>
      <div class="text-xs text-gray-400 font-mono">AED · paginated · 30 per page</div>
    </div>

    <!-- Table wrapper -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100/80">
          <tr>
            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order #</th>
            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
            <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Price (AED)</th>
            <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Qty</th>
            <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Coupon</th>
            <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Total (AED)</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          @forelse ($orders as $order)
            @php

              $couponCode    = $order->coupon_code ?? null;
              $discountRate  = match ($couponCode) {
                  'SAVE10'    => 0.10,
                  'WELCOME5'  => 0.05,
                  'FREESHIP'  => 0.00,
                  'SUMMER15'  => 0.15,
                  default     => 0,
              };
              $lineTotalBefore = ($order->price ?? 0) * ($order->quantity ?? 0);
              $lineTotal       = $lineTotalBefore * (1 - $discountRate);


              $statusClasses = match ($order->status ?? '') {
                  'Delivered'  => 'bg-green-100 text-green-800',
                  'Shipped'    => 'bg-blue-100 text-blue-800',
                  'Processing' => 'bg-yellow-100 text-yellow-800',
                  'Cancelled'  => 'bg-red-100 text-red-800',
                  default      => 'bg-gray-100 text-gray-800',
              };
            @endphp

            <tr class="hover:bg-gray-50 transition-colors duration-150">
            
              <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                #{{ $order->id }}
              </td>

              <!-- Customer name + email -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ $order->customer_name ?? '—' }}
                </div>
                <div class="text-xs text-gray-500">
                  {{ $order->customer_email ?? '' }}
                </div>
              </td>

              <!-- Product name + category -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ $order->product_name ?? '—' }}
                </div>
                <div class="text-xs text-gray-500">
                  {{ $order->product_category ?? '' }}
                </div>
              </td>

              <!-- Price in AED -->
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-right">
                {{ number_format($order->price ?? 0, 2) }} AED
              </td>

              <!-- Quantity -->
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                {{ $order->quantity ?? 0 }}
              </td>

              <!-- Coupon code -->
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($couponCode)
                  <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                    {{ $couponCode }}
                  </span>
                @else
                  <span class="text-gray-400 text-xs italic">—</span>
                @endif
              </td>

              <!-- Status badge -->
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses }}">
                  {{ $order->status ?? 'Unknown' }}
                </span>
              </td>

              <!-- Line total in AED -->
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-right">
                {{ number_format($lineTotal, 2) }} AED
                @if ($discountRate > 0)
                  <span class="block text-xs text-green-600 font-normal">
                    -{{ round($discountRate * 100) }}%
                  </span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="px-6 py-12 text-center text-sm text-gray-500">
                No orders found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer: summary + pagination -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-sm text-gray-600">
      <div>
        Showing <span class="font-medium">{{ $orders->firstItem() }}</span>
        to <span class="font-medium">{{ $orders->lastItem() }}</span>
        of <span class="font-medium">{{ $orders->total() }}</span> orders
      </div>

      <!-- Laravel pagination links (Tailwind styled) -->
      <div>
        {{ $orders->links() }}
      </div>
    </div>
  </div>


@endsection


