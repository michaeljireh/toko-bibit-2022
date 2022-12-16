<x-guest-layout>
  <div class="container mx-auto px-6">
    <a href="{{route('home')}}" class="w-min flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
      <span class="mx-2">Kembali</span>
    </a>
    <div class="w-1/2 mx-auto bg-white dark:bg-gray-800 p-8 shadow-lg">
      <h3 class="text-gray-700 dark:text-gray-300 text-2xl font-medium">Pembayaran</h3>
      <div class="flex justify-between mt-4 py-4 border-b-2 border-gray-600">
        <span class="text-gray-500">Total Pembayaran</span><span class="text-gray-700 dark:text-gray-300">Rp. {{$total}}</span>
      </div>
      
      <div class="mt-4 mb-12 py-4 border-b-2 border-gray-600">
        <div class="flex mb-8">
          <img src="/storage/payment/{{$payment->image}}" alt="" class="w-6 h-6">
          <div class="ml-4">
            <div class="mb-4 text-gray-700 dark:text-gray-300">{{$payment->nama_pembayaran}}</div>
            <div class="text-sm text-gray-700 dark:text-gray-300 mb-1">No. Rekening:</div>
            <div class="text-lg mb-4 font-bold text-gray-900 dark:text-gray-100">{{$payment->no_rekening}}</div>
            <div class="text-sm mb-3 text-gray-700 dark:text-gray-300">Dicek dalam 10 menit setelah upload Bukti Pembayaran berhasil</div>
            <div class="text-sm text-gray-700 dark:text-gray-300">Hanya menerima dari {{$payment->nama_pembayaran}}</div>
          </div>
        </div>
      </div>
      <div class="mt-4 mb-12 border-b-2 border-gray-600">
        <form action="{{route('home.checkout.put', $orderId)}}" method="post" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <div class="text-center mb-8 text-lg font-bold text-gray-500">
            Upload Bukti Pembayaran
          </div>
          <div class="flex justify-center mb-12">
            <x-forms.upload-image :identifier="'imageBukti'" />   
          </div>
          <div class="flex justify-center mb-12">
            <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
              <span class="mx-2">Upload Bukti Pembayaran</span>
            </button>
          </div>
        </form>
      </div>

    </div>

</div>
</x-guest-layout>