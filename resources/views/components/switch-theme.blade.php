<label x-data="{ theme: localStorage.theme }" for="switchTheme" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
  <div class="relative">
      <input id="switchTheme" type="checkbox" class="sr-only" x-bind:checked="localStorage.theme == 'dark'" @click="theme = event.target.checked ? 'dark':'light'; switchTheme(event.target.checked ? 'dark':'light')" />
      <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner" ></div>
      <div class="dot absolute w-6 h-6 rounded-full shadow -left-1 -top-1 transition">
        <template x-if="theme === 'dark'">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-white" viewBox="0 0 24 24" fill="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </template>
        <template x-if="theme !== 'dark'">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-white" viewBox="0 0 24 24" fill="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </template>
      </div>
  </div>
</label>