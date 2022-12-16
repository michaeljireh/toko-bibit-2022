<x-guest-layout>
<div class="container mx-auto px-6">
    <div class="mt-4">
      <h3 class="text-gray-600 text-2xl font-medium">Jenis Bibit</h3>
        <div class="flex flex-wrap justify-around mt-8">
          @foreach ($menus as $menu)
          <div class="w-5/12 h-36 rounded-md overflow-hidden mb-8 flex relative">
            @if (Auth::check())
              <button @click="cartOpen = true; cartApi('POST','{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}')" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:bg-blue-500 cursor-pointer">
                <x-svg.cart-logo />
              </button>
            @else
              <a href="{{route('login')}}" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:bg-blue-500 cursor-pointer">
                <x-svg.cart-logo />
              </a>
            @endif

            <img class="w-2/6" src="/storage/img/{{$menu->image}}" alt="">
            <div class="bg-white dark:bg-gray-800 h-full w-full px-5 py-3">
              <div class="w-9/12 overflow-ellipsis overflow-hidden text-gray-700 dark:text-gray-200">
                <a href="{{route('home.menu',$menu->id)}}" class="text-xs text-gray-700 dark:text-gray-200">{{$menu->menu}}</a>
                <h2 class="font-semibold text-gray-800 dark:text-gray-100 mt-5">Rp. {{$menu->harga}}</h2>
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>

    @foreach ($types as $type)
    <div class="mt-16">
      <h3 class="text-gray-600 text-2xl font-medium">{{$type->jenis}}</h3>
      <div class="mt-6 overflow-x-scroll">
        <div class="flex flex-nowrap w-max overflow-x-scroll">

          @foreach ($processes as $process)
          @if ($process->no_jenis == $type->id)
            <x-item-list :process="$process" />
          @endif
          @endforeach

        </div>
      </div>
    </div>
    @endforeach
</div>
</x-guest-layout>