<x-guest-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
              <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                  <span>{{ __($title) }}</span> 
              </div>

              <!-- Session Status -->
              <x-session-status class="mb-4 sm:px-6 lg:px-8 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 sm:px-6 lg:px-8 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

              <div class="mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between">
                  <div class="mx-auto sm:px-6 lg:px-8 flex">
                      <div class="mt-8 mx-5 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                          <div class="grid grid-cols-1 md:grid-cols-2">
                              <div class="p-6">
                                  <div class="flex items-center">
                                      <x-svg.application-logo class="block h-10 w-auto fill-current text-gray-600" />
                                      <div class="ml-4 text-lg leading-7 font-semibold dark:text-gray-100">{{ Auth::user()->name }}</div>
                                  </div>
                                  <div class="ml-14">
                                      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">{{ Auth::user()->email }}
                                      </div>
                                      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                          Cretated At <i>{{ Auth::user()->created_at }}</i>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-guest-layout>