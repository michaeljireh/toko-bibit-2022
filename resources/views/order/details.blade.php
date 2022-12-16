<x-guest-layout>
  <div class="container mx-auto p-8 bg-white dark:bg-gray-800 shadow-lg">

    <div class="flex justify-between">
      <div class="flex items-center">
        <a href="{{route('home.order')}}" class="text-gray-700 dark:text-gray-300 mr-4 font-medium focus:outline-none bg-transparent">
          <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
        </a>
        <h3 class="text-gray-700 dark:text-gray-300 text-2xl font-medium">Orderan</h3>
      </div>
      <div>
        <p class="text-gray-700 dark:text-gray-300">{{$created_at}}</p>
        <p class="text-gray-700 dark:text-gray-300">{{$status->nama_status}}</p>
      </div>
    </div>

    <!-- Session Status -->
    <x-session-status class="mb-4 sm:px-6 lg:px-8 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

    <!-- Validation Errors -->
    <x-validation-errors class="mb-4 sm:px-6 lg:px-8 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

    <div class="flex flex-col lg:flex-row mt-8">

      <div class="mx-auto sm:px-6 lg:px-8 container text-center">

        <div class="flex justify-center text-left">
          <div class="pr-10">
            <div class="flex mb-6">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">No. Pesanan</p>
              <p class="w-full dark:text-gray-300 font-bold col-span-3">{{$id}}</p>
            </div>
            <div class="flex mb-2">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">Nama Penerima</p>
              <p class="w-full dark:text-gray-300 col-span-3">{{$nama_penerima}}</p>
            </div>
            <div class="flex mb-2">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">No Telp</p>
              <p class="w-full dark:text-gray-300 col-span-3">{{$telp_penerima}}</p>
            </div>
            <div class="flex mb-6">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">Alamat</p>
              <p class="w-full dark:text-gray-300 col-span-3">{{$alamat_penerima}}</p>
            </div>
            <div class="flex mb-2">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">Pembayaran Via</p>
              <p class="w-full dark:text-gray-300 col-span-3">{{$type_pembayaran->nama_pembayaran}}</p>
            </div>
            <div class="flex mb-6">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">Pengiriman Via</p>
              <p class="w-full dark:text-gray-300 col-span-3">{{$type_pengiriman->nama_pengiriman}}</p>
            </div>
            <div class="flex mb-12">
              <p class="w-56 dark:text-gray-300 whitespace-nowrap">Total Pembayaran</p>
              <p class="w-full dark:text-gray-300 col-span-3 font-bold">Rp. {{$total}}</p>
            </div>
            @if ($status->inisial == 'unpaid')
            <div class="flex mb-2">
              <div x-data="{ open: false }" @body-scroll="document.body.style.overflowY = open ? 'hidden' : ''">
                <div class="flex justify-center items-center relative">
                  <button @click="open = !open; $dispatch('body-scroll', {})" class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Batalkan Pesanan</span>
                  </button>
                </div>
                <div x-show="open" x-cloak="" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-75" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                  <div @click.away="open = false; $dispatch('body-scroll', {})" class="flex flex-col p-8 bg-white dark:bg-gray-800 shadow-md hover:shodow-lg rounded-2xl relative">
                    <button class="absolute right-0 top-0 px-3 py-1 dark:text-gray-100 text-xl" @click="open = false; $dispatch('body-scroll', {})">x</button>
                    <div class="flex items-center justify-between">
                      <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                          class="w-16 h-16 rounded-2xl p-3 border border-blue-100 dark:border-gray-800 text-blue-400 bg-blue-50 dark:bg-gray-900" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex flex-col ml-3">
                          <div class="font-medium leading-none dark:text-gray-100 mb-3">Batalkan Pesanan ?</div>
                          <p class="text-sm text-gray-600 dark:text-gray-500 leading-none mt-1 mb-6">Apabila Pesanan Di Batalkan Pembayaran Anda Sebelumnya Akan Di Kembali Dalam 2 Hari Kerja.</p>
                          <form action="{{route('home.order.destroy', $id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="flex-no-shrink bg-red-500 px-5 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 text-white rounded-full">Batalkan Pesanan</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>

          <div x-data="{swiper: null}" x-init="swiper = new Swiper($refs.container, {
              loop: false,
              slidesPerView: 1,
              spaceBetween: 0,
              breakpoints: {
                640: {
                  slidesPerView: 1,
                  spaceBetween: 0,
                },
                768: {
                  slidesPerView: 1,
                  spaceBetween: 0,
                },
                1024: {
                  slidesPerView: 1,
                  spaceBetween: 0,
                },
              },
            })" class="relative w-2/6 flex flex-row" >

            <div class="absolute inset-y-0 left-3 z-10 flex items-center">
              <button @click="swiper.slidePrev()" 
                      class="bg-white -ml-2 lg:-ml-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-left w-6 h-6"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
              </button>
            </div>

            <div class="swiper-container" x-ref="container">
              <div class="swiper-wrapper">
                
                @foreach ($lists as $list)
                <div class="swiper-slide p-4">
                  <div class="flex flex-col rounded shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                      <img class="h-48 w-full object-cover" src="/storage/img/{{$list->menu->image}}" alt="">
                      <div class="p-4">
                        <p class="font-semibold mb-4 text-gray-700 dark:text-gray-200">{{$list->menu->menu}}</p>
                        <p class="text-gray-500">Rp. {{$list->menu->harga}}</p>
                        <p class="text-gray-500">Qty. {{$list->qty}}</p>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                
              </div>
            </div>

            <div class="absolute inset-y-0 right-3 z-10 flex items-center">
              <button @click="swiper.slideNext()" 
                      class="bg-white -mr-2 lg:-mr-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-right w-6 h-6"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              </button>
            </div>

          </div>
        </div>

        @if ($type_pembayaran->inisial != 'COD' && !$bukti_pembayaran)
        <div class="my-8 dark:text-gray-300 text-sm">Silahkan Lakukan Pembayaran Sebelum <span class="font-bold">{{$kadaluarsa}}</span></div>

        <form action="{{route('home.checkout.put', $id)}}" method="post" enctype="multipart/form-data">
          @method('PATCH')
          @csrf

          <div class="w-full">
              <x-forms.upload-image class="" :identifier="'imageBukti'" />   
          </div>

          <div class="flex justify-center my-12">
            <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
              <span class="mx-2">Upload Bukti Pembayaran</span>
            </button>
          </div>
        </form>

        @else
        <div class="my-8 dark:text-gray-300 text-sm">Apabila Sudah Mengupload Bukti Pembayaran, Bukti Pembayaran akan kami cek dalam 10 menit setelah upload Bukti Pembayaran berhasil</span></div>
        @endif

      </div>

    </div>

</div>
</x-guest-layout>