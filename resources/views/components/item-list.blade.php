@props(['process'])

<div class="bg-white dark:bg-gray-800 w-72 mx-5 rounded-md shadow-md overflow-hidden">
  <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('/storage/img/{{$process->image}}');">
    {{-- <a class="mx-5 -mb-4 bg-blue-600 text-white hover:bg-blue-500 focus:bg-blue-500 p-2 rounded-full focus:outline-none" href="{{route('register')}}">
      <x-svg.cart-logo />
    </a>   --}}
  </div>
  <div class="px-5 py-3 h-32">
    <div class="overflow-ellipsis overflow-hidden h-24">
      <a href="{{route('home.product',$process->id)}}" class="text-gray-700 dark:text-gray-200">{{$process->nama}}</a>
      <p class="text-gray-500 mt-2">{{$process->desc}}</p>
    </div>
  </div>
</div>