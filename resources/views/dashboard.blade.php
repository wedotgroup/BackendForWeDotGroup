@extends('layouts.master')

@section('content')

<section class="w-full px-3 py-5">

@php
    $cards = [
        [
            'title' => 'Total Users',
            'value' => $users ?? 0,
            'icon' => '👥',
            'iconBg' => 'bg-blue-100',
            'iconText' => 'text-blue-600',
        ],
        [
            'title' => 'Total Products',
            'value' => $products ?? 0,
            'icon' => '📦',
            'iconBg' => 'bg-purple-100',
            'iconText' => 'text-purple-600',
        ],
        [
            'title' => 'Total Orders',
            'value' => $orders ?? 0,
            'icon' => '🛒',
            'iconBg' => 'bg-orange-100',
            'iconText' => 'text-orange-600',
        ],
        [
            'title' => 'Revenue',
            'value' => $revenue ?? 0,
            'icon' => '💰',
            'iconBg' => 'bg-green-100',
            'iconText' => 'text-green-600',
        ],
    ];
@endphp

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

    @foreach ($cards as $card)

        <div
            class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
        >

            {{-- Top --}}
            <div class="flex items-start justify-between">

                {{-- Icon --}}
                <div
                    class="{{ $card['iconBg'] }} {{ $card['iconText'] }}
                    flex h-12 w-12 items-center justify-center
                    rounded-xl text-xl"
                >
                    {{ $card['icon'] }}
                </div>

                {{-- More --}}
                <button
                    type="button"
                    class="text-gray-400 transition hover:text-gray-700"
                >
                    ⋮
                </button>

            </div>


            {{-- Content --}}
            <div class="mt-5">

                <p class="text-sm font-medium text-gray-500">
                    {{ $card['title'] }}
                </p>

                <h2 class="mt-1 text-2xl font-bold text-gray-900">

                    @if ($card['title'] === 'Revenue')
                        ₹{{ number_format((float) $card['value'], 2) }}
                    @else
                        {{ number_format((int) $card['value']) }}
                    @endif

                </h2>

            </div>


            {{-- Bottom --}}
            <div class="mt-4 flex items-center gap-2">

                <span
                    class="inline-flex items-center rounded-full
                    bg-green-50 px-2 py-1 text-xs font-medium text-green-600"
                >
                    ↑ Active
                </span>

                <span class="text-xs text-gray-400">
                    Current
                </span>

            </div>

            {{-- Decorative background --}}
            <div
                class="pointer-events-none absolute -right-8 -bottom-8
                h-24 w-24 rounded-full bg-gray-50
                transition-all duration-300
                group-hover:scale-150"
            ></div>

        </div>

    @endforeach

</div>

</section>

@endsection
