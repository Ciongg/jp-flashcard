<template>
  <Layout>
    <div class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center p-8">
      <h1 class="text-4xl md:text-6xl font-bold mb-8 text-center">Japanese Kana Flashcards</h1>
      <p class="text-lg md:text-xl mb-12 text-center max-w-2xl">
        Learn Katakana and Hiragana with interactive flashcards. Select a script to get started!
      </p>
      <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8">
        <button
          @click="goToKatakana"
          class="px-8 py-4 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-semibold text-xl transition"
        >
          Learn Katakana
        </button>
        <button
          @click="goToHiragana"
          class="px-8 py-4 bg-green-600 hover:bg-green-500 rounded-lg text-white font-semibold text-xl transition"
        >
          Learn Hiragana
        </button>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from '../Layouts/Layout.vue';

export default {
  name: 'Home',
  components: {
    Layout,
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
