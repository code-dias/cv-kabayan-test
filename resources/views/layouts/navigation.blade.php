<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-decoration-none">
                        <div class="bg-emerald-700 p-1.5 rounded-lg shadow-sm">
                            <i class="bi bi-houses-fill text-white fs-4"></i>
                        </div>
                        <div class="hidden md:block">
                            <span class="fw-bold tracking-tighter text-emerald-900 fs-5 mb-0">CV KABAYAN</span>
                            <span class="block text-muted" style="font-size: 10px; margin-top: -5px; letter-spacing: 1px;">GROUP SYSTEM</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="fw-semibold text-emerald-800 focus:text-emerald-700 active:text-emerald-900 transition">
                        <i class="bi bi-speedometer2 me-2"></i> {{ __('Dashboard Admin') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-semibold rounded-pill text-emerald-800 bg-emerald-50 hover:bg-emerald-100 hover:text-emerald-900 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <i class="bi bi-person-circle me-2 fs-6"></i>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs text-muted mb-0">Role Akses</p>
                            <p class="text-sm fw-bold text-emerald-900 mb-0">Administrator</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-emerald-50 text-emerald-800">
                            <i class="bi bi-gear me-2"></i> {{ __('Pengaturan Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-danger hover:bg-red-50"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Keluar Sistem') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-emerald-800 fw-bold border-emerald-500 bg-emerald-50">
                <i class="bi bi-speedometer2 me-2"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center">
                <div class="shrink-0 me-3">
                    <i class="bi bi-person-circle fs-2 text-emerald-600"></i>
                </div>
                <div>
                    <div class="font-bold text-base text-emerald-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-emerald-800">
                    <i class="bi bi-gear me-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-danger fw-bold"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>