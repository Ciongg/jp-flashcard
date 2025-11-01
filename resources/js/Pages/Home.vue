<template>
  <Layout>
    <div class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center px-6 py-12">
      <div class="flex flex-col items-center text-center max-w-3xl">
        <img
  :src="logoSrc"
  alt="Learnihon"
  class="h-[30vh] sm:h-48 w-auto object-contain mb-6 opacity-90"
/>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Practice Hiragana & Katakana</h1>
        <p class="text-base md:text-lg text-gray-300 mb-8">
          Build reading and writing speed with responsive, timer-based flashcards.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
          <button
            @click="goToKatakana"
            class="group inline-flex items-center justify-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
          >
            Learn Katakana
          </button>
          <button
            @click="goToHiragana"
            class="group inline-flex items-center justify-center rounded-full px-6 py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 cursor-pointer"
          >
            Learn Hiragana
          </button>
        </div>

        <div class="mt-10 text-xl sm:text-lg text-gray-400 opacity-80 select-none">
          By: Karl Miguel Inciong
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from '../Layouts/Layout.vue';

export default {
  name: 'Home',
  components: { Layout },
  data() {
    return {
      logoSrc: '/images/logoT.png',
    };
  },
  methods: {
    goToKatakana() {
      this.$inertia.visit('/katakana');
    },
    goToHiragana() {
      this.$inertia.visit('/hiragana');
    },
  },
};
</script>
