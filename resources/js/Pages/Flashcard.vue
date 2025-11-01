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
        <div class="flex flex-col items-center">
          <div class="text-7xl sm:text-9xl">{{ currentDisplay }}</div>
          <!-- Timer progress bar (bigger) -->
          <div v-if="timerActive" class="w-80 sm:w-96 md:w-[28rem] mt-6">
            <div class="w-full h-3 sm:h-4 rounded-full border-2 border-gray-600 bg-gray-800 overflow-hidden">
              <div
                class="h-full bg-blue-500"
                :key="progressKey"
                :style="progressStyle"
              ></div>
            </div>
          </div>
        </div>
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
        class="p-6 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-center gap-4"
      >
        <!-- Left: Stats -->
        <div
          class="order-1 col-span-1 md:col-span-2 xl:col-span-1 flex items-center justify-center md:justify-center xl:justify-start gap-2 sm:gap-3 flex-wrap md:flex-nowrap"
        >
          <div
            class="shrink-0 px-2 py-1 sm:px-3 sm:py-1.5 bg-gray-800 rounded-lg text-white font-semibold text-xs sm:text-sm md:text-sm whitespace-nowrap"
            :title="`Remaining: ${remaining}`"
            aria-label="Remaining"
          >
            <span class="md:hidden">R:</span>
            <span class="hidden md:inline">Remaining:</span>
            <span class="ml-1">{{ remaining }}</span>
          </div>
          <div
            class="shrink-0 px-2 py-1 sm:px-3 sm:py-1.5 bg-gray-800 rounded-lg text-white font-semibold text-xs sm:text-sm md:text-sm whitespace-nowrap"
            :title="`Incorrect: ${incorrect}`"
            aria-label="Incorrect"
          >
            <span class="md:hidden">I:</span>
            <span class="hidden md:inline">Incorrect:</span>
            <span class="ml-1">{{ incorrect }}</span>
          </div>
          <div
            class="shrink-0 px-2 py-1 sm:px-3 sm:py-1.5 bg-gray-800 rounded-lg text-white font-semibold text-xs sm:text-sm md:text-sm whitespace-nowrap"
            :title="`Streak: ${streak}`"
            aria-label="Streak"
          >
            <span class="md:hidden">S:</span>
            <span class="hidden md:inline">Streak:</span>
            <span class="ml-1">{{ streak }}</span>
          </div>
        </div>

        <!-- Center: Input -->
        <div class="order-2 col-span-1 md:col-span-2 xl:col-span-1 flex justify-center min-w-0">
          <input
            v-model="guess"
            class="w-full max-w-[16rem] sm:max-w-[20rem] md:max-w-[22rem] lg:max-w-[24rem] px-6 py-3 rounded-full bg-gray-800 text-white border text-center focus:outline-none focus:ring-0"
            :class="[isIncorrect ? 'border-red-500 focus:border-red-500 shake' : 'border-gray-600 focus:border-gray-600']"
            type="text"
            placeholder="Enter Romaji"
          />
        </div>

        <!-- Right: Timer + Reveal -->
        <div
          class="order-3 md:col-span-2 xl:col-span-1 flex flex-wrap md:flex-nowrap items-center justify-center md:justify-center xl:justify-end gap-2"
        >
          <div class="flex items-center gap-2">
            <input
              v-model.number="timerSeconds"
              type="number"
              min="1"
              class="w-16 md:w-20 px-3 py-2 rounded-full bg-gray-800 text-white border border-gray-600 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
              placeholder="sec"
            />
            <button
              @click="toggleTimer"
              class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-full text-white font-semibold opacity-80 whitespace-nowrap flex items-center gap-2"
              :aria-label="timerActive ? 'Stop Timer' : 'Start Timer'"
              :title="timerActive ? 'Stop Timer' : 'Start Timer'"
            >
              <!-- Heroicon: Clock -->
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span class="hidden md:inline">{{ timerActive ? 'Stop Timer' : 'Start Timer' }}</span>
            </button>
          </div>
          <button
            @click="revealAnswer"
            class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-full text-white font-semibold opacity-80 whitespace-nowrap flex items-center gap-2"
            aria-label="Reveal Answer"
            title="Reveal Answer"
          >
            <!-- Heroicon: Eye -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="hidden md:inline">Reveal Answer</span>
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
      // Timer state
      timerActive: false,
      timerSeconds: 3,
      timerId: null,
      // progress bar state
      progressWidth: '0%',
      progressKey: 0,
      // Streak counter
      streak: 0,
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
    progressStyle() {
      const dur = Math.max(1, Number(this.timerSeconds) || 1);
      return {
        width: this.progressWidth,
        transition: `width ${dur}s linear`,
        willChange: 'width',
      };
    },
  },
  mounted() {
    this.restartTest();
  },
  beforeDestroy() {
    this.clearTimer();
  },
  watch: {
    guess(newGuess) {
      if (newGuess === '') return;
      if (this.isIncorrect) this.isIncorrect = false;

      if (this.currentChar && newGuess.length === this.currentChar.roman.length) {
        if (newGuess.toLowerCase() === this.currentChar.roman.toLowerCase()) {
          // Correct: advance and reset timer
          this.streak++; // increment streak
          this.clearTimer();
          this.currentIndex++;
          this.guess = '';
          this.showRomaji = false;
          this.isIncorrect = false;

          if (this.currentIndex >= this.characters.length) {
            this.restartTest(); // streak is NOT reset here
          } else if (this.timerActive) {
            this.startTimerForCurrentChar();
          }
        } else {
          // Incorrect attempt (stay on same char)
          this.isIncorrect = true;
          this.incorrect++;
          this.streak = 0; // reset streak on wrong input
          this.guess = '';
          // Timer continues if active, no need to restart
        }
      }
    },
    timerSeconds() {
      // If timer is running and duration changed, restart animation for current char
      if (this.timerActive && this.currentChar) {
        this.startTimerForCurrentChar();
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
      this.clearTimer();
      this.characters = [...this.selectedCharacters].sort(() => Math.random() - 0.5);
      this.currentIndex = 0;
      this.incorrect = 0;
      this.guess = '';
      this.showRomaji = false;
      this.isIncorrect = false;
      this.progressWidth = '0%';
      if (this.timerActive && this.characters.length > 0) {
        this.startTimerForCurrentChar();
      }
    },
    // Timer controls
    toggleTimer() {
      this.timerActive = !this.timerActive;
      this.clearTimer();
      if (this.timerActive && this.currentChar) {
        // Wait for bar to mount before starting animation
        this.$nextTick(() => {
          this.startTimerForCurrentChar();
        });
      } else {
        this.progressWidth = '0%';
      }
    },
    startTimerForCurrentChar() {
      this.clearTimer();
      const ms = Math.max(1, Number(this.timerSeconds) || 1) * 1000;

      // Bump key to reset DOM node, then animate 100% -> 0%
      this.progressKey++;
      this.progressWidth = '100%';
      this.$nextTick(() => {
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            this.progressWidth = '0%';
          });
        });
      });

      this.timerId = setTimeout(this.handleTimeout, ms);
    },
    clearTimer() {
      if (this.timerId) {
        clearTimeout(this.timerId);
        this.timerId = null;
      }
    },
    handleTimeout() {
      // Time up on current character
      if (!this.currentChar) return;
      this.isIncorrect = true;
      this.incorrect++;
      this.streak = 0; // reset streak on timeout
      this.guess = '';
      this.showRomaji = false;
      this.currentIndex++;

      if (this.currentIndex >= this.characters.length) {
        this.restartTest(); // streak persists across loops
      } else if (this.timerActive) {
        this.startTimerForCurrentChar();
      }
    },
  },
};
</script>

<style scoped>
/* Tailwind handles responsiveness */

/* Shake animation for incorrect input */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20% { transform: translateX(-6px); }
  40% { transform: translateX(6px); }
  60% { transform: translateX(-4px); }
  80% { transform: translateX(4px); }
}
.shake {
  animation: shake 220ms ease-in-out;
}
</style>
