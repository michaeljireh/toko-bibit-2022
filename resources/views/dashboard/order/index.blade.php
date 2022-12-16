<x-app-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
              <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                  <span>{{ __($title) }}</span>  
              </div>

              <!-- Session Status -->
              <x-session-status class="mb-4 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

              <div class="mx-auto flex flex-wrap justify-between">

                <table class="shadow-xl" id="datatable">
                    <thead class="dark:bg-gray-300 bg-gray-600">
                        <tr class="text-gray-100 dark:text-gray-500">
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                            No
                        </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                USER ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                Nama Penerima
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                No Telp Penerima
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                Waktu Peletakan Pesanan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                Bukti Pembayaran
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100 dark:bg-gray-800">
                        @foreach ($orders as $key => $order)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 text-wrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ ++$key }}</div>
                        </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->user_id }}</div>
                                    </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->nama_penerima }}</div>
                                    </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->telp_penerima }}</div>
                                    </td>
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->waktu_kirim }}</div>
                                </td>
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->bukti_pembayaran ? 'Menunggu Konfirmasi' : 'Menunggu Pembayaran' }}</div>
                                </td>
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">
                                        @foreach ($statuses as $stat)
                                        @if ($stat->inisial == $order->status)
                                        {{ $stat->nama_status }}
                                        @endif
                                        @endforeach
                                    </div>
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
                                                <x-dropdown-link :href="route('order.detail', $order->id)">
                                                    {{ __('Details') }}
                                                </x-dropdown-link>
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
