<nav x-data="{ open: false }" class=" bg-white dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div>
        <div class="flex flex-col justify-between h-screen p-2">
            <div class="flex flex-col">
                <!-- Logo -->
                <div class="">
                    <a href="{{ route('index') }}" class="flex items-center gap-2 text-white">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        EasyColoc
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex flex-col gap-2 mt-3">
                    <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if(request()->routeIs('admin'))
                    <x-nav-link>
                        {{ __('App') }}
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('app.colocations.index')" :active="request()->routeIs('app.colocations.index')">
                        {{ __('Colocations') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <a href="{{route('logout')}}" class="hidden sm:flex sm:items-center py-1 px-3 bg-gray-800/20 rounded-sm hover:bg-red-800/10 text-red-800">
                <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>Logout
            </a>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>