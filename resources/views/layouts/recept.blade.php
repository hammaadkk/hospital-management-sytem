<!-- Receptionist Navigation Menu -->
<nav x-data="{ open: false }" class="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Add any receptionist-specific navigation items here -->
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Receptionist Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::guard('receptionist')->user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Receptionist Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Receptionist') }}
                                </div>

                                <!-- Receptionist Settings -->
                                <x-dropdown-link href="{{ route('receptionist.settings') }}">
                                    {{ __('Receptionist Settings') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Receptionist Logout -->
                                <form method="POST" action="{{ route('receptionist.logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('receptionist.logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Add any receptionist-specific navigation items here -->
        </div>

        <!-- Receptionist Dropdown -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ Auth::guard('receptionist')->user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::guard('receptionist')->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Receptionist Management -->
                <x-responsive-nav-link href="{{ route('receptionist.settings') }}">
                    {{ __('Receptionist Settings') }}
                </x-responsive-nav-link>

                <!-- Receptionist Logout -->
                <form method="POST" action="{{ route('receptionist.logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('receptionist.logout') }}"
                                     @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
