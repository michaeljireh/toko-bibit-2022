<x-guest-layout>
  <div class="container mx-auto p-8 bg-white dark:bg-gray-800 shadow-lg">
    <h3 class="text-gray-700 dark:text-gray-300 text-2xl font-medium">Checkout</h3>
    <div class="flex flex-col lg:flex-row mt-8">
        <div class="w-full lg:w-1/2 order-2">
            <!-- Session Status -->
            <x-session-status class="mb-4 sm:px-6 lg:px-8 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4 sm:px-6 lg:px-8 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

            <form class="mt-8 lg:w-3/4" method="POST" action="{{route('home.checkout.post')}}">
                @csrf
                <div class="flex justify-between">
                    <div class="w-5/12">
                        <h4 class="text-sm text-gray-500 font-medium">Nama Penerima</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <input type="text" name="fullname" id="fullname" class="form-input mt-1 block w-full text-gray-700" placeholder="Nama Lengkap">
                            </label>
                        </div>
                    </div>
                    <div class="w-5/12">
                        <h4 class="text-sm text-gray-500 font-medium">Nomor Telpon</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <input type="number" name="telp" id="telp" class="form-input mt-1 block w-full text-gray-700" placeholder="No. Telp">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h4 class="text-sm text-gray-500 font-medium">Alamat Pengiriman</h4>
                    <div class="mt-6 flex">
                        <label class="block flex-1">
                            <textarea type="text" name="address" id="address" class="form-input mt-1 block w-full text-gray-700" placeholder="Alamat Terima"></textarea>
                        </label>
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <div class="w-5/12">
                        <h4 class="text-sm text-gray-500 font-medium">Type Pembayaran</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <select name="type_pembayaran" id="type_pembayaran" class="form-input mt-1 block w-full text-gray-700">
                                    @foreach ($payments as $payment)
                                    <option value="{{$payment->inisial}}">{{$payment->nama_pembayaran}}</option>
                                    @endforeach
                                  </select>
                            </label>
                        </div>
                    </div>
                    <div class="w-5/12">
                        <h4 class="text-sm text-gray-500 font-medium">Type Pengiriman</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <select name="type_pengiriman" id="type_pengiriman" class="form-input mt-1 block w-full text-gray-700">
                                    @foreach ($deliveries as $delivery)
                                    <option value="{{$delivery->inisial}}">{{$delivery->nama_pengiriman}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h4 class="text-sm text-gray-500 font-medium">Waktu Peletakan Pesanan</h4>
                    <div class="flex justify-between">
                        <div class="w-3/12">
                            <div class="mt-6 flex">
                                <label class="block flex-1">
                                    <input type="time" name="time" id="time" class="form-input mt-1 block w-full text-gray-700" placeholder="time">
                                </label>
                            </div>
                        </div>
                        <div class="w-9/12">
                            <div class="mt-6 flex">
                                <label class="block flex-1">
                                    <input type="date" name="date" id="date" class="form-input mt-1 block w-full text-gray-700" placeholder="Date">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-8">
                    <a href="{{route('home')}}" class="flex items-center text-gray-700 dark:text-gray-200 text-sm font-medium rounded hover:underline focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                        <span class="mx-2">Kembali</span>
                    </a>
                    <button class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span>Payment</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="w-full mb-8 flex-shrink-0 order-1 lg:w-1/2 lg:mb-0 lg:order-2 flex justify-end">
            <div x-data="{ 
                totalHarga: 0
            }" class="w-9/12">
                <div class="border border-gray-600 rounded-md max-w-md w-full px-4 py-3 mb-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-700 dark:text-gray-300 font-medium">Total Keranjang</h3>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Harga</span>
                    </div>
                    @foreach ($carts as $cart)
                    @php
                        $menu = App\Models\Menu::find($cart->menu_id);
                    @endphp
                        <div x-data="{
                            qty:{{$cart->qty}},
                            harga:{{$menu->harga}},
                            cartApi(method,url,callback) {
                                fetch(url,{method:method,headers:{Accept:'application/json'}}).then(async (result) => {
                                    if (result.status == 200) return await result.json()
                                }).then(async (result) => {
                                    this.qty = result
                                    if(typeof callback == 'function') return callback()
                                }).catch((err) => console.log(err));
                            }
                        }" class="flex justify-between mt-6" x-show="qty > 0" x-init="$nextTick(() => $parent.totalHarga = $parent.totalHarga + (qty * harga))">
                            <div class="flex w-full">
                                <img class="h-20 w-20 object-cover rounded" src="/storage/img/{{$menu->image}}" alt="">
                                <div class="mx-3 flex flex-col w-full">
                                    <h3 class="text-sm text-gray-600 dark:text-gray-200 mb-auto">{{$menu->menu}}</h3>
                                    <div class="flex items-center justify-end">
                                        <div class="text-gray-600 whitespace-nowrap" x-text="'Rp. ' + harga"></div>

                                        <div class="flex items-center mx-3">
                                            <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="cartApi('PUT','{{route('cart.more',$menu->id).'?api_token='.Auth::user()->api_token}}',() => $parent.totalHarga = $parent.totalHarga + harga);">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                            <span class="text-gray-700 dark:text-gray-100 mx-2" x-text="qty"></span>
                                            <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="cartApi('DELETE','{{route('cart.less',$menu->id).'?api_token='.Auth::user()->api_token}}',() => $parent.totalHarga = $parent.totalHarga - harga);" >
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </div>
                                        <div class="text-gray-600">=</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="text-gray-600 whitespace-nowrap mt-auto" x-text="'Rp. ' + (harga*qty)"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="border border-gray-600 rounded-md max-w-md w-full px-4 py-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-700 dark:text-gray-300 font-medium">Total Harga</h3>
                        <span class="text-gray-600 dark:text-gray-400 text-sm" x-text="'Rp. ' + totalHarga"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</x-guest-layout>