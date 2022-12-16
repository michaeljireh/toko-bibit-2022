<div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="z-50 fixed right-0 top-0 max-w-sm w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white dark:bg-gray-800 border-l-2 border-gray-300">
  <div class="flex items-center justify-between">
      <h3 class="text-2xl font-medium text-gray-700 dark:text-gray-200">Keranjang</h3>
      <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
          <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
  </div>
  <hr class="my-3">

  <div id="cart-list">
    @foreach (App\Models\Cart::where('user_id', Auth::id())->get() as $cart)
    @php
        $menu = App\Models\Menu::find($cart->menu_id);
    @endphp
      <div x-data="{
            qty:{{$cart->qty}},
            cartApi(method,url) {
                fetch(url,{method:method,headers:{Accept:'application/json'}}).then(async (result) => {
                    if (result.status == 200) return await result.json()
                }).then(async (result) => this.qty = result).catch((err) => console.log(err));
            }
        }" class="flex justify-between mt-6" x-show="qty > 0">
            <div class="flex">
                <img class="h-20 w-20 object-cover rounded" src="/storage/img/{{$menu->image}}" alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-gray-600 dark:text-gray-200">{{$menu->menu}}</h3>
                    <div class="flex items-center mt-2">
                        <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="cartApi('PUT','{{route('cart.more',$menu->id).'?api_token='.Auth::user()->api_token}}')">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                        <span class="text-gray-700 dark:text-gray-100 mx-2" x-text="qty"></span>
                        <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="cartApi('DELETE','{{route('cart.less',$menu->id).'?api_token='.Auth::user()->api_token}}')" >
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            <span class="text-gray-600 whitespace-nowrap" >Rp. {{$menu->harga}}</span>
      </div>
    @endforeach
  </div>

  <a href="{{route('home.checkout')}}" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500 cursor-pointer">
      <span>Checkout</span>
      <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
  </a>
</div>