<template>
  <Layout>
    <div class="min-h-screen bg-gray-900 text-white flex items-center justify-center">
      <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to Japanese Flashcards!</h1>
        <p class="text-lg">Learn Katakana and Hiragana characters with ease.</p>
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
};
</script>
