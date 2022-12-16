<x-app-layout>
  <div class="py-12 bg-gray-100 dark:bg-gray-900 py-4 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
              <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                  <span>{{ __($title) }}</span>
              </div>

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 sm:px-6 lg:px-8" :errors="$errors" />

              <div class="mx-auto sm:px-6 lg:px-8 h-screen container">

                <div class="w-1/2">
                  <form method="POST" action="{{ route('type.update', $type->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="mb-10">
                        <x-forms.label for="type" :value="__('Nama Aneka Jenis')" />
                        <x-forms.input id="type" class="block mt-1 w-full text-gray-900" type="text" name="type" :value="old('type') ?? $type->jenis" required autofocus />
                    </div>
  
                    <div class="w-full flex justify-end">
                        <x-button :color="'bg-blue-600'">
                            {{ __('Edit') }}
                          </x-button>
                    </div>
                  </form>
                </div>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>
