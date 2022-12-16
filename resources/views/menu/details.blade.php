<x-guest-layout>
<div class="container mx-auto px-6">
  <div class="md:flex md:items-center">
      <div class="w-full h-64 md:w-1/2 lg:h-96">
          <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="/storage/img/{{$menu->image}}" alt="Nike Air">
      </div>
      <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
          <h3 class="text-gray-700 uppercase text-lg dark:text-gray-200 mb-3">{{$menu->menu}}</h3>
          <span class="text-gray-500 mt-3">Rp. {{$menu->harga}}</span>
          <hr class="my-3">
          <div class="mt-2">
              <label class="text-gray-700 text-sm" for="count">Kuantitas :</label>
              <div class="flex items-center mt-1">
                  <button @click="qty++" class="text-gray-500 focus:outline-none focus:text-gray-600">
                      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </button>
                  <span class="text-gray-700 text-lg mx-2" x-text="qty"></span>
                  <button @click="qty = qty > 1 ? qty - 1 : 1" class="text-gray-500 focus:outline-none focus:text-gray-600">
                      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </button>
              </div>
          </div>
          <div class="flex items-center mt-6">
            @if (Auth::check())
              <a href="{{route('home.checkout')}}" @click="cartApi('POST',`{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}&qty=${qty}`)" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Sekarang</a>
              <button @click="cartOpen = true; cartApi('POST',`{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}&qty=${qty}`)" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                  <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              </button>
            @else
              <a href="{{route('login')}}" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Sekarang</a>
              <a href="{{route('login')}}" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                  <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              </a>
            @endif
          </div>
      </div>
  </div>

  <div class="mt-16">
    <h3 class="text-gray-600 text-2xl font-medium">Menu Lainnya</h3>
    <div class="mt-6 overflow-x-scroll">
      <div class="flex flex-nowrap w-max overflow-x-scroll">

        @foreach ($menus as $menu)
          <div class="bg-white dark:bg-gray-800 w-72 mx-5 rounded-md shadow-md overflow-hidden">
            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('/storage/img/{{$menu->image}}');">
              @if (Auth::check())
                <button @click="cartOpen = true; cartApi('POST','{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}')" class="mx-5 -mb-4 bg-blue-600 text-white hover:bg-blue-500 focus:bg-blue-500 p-2 rounded-full focus:outline-none">
                  <x-svg.cart-logo />
                </button> 
              @else
                <a href="{{route('login')}}" class="mx-5 -mb-4 bg-blue-600 text-white hover:bg-blue-500 focus:bg-blue-500 p-2 rounded-full focus:outline-none">
                  <x-svg.cart-logo />
                </a> 
              @endif 
            </div>
            <div class="px-5 py-3 h-32">
              <div class="overflow-ellipsis overflow-hidden h-24">
                <a href="{{route('home.menu',$menu->id)}}" class="text-gray-700 dark:text-gray-200 text-xs">{{$menu->menu}}</a>
                <p class="text-gray-500 mt-2">Rp. {{$menu->harga}}</p>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
</div>
</x-guest-layout>