<x-app-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="py-4">

        <div class="flex justify-between">
          <div class="flex items-center">
            <a href="{{route('order.index')}}" class="text-gray-700 dark:text-gray-300 mr-4 font-medium focus:outline-none bg-transparent">
              <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
            </a>
            <div class="text-2xl leading-7 font-semibold text-gray-900 dark:text-white">
              <span>{{ __($title) }}</span>  
            </div>
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
        
        <div class="mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between">
          
          <div class="flex flex-col lg:flex-row mt-8">
            
            <div class="mx-auto sm:px-6 lg:px-8 text-center">
              
              <div class="flex justify-center text-left max-w-4xl">
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

              @if ($bukti_pembayaran)
              <div class="my-8 dark:text-gray-300 text-lg font-bold">Bukti Pembayaran</div>

              <div class="flex justify-center mb-12">
                <img src="/storage/struct/{{$bukti_pembayaran}}" alt="" class="w-56 h-auto object-cover">
              </div>

              <div class="flex justify-center mb-12">
                <div class="pr-10">
                  <div class="flex justify-center mb-6">
                    <p class="dark:text-gray-300 whitespace-nowrap">Waktu Checkout <span class="font-bold">{{$created_at}}</span></p>
                  </div>
                  <form action="{{route('order.update', $id)}}" method="post">
                    @csrf
                  <div class="flex items-center w-full justify-around">
                    <p class="dark:text-gray-300 whitespace-nowrap">Status Orderan</p>
                      <select name="status" id="status" class="form-input block w-full text-gray-700 mx-12">
                        @foreach ($statuses as $stat)
                        <option value="{{$stat->inisial}}" {{ $stat->inisial == $status->inisial ? 'selected' : ''}}>{{$stat->nama_status}}</option>
                        @endforeach
                      </select>
                      <x-button :color="'bg-blue-600'">
                        {{ __('Set Status') }}
                      </x-button>
                    </div>
                  </div>
                </form>
              </div>
      
              @else
              <div class="my-8 dark:text-gray-300 text-sm font-bold">Bukti Pembayaran Belum Di Upload</span></div>
              @endif

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
