@props(['identifier', 'urlFile' => ''])

<div x-data="{ urlFile: '{{$urlFile}}', updatePreview() { 
    let reader, files = document.getElementById('{{$identifier}}').files; 
    reader = new FileReader();
    reader.onload = e => this.urlFile = e.target.result;
    reader.readAsDataURL(files[0])} 
  }" 
  class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
  <input type="file" id="{{$identifier}}" name="{{$identifier}}" class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0" @change="updatePreview()">
  <template x-if="urlFile !== ''">
      <div class="flex flex-col space-y-1">
        <img :src="urlFile" alt="" class="rounded">  
      </div>
  </template>
  <template x-if="urlFile === ''">
      <div class="flex flex-col space-y-2 items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 my-5" viewBox="0 0 20 20" fill="currentColor">
          <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
          <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
        </svg>
        <p class="text-gray-700">Seret gambar ke sini atau klik di area ini.</p>
        <x-nav-link class="my-5 bg-red-700 hover:bg-red-600" :href="'javascript:void(0)'">
          {{ __('Pilih Gambar') }}
        </x-nav-link> 
      </div>
  </template>
</div>