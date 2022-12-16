<x-app-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
            <div class="flex justify-between">
                <div class="flex items-center">
                  <div class="text-2xl leading-7 font-semibold text-gray-900 dark:text-white">
                    <span>{{ __($title) }}</span>  
                  </div>
                </div>
                <div>
                    <x-nav-link :href="route('admin.report.print')" class="whitespace-nowrap bg-blue-600" target="_blank">
                        {{ __('Generate PDF') }}
                    </x-nav-link>
                </div>
              </div>

              <!-- Session Status -->
              <x-session-status class="mb-4 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

              <div class="mx-auto flex flex-wrap justify-between mt-8">

                <table x-data="{totalPendapatan : 0}" class="shadow-xl" id="datatable">
                    <thead class="dark:bg-gray-300 bg-gray-600">
                        <tr class="text-gray-100 dark:text-gray-500">
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                              No
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                              Nama Penerima
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                              No. Pesanan
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                              Orderan Terbuat
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                              Pembayaran
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold text-center">
                              Status Orderan
                          </th>
                          <th scope="col"
                              class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold text-center">
                              Total Harga
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
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->nama_penerima }}</div>
                                    </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->id }}</div>
                                    </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->created_at }}</div>
                                    </td>
                            <td class="px-6 py-4 text-wrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $order->type_pembayaran->nama_pembayaran }}</div>
                                    </td>
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">
                                        @foreach ($statuses as $stat)
                                        @if ($stat->inisial == $order->status->inisial)
                                        {{ $stat->nama_status }}
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-wrap">
                                  <div class="text-sm text-gray-900 dark:text-gray-300 text-right" x-data={} x-init="$nextTick(() => $parent.totalPendapatan = $parent.totalPendapatan + {{ $order->total }})">Rp. {{ $order->total }}</div>
                                </td>
                                </tr>
                            @endforeach
                    </tbody>
                    <tfoot class="dark:bg-gray-300 bg-gray-600">
                      <tr class="text-gray-100 dark:text-gray-500">
                        <th colspan="6" scope="col"
                            class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                            Total Pendapatan
                        </th>
                        <th class="px-6 py-4 text-wrap text-right text-sm" x-text="'Rp. ' + totalPendapatan">
                        </th>
                      </tr>
                    </tfoot>
                </table>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>
