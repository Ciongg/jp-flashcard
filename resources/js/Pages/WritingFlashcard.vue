<template>
  <Layout>
    <div class="min-h-screen bg-gray-900 text-white flex flex-col">
      <!-- Navbar with Back Button -->
      <nav class="flex justify-start p-6">
        <button
          @click="goBack"
          class="flex items-center space-x-2 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-white font-semibold transition"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          <span>Back</span>
        </button>
      </nav>

      <!-- Current Prompt -->
      <div v-if="characters.length > 0" class="flex items-center justify-center text-center py-20 md:py-40 lg:py-52">
        <div
          class="flex flex-col items-center cursor-pointer select-none"
          role="button"
          tabindex="0"
          :aria-label="showAnswer ? 'Continue' : 'Check Answer'"
          @click="primaryAction"
          @keydown.enter.prevent="primaryAction"
        >
          <div
            :class="['text-7xl sm:text-9xl text-white', showAnswer ? 'reveal-bounce' : '']"
          >
            {{ currentDisplay }}
          </div>
          <!-- Reserve space for caption to prevent layout shift -->
          <div class="mt-3 h-5 sm:h-6 flex items-center justify-center">
            <span :class="showAnswer ? '' : 'invisible'" class="text-sm sm:text-base text-gray-300">
              Correct answer
            </span>
          </div>

          <!-- Show progress for answer timer OR auto-continue; reserve space -->
          <div :class="['w-80 sm:w-96 md:w-[28rem] mt-6', progressShowing ? '' : 'invisible']">
            <div class="w-full h-3 sm:h-4 rounded-full border-2 border-gray-600 bg-gray-800 overflow-hidden">
              <div class="h-full bg-blue-500" :key="progressKey" :style="progressStyle"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- No Characters Message -->
      <div v-else class="flex items-center justify-center text-center py-16">
        <p class="text-lg sm:text-xl px-4">No characters selected. Please go back and select groups.</p>
      </div>

      <hr class="border-gray-700 mx-6" />

      <!-- Controls -->
      <div v-if="characters.length > 0" class="p-6 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-center gap-4">
        <!-- Left: Stats -->
        <div class="order-1 col-span-1 md:col-span-2 xl:col-span-1 flex items-center justify-center md:justify-center xl:justify-start gap-2 sm:gap-3 flex-wrap md:flex-nowrap">
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
            :title="`Timed out: ${incorrect}`"
            aria-label="Timed out"
          >
            <span class="md:hidden">T/O:</span>
            <span class="hidden md:inline">Timed out:</span>
            <span class="ml-1">{{ incorrect }}</span>
          </div>
        </div>

        <!-- Center: Primary Action -->
        <div class="order-2 col-span-1 md:col-span-2 xl:col-span-1 flex flex-col items-center justify-center min-w-0">
          <button
            @click="primaryAction"
            :class="[
              'w-full max-w-[16rem] sm:max-w-[20rem] md:max-w-[22rem] lg:max-w-[24rem] px-6 py-3 rounded-full text-white font-semibold text-lg text-center transition',
              showAnswer ? 'bg-blue-600 hover:bg-blue-500' : 'bg-gray-700 hover:bg-gray-600'
            ]"
            :aria-label="showAnswer ? 'Continue' : 'Check Answer'"
            :title="showAnswer ? 'Continue' : 'Check Answer'"
          >
            <span>{{ showAnswer ? 'Continue' : 'Check Answer' }}</span>
            <span class="block text-xs opacity-75 mt-1">Press Space</span>
          </button>
         
        </div>

        <!-- Right: Settings -->
        <div class="order-3 md:col-span-2 xl:col-span-1 flex flex-wrap md:flex-nowrap items-center justify-center md:justify-center xl:justify-end gap-3">
          <!-- Answer Timer -->
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
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span class="hidden md:inline">{{ timerActive ? 'Stop Timer' : 'Start Timer' }}</span>
            </button>
          </div>

          <!-- Auto-continue -->
          <div class="flex items-center gap-2">
            <input
              v-model.number="autoContinueSeconds"
              type="number"
              min="1"
              class="w-16 md:w-20 px-3 py-2 rounded-full bg-gray-800 text-white border border-gray-600 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
              placeholder="auto sec"
              :disabled="!autoContinueActive"
            />
            <button
              @click="toggleAutoContinue"
              class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-full text-white font-semibold opacity-80 whitespace-nowrap"
              :aria-label="autoContinueActive ? 'Disable Auto-continue' : 'Enable Auto-continue'"
              :title="autoContinueActive ? 'Disable Auto-continue' : 'Enable Auto-continue'"
            >
              <span class="hidden md:inline">{{ autoContinueActive ? 'Auto-continue: On' : 'Auto-continue: Off' }}</span>
              <span class="md:hidden">{{ autoContinueActive ? 'Auto: On' : 'Auto: Off' }}</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from '../Layouts/Layout.vue';

export default {
  name: 'WritingFlashcard',
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
      showAnswer: false,
      incorrect: 0, // counts timeouts only
      // Answer timer
      timerActive: false,
      timerSeconds: 3,
      timerId: null,
      // Progress bar
      progressWidth: '0%',
      progressKey: 0,
      // Auto-continue
      autoContinueActive: true,
      autoContinueSeconds: 2,
      autoId: null,
    };
  },
  computed: {
    remaining() {
      return this.characters.length - this.currentIndex - (this.showAnswer ? 1 : 0);
    },
    currentChar() {
      return this.characters[this.currentIndex];
    },
    currentDisplay() {
      if (!this.currentChar) return '';
      return this.showAnswer ? this.currentChar.kana : this.currentChar.roman;
    },
    progressStyle() {
      const dur = Math.max(1, Number(this.showAnswer ? this.autoContinueSeconds : this.timerSeconds) || 1);
      return {
        width: this.progressWidth,
        transition: `width ${dur}s linear`,
        willChange: 'width',
      };
    },
    progressShowing() {
      return (this.timerActive && !this.showAnswer) || (this.autoContinueActive && this.showAnswer);
    },
    autoIndicatorShowing() {
      // Show spinner while in reveal phase with auto-continue enabled
      return this.autoContinueActive && this.showAnswer;
    },
  },
  mounted() {
    this.restartTest();
    window.addEventListener('keydown', this.onKeyDown);
  },
  beforeDestroy() {
    this.clearAnswerTimer();
    this.clearAutoTimer();
    window.removeEventListener('keydown', this.onKeyDown);
  },
  watch: {
    timerSeconds() {
      if (this.timerActive && this.currentChar && !this.showAnswer) {
        this.startTimerForCurrent();
      }
    },
    autoContinueSeconds() {
      if (this.autoContinueActive && this.showAnswer) {
        this.startAutoContinue();
      }
    },
  },
  methods: {
    goBack() {
      // Safer back navigation without assuming origin
      if (window.history.length > 1) window.history.back();
      else this.$inertia.visit('/');
    },
    onKeyDown(e) {
      // Allow spacebar to control flow; ignore when typing into inputs
      if ((e.code === 'Space' || e.key === ' ') && !['INPUT', 'TEXTAREA'].includes(document.activeElement?.tagName)) {
        e.preventDefault();
        this.primaryAction();
      }
    },
    primaryAction() {
      if (!this.currentChar) return;
      if (this.showAnswer) this.continueNext();
      else this.checkAnswer();
    },
    restartTest() {
      this.clearAnswerTimer();
      this.clearAutoTimer();
      this.characters = [...this.selectedCharacters].sort(() => Math.random() - 0.5);
      this.currentIndex = 0;
      this.showAnswer = false;
      this.incorrect = 0;
      this.progressWidth = '0%';
      if (this.timerActive && this.characters.length > 0) {
        this.startTimerForCurrent();
      }
    },
    // Answer phase controls
    toggleTimer() {
      this.timerActive = !this.timerActive;
      this.clearAnswerTimer();
      if (this.timerActive && this.currentChar && !this.showAnswer) {
        this.$nextTick(() => {
          this.startTimerForCurrent();
        });
      } else {
        this.progressWidth = '0%';
      }
    },
    startTimerForCurrent() {
      this.clearAnswerTimer();
      if (!this.timerActive || this.showAnswer) return;
      const ms = Math.max(1, Number(this.timerSeconds) || 1) * 1000;

      // Reset progress bar 100% -> 0%
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
    clearAnswerTimer() {
      if (this.timerId) {
        clearTimeout(this.timerId);
        this.timerId = null;
      }
    },
    handleTimeout() {
      if (!this.currentChar || this.showAnswer) return;
      // Time up: reveal answer and count as timeout
      this.incorrect++;
      this.showAnswer = true;
      this.clearAnswerTimer();
      this.progressWidth = '0%';
      // Start auto-continue (if enabled)
      this.startAutoContinue();
    },
    checkAnswer() {
      if (!this.currentChar || this.showAnswer) return;
      this.showAnswer = true;
      this.clearAnswerTimer();
      this.progressWidth = '0%';
      this.startAutoContinue();
    },
    continueNext() {
      this.clearAutoTimer();
      this.clearAnswerTimer();
      this.progressWidth = '0%';
      this.showAnswer = false;
      this.currentIndex++;

      if (this.currentIndex >= this.characters.length) {
        this.restartTest();
      } else if (this.timerActive) {
        this.startTimerForCurrent();
      }
    },
    // Auto-continue
    toggleAutoContinue() {
      this.autoContinueActive = !this.autoContinueActive;
      this.clearAutoTimer();
      if (this.autoContinueActive && this.showAnswer) {
        this.startAutoContinue();
      } else if (!this.autoContinueActive && this.showAnswer) {
        this.progressWidth = '0%';
      }
    },
    startAutoContinue() {
      this.clearAutoTimer();
      if (!this.autoContinueActive || !this.showAnswer) return;

      // Animate progress bar for auto-continue
      this.progressKey++;
      this.progressWidth = '100%';
      this.$nextTick(() => {
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            this.progressWidth = '0%';
          });
        });
      });

      const ms = Math.max(1, Number(this.autoContinueSeconds) || 1) * 1000;
      this.autoId = setTimeout(() => {
        this.continueNext();
      }, ms);
    },
    clearAutoTimer() {
      if (this.autoId) {
        clearTimeout(this.autoId);
        this.autoId = null;
      }
    },
  },
};
</script>

<style scoped>
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20% { transform: translateX(-6px); }
  40% { transform: translateX(6px); }
  60% { transform: translateX(-4px); }
  80% { transform: translateX(4px); }
}
@keyframes revealBounce {
  0%   { transform: scale(0.9); }
  50%  { transform: scale(1.12); }
  100% { transform: scale(1); }
}
.reveal-bounce {
  animation: revealBounce 220ms ease-out;
}
</style>
