<x-guest-layout>
  <div class="container mx-auto p-8 bg-white dark:bg-gray-800 shadow-lg">
    <h3 class="text-gray-700 dark:text-gray-300 text-2xl font-medium">Orderan</h3>
    <div class="flex flex-col lg:flex-row mt-8">
      <div class="mx-auto sm:px-6 lg:px-8 container">
        
        <!-- Session Status -->
        <x-session-status class="mb-4 sm:px-6 lg:px-8 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4 sm:px-6 lg:px-8 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

        <ul class="p-4 dark:bg-gray-800 dark:text-gray-100 w-full">
          @foreach ($orders as $order)
          <li class="w-full mb-8">
            <article class="w-full">
              <a href="{{route('home.order.detail', $order->id)}}" class="p-4 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 flex justify-between w-full">
                <div class="flex">
                  <div>
                    <p class="mb-1 dark:text-gray-400">{{$order->created_at}}</p>
                  </div>
                  <div>
                    <p class="mb-1 ml-8 font-semibold">No. Pesanan</p>
                    <p class="ml-8 mt-8 dark:text-gray-300">Nama Penerima</p>
                    <p class="ml-8 dark:text-gray-300">No Telp</p>
                    <p class="ml-8 dark:text-gray-300">Alamat</p>
                    <p class="ml-8 mt-8 dark:text-gray-300 text-sm">Kadaluarsa</p>
                  </div>
                  <div>
                    <p class="mb-1 ml-8 font-semibold">{{$order->id}}</p>
                    <p class="ml-8 mt-8 dark:text-gray-300">{{$order->nama_penerima}}</p>
                    <p class="ml-8 dark:text-gray-300">{{$order->telp_penerima}}</p>
                    <p class="ml-8 dark:text-gray-300">{{$order->alamat_penerima}}</p>
                    <p class="ml-8 mt-8 dark:text-gray-300 text-sm">{{$order->kadaluarsa}}</p>
                  </div>
                </div>
                <div>
                  <p class="ml-8 dark:text-gray-300 font-semibold">{{$order->status->nama_status}}</p>
                </div>
              </a>
            </article>
          </li>
          @endforeach
        </ul>

      </div>
    </div>

</div>
</x-guest-layout>