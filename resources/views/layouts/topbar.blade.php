<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shadow-sm">
        <div class="flex items-center gap-4">
          <button class="text-slate-500 hover:text-slate-700 focus:outline-none lg:hidden">
            <i class="fas fa-bars text-xl"></i>
          </button>
          <h1 class="text-xl font-semibold text-slate-800">Dashboard</h1>
          <span class="hidden sm:inline-block text-xs bg-[#011810] text-white px-2.5 py-1 rounded-full font-medium">We Dot Group</span>
        </div>
        <div class="flex items-center gap-5">
          <!-- search (minimal) -->
          <div class="relative hidden md:block">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
            <input type="text" placeholder="Search..." class="pl-9 pr-4 py-2 w-56 bg-slate-100 border-0 rounded-full text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
          </div>
          <!-- notifications -->
          <button class="relative text-slate-500 hover:text-slate-700">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute -top-0.5 -right-0.5 h-2 w-2 bg-red-500 rounded-full ring-2 ring-white"></span>
          </button>
          <!-- avatar (mobile) -->
          <div class="h-8 w-8 rounded-full bg-[#011810] flex items-center justify-center text-white text-sm font-semibold shadow-sm">A</div>
        </div>
      </header>
