<x-auth-layout>
  <div class="mb-8 flex justify-between">
    <div>
      <h2 class="text-3xl font-bold pb-2 tracking-wider uppercase">{{ config('app.name', 'Laravel') }}</h2>
      <h3 class="text-sm tracking-wider">Jl. Simp. Empat Rindang Alam, Bandar Buat, Lubuk Kilangan, Kota Padang, Sumatera Barat 25157, Indonesia</h3>
      <h3 class="text-sm tracking-wider">No. Telp 081365414491 / 081363456105</h3>

    </div>
    <div class="pr-5">
      <div class="w-32 h-32 mb-1 overflow-hidden">
        <x-svg.application-logo class="w-20 h-20 fill-current text-gray-500" />
      </div>
    </div>
  </div>

  <div class="flex flex-wrap border-b py-2 items-start">

    <div class="px-1 w-3/12">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">No. Pesanan</span>
      </p>
    </div>

    <div class="px-1 w-2/12">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Nama Penerima</span>
      </p>
    </div>

    <div class="px-1 w-2/12">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Order Terbuat</span>
      </p>
    </div>

    <div class="px-1 w-2/12">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Pembayaran</span>
      </p>
    </div>

    <div class="px-1 w-1/12">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Status Order</span>
      </p>
    </div>

    <div class="px-1 w-2/12 text-right">
      <p class="leading-none">
        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Total Harga</span>
        <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
      </p>
    </div>
  </div>

  @foreach ($orders as $key => $order)
  <div class="flex flex-wrap py-2 border-b">
    <div class="px-1 w-3/12">
      <p class="text-gray-800 text-xs">{{$order->id}}</p>
    </div>

    <div class="px-1 w-2/12">
      <p class="text-gray-800 text-xs">{{$order->nama_penerima}}</p>
    </div>

    <div class="px-1 w-2/12">
      <p class="text-gray-800 text-xs">{{$order->created_at}}</p>
    </div>

    <div class="px-1 w-2/12">
      <p class="text-gray-800 text-xs">{{ $order->type_pembayaran->nama_pembayaran }}</p>
    </div>

    <div class="px-1 w-1/12">
      <p class="text-gray-800 text-xs">{{$order->status->inisial}}</p>
    </div>

    <div class="px-1 w-2/12 text-right">
      <p class="text-gray-800 text-xs">Rp. {{ $order->total }}</p>
    </div>
  </div>
  @endforeach

  <div class="py-2 ml-auto mt-20" style="width: 320px">
    <div class="flex justify-between mb-3">
      <div class="text-gray-800 text-right flex-1">Total incl. GST</div>
      <div class="text-right w-40">
        <div class="text-gray-800 font-medium">Rp. {{$allTotal}}</div>
      </div>
    </div>
    <div class="flex justify-between mb-4">
      <div class="text-sm text-gray-600 text-right flex-1">GST(0%) incl. in Total</div>
      <div class="text-right w-40">
        <div class="text-sm text-gray-600">Rp. 0</div>
      </div>
    </div>
  
    <div class="py-2 border-t border-b">
      <div class="flex justify-between">
        <div class="text-xl text-gray-600 text-right flex-1">Amount due</div>
        <div class="text-right w-40">
          <div class="text-xl text-gray-800 font-bold">Rp. {{$allTotal}}</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener("load", window.print());
  </script>
</x-auth-layout>