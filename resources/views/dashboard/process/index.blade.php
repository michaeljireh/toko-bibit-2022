<x-app-layout>
    <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                    <span>{{ __($title) }}</span>
                    <x-nav-link class="ml-3 bg-blue-600 hover:bg-blue-500" :href="route('type.create')" :active="request()->routeIs('type.create')">
                        {{ __('Tambah Aneka Olahan') }}
                    </x-nav-link>   
                </div>

                <!-- Session Status -->
                <x-session-status class="mb-4 sm:px-6 lg:px-8 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-validation-errors class="mb-4 sm:px-6 lg:px-8 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

                <div class="mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between">

                    @foreach ($types as $type)
                        <div class="m-5">
                            <div
                                class="text-lg mb-5 leading-7 font-semibold text-gray-900 dark:text-white flex justify-between items-center">
                                <span>Aneka Olahan {{ $type->jenis }}</span>
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
                                        <x-dropdown-link :href="route('process.create', $type->id)">
                                            {{ __('Tambah') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('type.edit', $type->id)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('type.destroy', $type->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <x-dropdown-link :href="route('type.destroy', $type->id)"
                                                onclick="event.preventDefault();this.closest('form').submit();">
                                                {{ __('Hapus') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            <table class="shadow-xl">
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
                                            class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-100 dark:bg-gray-800">
                                    @foreach ($processes as $key => $process)
                                        @if ($process->no_jenis == $type->id)
                                            <tr class="hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer" x-data="{ open: false }" @click="open = false" @click.away="open = false" @close.stop="open = false">
                                                <td class="px-6 py-4 text-wrap">
                                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ ++$key }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-wrap">
                                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $process->nama }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-wrap">
                                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $process->desc }}</div>
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
                                                            <x-dropdown-link :href="route('process.edit', $process->id)">
                                                                {{ __('Edit') }}
                                                            </x-dropdown-link>
                                                            <form method="POST" action="{{ route('process.destroy', $process->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <x-dropdown-link :href="route('process.destroy', $process->id)"
                                                                    onclick="event.preventDefault();this.closest('form').submit();">
                                                                    {{ __('Hapus') }}
                                                                </x-dropdown-link>
                                                            </form>
                                                        </x-slot>
                                                    </x-dropdown>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>  
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
