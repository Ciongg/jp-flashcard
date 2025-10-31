<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <nav class="bg-gray-800 p-4 shadow-md">
      <div class="flex space-x-4">
        <button @click="$inertia.visit(route('home'))" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded">Home</button>
        <button @click="$inertia.visit(route('katakana'))" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded">Katakana</button>
        <button @click="$inertia.visit(route('hiragana'))" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded">Hiragana</button>
      </div>
    </nav>
    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script>
export default {
  name: 'Layout',
};
</script>
