<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <header class="sticky top-0 z-40 bg-gray-800 border-b border-gray-900">
      <nav class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="h-16 sm:h-20 flex items-center justify-between">
          <!-- Brand -->
          <button
            @click="$inertia.visit(route('home'))"
            class="flex items-center gap-2 group"
            aria-label="Go to home"
            title="Learnihon"
          >
            <img
              :src="logoSrc"
              alt="Learnihon logo"
              class="h-[100px] w-[260px] object-contain"
            />
          </button>

          <!-- Nav buttons -->
          <div class="flex items-center gap-2 sm:gap-3">
            <button
              @click="$inertia.visit(route('home'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700"
            >
              <span class="group-hover:hidden">Home</span>
              <span class="hidden group-hover:inline">ホーム</span>
            </button>

            <button
              @click="$inertia.visit(route('katakana'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700"
            >
              <span class="group-hover:hidden">Katakana</span>
              <span class="hidden group-hover:inline">カタカナ</span>
            </button>

            <button
              @click="$inertia.visit(route('hiragana'))"
              class="group inline-flex items-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700"
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
    };
  },
};
</script>
