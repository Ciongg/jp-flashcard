<template>
  <Layout>
    <div class="min-h-screen bg-gray-900 text-white flex flex-col">
      <!-- Navbar with Back Button -->
      <nav class="flex justify-start p-6">
        <button
          @click="goBack"
          class="flex items-center space-x-2 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-white font-semibold transition"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          <span>Back</span>
        </button>
      </nav>

      <!-- Current Character -->
      <div
        v-if="characters.length > 0"
        class="flex items-center justify-center text-center py-20 md:py-40 lg:py-52"
      >
        <div class="text-7xl sm:text-9xl">{{ currentDisplay }}</div>
      </div>

      <!-- No Characters Message -->
      <div
        v-else
        class="flex items-center justify-center text-center py-16"
      >
        <p class="text-lg sm:text-xl px-4">No characters selected. Please go back and select groups.</p>
      </div>

      <!-- Separator Line -->
      <hr class="border-gray-700 mx-6" />

      <!-- Stats, Input, and Button -->
      <div
        v-if="characters.length > 0"
        class="p-6 w-full grid grid-cols-1 md:grid-cols-3 items-center gap-4"
      >
        <!-- Left: Stats -->
        <div class="flex items-center justify-center md:justify-start space-x-3 flex-wrap">
          <div class="px-4 py-2 bg-gray-800 rounded-lg text-white font-semibold text-base sm:text-lg">
            Remaining: {{ remaining }}
          </div>
          <div class="px-4 py-2 bg-gray-800 rounded-lg text-white font-semibold text-base sm:text-lg">
            Incorrect: {{ incorrect }}
          </div>
        </div>

        <!-- Center: Input -->
        <div class="flex justify-center">
          <input
            v-model="guess"
            class="w-full sm:w-80 md:w-96 px-6 py-3 rounded-full bg-gray-800 text-white border text-center focus:outline-none focus:ring-0"
            :class="[isIncorrect ? 'border-red-500 focus:border-red-500' : 'border-gray-600 focus:border-gray-600']"
            type="text"
            placeholder="Enter Romaji"
          />
        </div>

        <!-- Right: Reveal Button -->
        <div class="flex justify-center md:justify-end">
          <button
            @click="revealAnswer"
            class="w-full sm:w-auto px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-full text-white font-semibold opacity-80"
          >
            Reveal Answer
          </button>
        </div>
      </div>
    </div>
  </Layout>
</template>


<script>
import Layout from '../Layouts/Layout.vue';

export default {
  name: 'Flashcard',
  components: { Layout },
  props: {
    selectedCharacters: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      characters: [],
      currentIndex: 0,
      incorrect: 0,
      guess: '',
      showRomaji: false,
      isIncorrect: false,
    };
  },
  computed: {
    remaining() {
      return this.characters.length - this.currentIndex;
    },
    currentChar() {
      return this.characters[this.currentIndex];
    },
    currentDisplay() {
      if (!this.currentChar) return '';
      return this.showRomaji ? this.currentChar.roman : this.currentChar.kana;
    },
  },
  mounted() {
    this.restartTest();
  },
  watch: {
    guess(newGuess) {
      if (newGuess === '') return;
      if (this.isIncorrect) this.isIncorrect = false;

      if (this.currentChar && newGuess.length === this.currentChar.roman.length) {
        if (newGuess.toLowerCase() === this.currentChar.roman.toLowerCase()) {
          this.currentIndex++;
          this.guess = '';
          this.showRomaji = false;
          this.isIncorrect = false;

          if (this.currentIndex >= this.characters.length) {
            this.restartTest();
          }
        } else {
          this.isIncorrect = true;
          this.incorrect++;
          this.guess = '';
        }
      }
    },
  },
  methods: {
    goBack() {
      this.$inertia.visit('/katakana');
    },
    revealAnswer() {
      this.showRomaji = !this.showRomaji;
    },
    restartTest() {
      this.characters = [...this.selectedCharacters].sort(() => Math.random() - 0.5);
      this.currentIndex = 0;
      this.incorrect = 0;
      this.guess = '';
      this.showRomaji = false;
      this.isIncorrect = false;
    },
  },
};
</script>

<style scoped>
/* Tailwind handles responsiveness */
</style>
