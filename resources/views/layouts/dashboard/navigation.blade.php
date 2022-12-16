<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <a href="{{route('home')}}" class="w-full text-gray-700 dark:text-white md:text-center text-sm font-semibold cursor-pointer flex items-center">
            <x-svg.application-logo class="block h-10 w-auto fill-current text-gray-600 text-wrap" />
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <div>

        <div class="pt-4 pb-3">
            <!-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="whitespace-nowrap">
                {{ __('Home') }}
            </x-responsive-nav-link> -->
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')" class="whitespace-nowrap">
                {{ __('Daftar Menu') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('process.index')" :active="request()->routeIs('process.index')" class="whitespace-nowrap">
                {{ __('Daftar Olahan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')" class="whitespace-nowrap">
                {{ __('Daftar Orderan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('admin.report')" :active="request()->routeIs('admin.report')" class="whitespace-nowrap">
                {{ __('Laporan Keuangan') }}
            </x-responsive-nav-link>
        </div>

    </div>
</nav>
