<x-app-layout>
    <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                    <span>{{ __($title) }}</span>
                    <x-nav-link class="ml-3 bg-blue-600 hover:bg-blue-500" :href="route('menu.create')" :active="request()->routeIs('menu.create')">
                        {{ __('Tambah Menu') }}
                    </x-nav-link>   
                </div>

                <!-- Session Status -->
                <x-session-status class="mb-4 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-validation-errors class="mb-4 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

                <div class="mx-auto flex flex-wrap justify-between">

                    <table class="shadow-xl" id="datatable">
                        <thead class="dark:bg-gray-300 bg-gray-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Nama Menu
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Deskripsi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Harga
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 dark:bg-gray-800">
                            @foreach ($menus as $key => $menu)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ ++$key }}</div>
                                </td>
                                <td class="px-6 py-4 text-wrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $menu->menu }}</div>
                                        </td>
                                <td class="px-6 py-4 text-wrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $menu->desc }}</div>
                                        </td>
                                <td class="px-6 py-4 text-wrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $menu->harga }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-wrap">
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <button
                                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                                </svg>
                                                        </div>
                                                    </button>
                                                </x-slot>
                                    
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('menu.edit', $menu->id)">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                    <form method="POST" action="{{ route('menu.destroy', $menu->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <x-dropdown-link :href="route('menu.destroy', $menu->id)"
                                                            onclick="event.preventDefault();this.closest('form').submit();">
                                                            {{ __('Hapus') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
