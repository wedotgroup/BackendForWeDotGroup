<aside class="w-64 bg-[#011810] text-slate-200 flex flex-col shadow-xl">

    <div class="h-16 flex items-center justify-center border-b border-slate-700/70 px-4">
        <span class="text-2xl font-bold tracking-tight text-[#B89B3E]">
            We
            <span class="text-white">
                Dot <span>Group</span>
            </span>
        </span>
    </div>

    <nav class="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto">

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-slate-800 text-white font-medium">
            <i class="fas fa-tachometer-alt w-5 text-indigo-400"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.userlist') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

            <i class="fas fa-users w-5 text-orange-400"></i>
            <span>Users</span>

        </a>
        <div>

            <!-- Our Products -->
            <button type="button" onclick="toggleDropdown('productsDropdown', 'productsArrow')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <div class="flex items-center gap-3">
                    <i class="fas fa-boxes-stacked w-5 text-blue-400"></i>
                    <span>Our Products</span>
                </div>

                <i id="productsArrow" class="fas fa-chevron-down text-xs transition-transform duration-200">
                </i>

            </button>

            <!-- Dropdown -->
            <div id="productsDropdown" class="hidden ml-5 mt-1 space-y-1">

                <!-- Add Products -->
                <a href="{{ route('admin.product.list') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">

                    <i class="fas fa-plus-circle w-4 text-green-400"></i>
                    <span>Add Products</span>

                </a>
                <a href="{{ route('admin.cupons') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">

                    <i class="fas fa-gift w-4 text-red-400"></i>
                    <span>Coupons</span>

                </a>

                <!-- Orders -->
                <a href="{{ route('admin.orders') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">

                    <i class="fas fa-shopping-cart w-4 text-yellow-400"></i>
                    <span>Orders</span>

                </a>

                <!-- Payments -->
                <a href="{{ route('admin.payments') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition">

                    <i class="fas fa-credit-card w-4 text-purple-400"></i>
                    <span>Payments</span>

                </a>

            </div>

        </div>

        <div>

            <button type="button" onclick="toggleDropdown('homeDropdown', 'homeArrow')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <div class="flex items-center gap-3">
                    <i class="fas fa-home w-5 text-emerald-400"></i>
                    <span>Home Section</span>
                </div>

                <i id="homeArrow" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>

            </button>

            <div id="homeDropdown" class="hidden ml-5 mt-1 space-y-1">

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-image w-4"></i>
                    Hero Section
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-star w-4"></i>
                    Why Choose Us
                </a>


            </div>

        </div>


        <div>

            <button type="button" onclick="toggleDropdown('aboutDropdown', 'aboutArrow')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <div class="flex items-center gap-3">
                    <i class="fas fa-info-circle w-5 text-blue-400"></i>
                    <span>About Section</span>
                </div>

                <i id="aboutArrow" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>

            </button>

            <div id="aboutDropdown" class="hidden ml-5 mt-1 space-y-1">

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-building w-4"></i>
                    Company Info
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-bullseye w-4"></i>
                    Mission & Vision
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-user-tie w-4"></i>
                    CEO Message
                </a>

            </div>

        </div>


        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

            <i class="fas fa-handshake w-5 text-yellow-400"></i>
            <span>Partners Logos</span>

        </a>


        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

            <i class="fas fa-map-marker-alt w-5 text-red-400"></i>
            <span>Manage Location</span>

        </a>


        <div>

            <button type="button" onclick="toggleDropdown('itDropdown', 'itArrow')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <div class="flex items-center gap-3">
                    <i class="fas fa-laptop-code w-5 text-cyan-400"></i>
                    <span>IT Consultancy</span>
                </div>

                <i id="itArrow" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>

            </button>

            <div id="itDropdown" class="hidden ml-5 mt-1 space-y-1">

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-code w-4"></i>
                    Manage Categories
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-mobile-alt w-4"></i>
                    Manage Services
                </a>

            </div>

        </div>


        <div>

            <button type="button" onclick="toggleDropdown('managementDropdown', 'managementArrow')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <div class="flex items-center gap-3">
                    <i class="fas fa-briefcase w-5 text-purple-400"></i>
                    <span>Manage Consultancy</span>
                </div>

                <i id="managementArrow" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>

            </button>

            <div id="managementDropdown" class="hidden ml-5 mt-1 space-y-1">

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-chart-line w-4"></i>
                    Business Consulting
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-building w-4"></i>
                    Company Setup
                </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-project-diagram w-4"></i>
                    Business Strategy
                </a>

            </div>

        </div>



    </nav>

    <div class="border-t border-slate-700/70 p-4 flex items-center gap-3">

        <div
            class="h-9 w-9 rounded-full bg-indigo-500 flex items-center justify-center text-white font-semibold shadow">
            WD
        </div>

        <div class="flex-1 min-w-0">

            <p class="text-sm font-medium text-white truncate">
                Alex Rivera
            </p>

            <p class="text-xs text-slate-400 truncate">
                Super Admin
            </p>

        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>

</aside>
<script>
    function toggleDropdown(dropdownId, arrowId) {

        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById(arrowId);

        dropdown.classList.toggle('hidden');

        arrow.classList.toggle('rotate-180');
    }
</script>
