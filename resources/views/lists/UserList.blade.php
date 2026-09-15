@extends('layouts.master')

@section('content')
    <div class="w-full max-w-6xl bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/40 overflow-hidden">

        <!-- Header with title and live search -->
        <div class="px-6 py-5 border-b border-gray-200/70 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-indigo-100 p-2 rounded-xl">
                    <i class="fa-solid fa-users text-indigo-600 text-xl"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">User Directory</h1>
                <span id="userCount" class="bg-gray-100 text-gray-600 text-sm font-medium px-2.5 py-1 rounded-full">
                    {{ $users->count() }} users
                </span>
            </div>

            <!-- Search input (searches name, email, phone, role) -->
            <div class="relative w-full sm:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" id="searchInput" placeholder="Search name, email, phone, role..."
                    class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 transition">
            </div>
        </div>

        <!-- Table container with horizontal scroll on small screens -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50/80 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">Name</th>
                        <th scope="col" class="px-6 py-3 text-left">Email</th>
                        <th scope="col" class="px-6 py-3 text-left">Phone</th>
                        <th scope="col" class="px-6 py-3 text-left">Role</th>
                    </tr>
                </thead>
                <tbody id="userTableBody" class="divide-y divide-gray-100 bg-white/60">
                    @forelse ($users as $user)
                        @php
                            // Role badge styling
                            $roleBadge = match($user->role ?? 'Viewer') {
                                'Admin'  => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                'user' => 'bg-sky-50 text-sky-700 border-sky-200',
                                default  => 'bg-gray-50 text-gray-600 border-gray-200',
                            };

                            // Avatar color rotation based on user id
                            $avatarColors = ['bg-indigo-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-sky-500', 'bg-purple-500', 'bg-teal-500', 'bg-pink-500', 'bg-orange-500', 'bg-cyan-500'];
                            $avatarBg = $avatarColors[$user->id % count($avatarColors)];

                            // Initials from name
                            $initials = collect(explode(' ', $user->name))
                                        ->map(fn($part) => strtoupper(substr($part, 0, 1)))
                                        ->take(2)
                                        ->implode('');
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                            <!-- Name with avatar -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full {{ $avatarBg }} text-white flex items-center justify-center text-sm font-semibold shadow-sm flex-shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <!-- Email -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <!-- Phone -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->phone ?? '—' }}</td>
                            <!-- Role -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full border {{ $roleBadge }}">
                                    {{ $user->role ?? 'Viewer' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                                <i class="fa-regular fa-face-frown text-4xl mb-3 block"></i>
                                <p class="text-sm font-medium">No users found</p>
                                <p class="text-xs mt-1">Add users to see them listed here</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer with counts -->
        <div class="px-6 py-3 bg-gray-50/60 border-t border-gray-200/70 text-xs text-gray-400 flex justify-between items-center">
            <span>Showing <span id="visibleCount">{{ $users->count() }}</span> of <span id="totalCount">{{ $users->count() }}</span> users</span>
            <span class="flex items-center gap-1">
                <i class="fa-regular fa-circle-check text-emerald-500"></i> Live demo
            </span>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function() {
        const searchInput     = document.getElementById('searchInput');
        const tableBody       = document.getElementById('userTableBody');
        const visibleCountEl  = document.getElementById('visibleCount');
        const totalCountEl    = document.getElementById('totalCount');
        const userCountEl     = document.getElementById('userCount');

        // Store original rows on load so we can restore them when search is cleared
        const originalRows    = Array.from(tableBody.querySelectorAll('tr'));
        const totalUsers      = originalRows.length;

        // Update total count on load
        totalCountEl.textContent = totalUsers;

        // Live search
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            let visible = 0;

            originalRows.forEach(row => {
                // Skip the empty-state row if present
                if (row.querySelector('td[colspan]')) return;

                const text = row.textContent.toLowerCase();
                const match = term === '' || text.includes(term);

                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            // Update counters
            visibleCountEl.textContent = visible;
            userCountEl.textContent = `${visible} user${visible !== 1 ? 's' : ''}`;

            // Show "no results" row if nothing matches
            let noResultRow = tableBody.querySelector('.no-result-row');
            if (visible === 0 && term !== '') {
                if (!noResultRow) {
                    noResultRow = document.createElement('tr');
                    noResultRow.className = 'no-result-row';
                    noResultRow.innerHTML = `
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                            <i class="fa-regular fa-face-frown text-4xl mb-3 block"></i>
                            <p class="text-sm font-medium">No users match your search</p>
                            <p class="text-xs mt-1">Try a different name, email, phone, or role</p>
                        </td>`;
                    tableBody.appendChild(noResultRow);
                }
                noResultRow.style.display = '';
            } else if (noResultRow) {
                noResultRow.style.display = 'none';
            }
        });
    })();
</script>
@endpush
