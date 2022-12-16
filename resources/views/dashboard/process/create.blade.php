<x-app-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
              <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                  <span>{{ __($title) }}</span>
              </div>

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 sm:px-6 lg:px-8" :errors="$errors" />

              <div class="mx-auto sm:px-6 lg:px-8 h-screen container">

                <form method="POST" action="{{ route('process.store', $type->id) }}" enctype="multipart/form-data">
                  <div class="flex justify-between">
                    <div class="w-5/12 mx-5">
                      @csrf

                      <div class="mb-10 pr-10">
                        <x-forms.upload-image :identifier="'imageOlahan'" />                    
                      </div>
                    </div>
                    <div class="w-7/12 mx-5">
                      <div class="mb-10">
                        <x-forms.label for="type" :value="__('Jenis Olahan')" />
                        <x-forms.input id="type" class="block mt-1 w-full text-gray-900" type="text" name="type" :value="$type->jenis" readonly />
                      </div>
  
                      <div class="mb-10">
                          <x-forms.label for="process" :value="__('Nama Olahan')" />
                          <x-forms.input id="process" class="block mt-1 w-full text-gray-900" type="text" name="process" :value="old('process')" required autofocus />
                      </div>

                      <div class="mb-10">
                        <x-forms.label for="desc" :value="__('Deskripsi')" />
                        <x-forms.textarea id="desc" class="block mt-1 w-full text-gray-900 h-36" type="text" name="desc" required>{{old('desc')}}</x-forms.textarea>
                      </div>
  
                      <div class="w-full flex justify-end">
                        <x-button :color="'bg-blue-600'">
                          {{ __('Tambah') }}
                        </x-button>
                    </div>
                    </div>
  
                  </div>
                </form>

              </div>
          </div>
      </div>
  </div>

</x-app-layout>
