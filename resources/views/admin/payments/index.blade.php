@extends('layouts.master')
@section('content')
 
 <div class="w-full max-w-7xl bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-white flex flex-wrap items-center justify-between gap-3">
      <h1 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <span class="text-indigo-600">💳</span> Payments
      </h1>
      <div class="text-xs text-gray-400 font-mono">payments table · {{ $payments->total() ?? '' }} records</div>
    </div>

    <!-- Table wrapper -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100/80">
          <tr>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order Item</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Txn ID</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
            <th scope="col" class="px-4 py-3.5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
            <th scope="col" class="px-4 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-4 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Currency</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gateway</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gateway Txn</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Failure Reason</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Paid At</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Updated</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          @forelse ($payments as $payment)
            @php
              // Status badge classes
              $statusClasses = match ($payment->status ?? '') {
                  'paid'       => 'bg-green-100 text-green-800',
                  'pending'    => 'bg-yellow-100 text-yellow-800',
                  'processing' => 'bg-blue-100 text-blue-800',
                  'failed'     => 'bg-red-100 text-red-800',
                  'refunded'   => 'bg-purple-100 text-purple-800',
                  default      => 'bg-gray-100 text-gray-800',
              };

              // Currency symbol
              $currencySymbol = match ($payment->currency ?? 'INR') {
                  'INR' => '₹',
                  'AED' => 'AED ',
                  'USD' => '$',
                  'EUR' => '€',
                  'GBP' => '£',
                  default => ($payment->currency ?? '') . ' ',
              };
            @endphp

            <tr class="hover:bg-gray-50 transition-colors duration-150">
              <!-- ID -->
              <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                #{{ $payment->id }}
              </td>

              <!-- Order Item ID -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                @if($payment->orderitem_id)
                  <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                    #{{ $payment->orderitem_id }}
                  </span>
                @else
                  <span class="text-gray-400 text-xs italic">—</span>
                @endif
              </td>

              <!-- Transaction ID -->
              <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-gray-600">
                {{ $payment->transaction_id ?? '—' }}
              </td>

              <!-- Payment Method -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                @if($payment->payment_method)
                  <span class="inline-flex items-center gap-1">
                    @if(str_contains(strtolower($payment->payment_method), 'card'))
                      💳
                    @elseif(str_contains(strtolower($payment->payment_method), 'upi'))
                      📱
                    @elseif(str_contains(strtolower($payment->payment_method), 'net'))
                      🏦
                    @elseif(str_contains(strtolower($payment->payment_method), 'wallet'))
                      👛
                    @else
                      💰
                    @endif
                    {{ ucfirst($payment->payment_method) }}
                  </span>
                @else
                  <span class="text-gray-400 text-xs italic">—</span>
                @endif
              </td>

              <!-- Amount -->
              <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-right">
                {{ $currencySymbol }}{{ number_format($payment->amount ?? 0, 2) }}
              </td>

              <!-- Status Badge -->
              <td class="px-4 py-4 whitespace-nowrap text-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses }}">
                  {{ ucfirst($payment->status ?? 'unknown') }}
                </span>
              </td>

              <!-- Currency -->
              <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                {{ $payment->currency ?? '—' }}
              </td>

              <!-- Gateway -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                {{ $payment->gateway ?? '—' }}
              </td>

              <!-- Gateway Payment ID -->
              <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-gray-600">
                {{ $payment->gateway_payment_id ?? '—' }}
              </td>

              <!-- Failure Reason -->
              <td class="px-4 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $payment->failure_reason }}">
                @if($payment->failure_reason)
                  <span class="text-red-600">{{ Str::limit($payment->failure_reason, 40) }}</span>
                @else
                  <span class="text-gray-400 text-xs italic">—</span>
                @endif
              </td>

              <!-- Paid At -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                @if($payment->paid_at)
                  {{ \Carbon\Carbon::parse($payment->paid_at)->format('d M Y, H:i') }}
                @else
                  <span class="text-gray-400 text-xs italic">—</span>
                @endif
              </td>

              <!-- Created At -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ $payment->created_at ? \Carbon\Carbon::parse($payment->created_at)->format('d M Y, H:i') : '—' }}
              </td>

              <!-- Updated At -->
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ $payment->updated_at ? \Carbon\Carbon::parse($payment->updated_at)->format('d M Y, H:i') : '—' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="13" class="px-6 py-12 text-center text-sm text-gray-500">
                No payment records found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer: pagination -->
    @if(isset($payments) && method_exists($payments, 'links'))
      <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-sm text-gray-600">
        <div>
          Showing <span class="font-medium">{{ $payments->firstItem() ?? 0 }}</span>
          to <span class="font-medium">{{ $payments->lastItem() ?? 0 }}</span>
          of <span class="font-medium">{{ $payments->total() ?? 0 }}</span> payments
        </div>
        <div>
          {{ $payments->links() }}
        </div>
      </div>
    @endif
  </div>

@endsection