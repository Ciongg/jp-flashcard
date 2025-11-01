<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <header class="sticky top-0 z-40 bg-gray-800 border-b border-gray-900">
      <nav class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="h-16 sm:h-20 flex items-center justify-between">
          <!-- Brand (visible on all, smaller on mobile) -->
          <button
            @click="$inertia.visit(route('home'))"
            class="flex items-center gap-2 group shrink-0 cursor-pointer"
            aria-label="Go to home"
            title="Learnihon"
          >
            <img
              :src="logoSrc"
              alt="Learnihon logo"
              class="h-[100px] w-[260px] object-contain"
            />
          </button>

          <!-- Mobile hamburger (only small) -->
          <button
            @click="toggleMobile"
            class="sm:hidden inline-flex items-center rounded-full p-2 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 cursor-pointer"
            :aria-expanded="mobileOpen.toString()"
            aria-controls="mobile-menu"
            aria-label="Toggle menu"
          >
            <svg v-if="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>

          <!-- Nav buttons (hidden on small) -->
          <div class="hidden sm:flex items-center gap-2 sm:gap-3">
            <button
              @click="$inertia.visit(route('home'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Home</span>
              <span class="hidden group-hover:inline">ホーム</span>
            </button>

            <button
              @click="$inertia.visit(route('katakana'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Katakana</span>
              <span class="hidden group-hover:inline">カタカナ</span>
            </button>

            <button
              @click="$inertia.visit(route('hiragana'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Hiragana</span>
              <span class="hidden group-hover:inline">ひらがな</span>
            </button>
          </div>
        </div>

        <!-- Mobile menu panel -->
        <div v-if="mobileOpen" id="mobile-menu" class="sm:hidden border-t border-gray-700 pb-3 pt-2">
          <div class="px-2 space-y-2">
            <button
              @click="navTo('home')"
              class="w-full text-left group inline-flex items-center rounded-lg px-4 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Home</span>
              <span class="hidden group-hover:inline">ホーム</span>
            </button>
            <button
              @click="navTo('katakana')"
              class="w-full text-left group inline-flex items-center rounded-lg px-4 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Katakana</span>
              <span class="hidden group-hover:inline">カタカナ</span>
            </button>
            <button
              @click="navTo('hiragana')"
              class="w-full text-left group inline-flex items-center rounded-lg px-4 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
            >
              <span class="group-hover:hidden">Hiragana</span>
              <span class="hidden group-hover:inline">ひらがな</span>
            </button>
          </div>
        </div>
      </nav>
    </header>

    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script>
export default {
  name: 'Layout',
  data() {
    return {
      logoSrc: '/images/logoT.png',
      mobileOpen: false,
    };
  },
  methods: {
    toggleMobile() {
      this.mobileOpen = !this.mobileOpen;
    },
    navTo(name) {
      this.mobileOpen = false;
      this.$inertia.visit(route(name));
    },
  },
};
</script>
