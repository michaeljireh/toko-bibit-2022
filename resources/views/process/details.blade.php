<x-guest-layout>
<div class="container mx-auto px-6">
  <div class="md:flex md:items-center">
      <div class="w-full h-64 md:w-1/2 lg:h-96">
          <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="/storage/img/{{$process->image}}" alt="Nike Air">
      </div>
      <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
          <h3 class="text-gray-700 uppercase text-lg dark:text-gray-200">{{$process->nama}}</h3>
          <hr class="my-3">
          <div class="mt-2">
              <label class="text-gray-500 text-sm" for="count">{{$process->desc}}</label>
          </div>
          <div class="flex items-center mt-6">
              <a href="{{route('home')}}" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Kembali</a>
          </div>
      </div>
  </div>

  <div class="mt-16">
    <h3 class="text-gray-600 text-2xl font-medium">Olahan Lainnya</h3>
    <div class="mt-6 overflow-x-scroll">
      <div class="flex flex-nowrap w-max overflow-x-scroll">

        @foreach ($processes as $process)
          <x-item-list :process="$process" />
        @endforeach

      </div>
    </div>
  </div>
</div>
</x-guest-layout>