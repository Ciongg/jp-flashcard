<template>
  <Layout>
    <div class="bg-gray-900 text-white p-8 flex flex-col min-h-screen">
      <h1 class="text-3xl font-bold mb-6 text-center shrink-0">Select Hiragana Groups for Flashcards</h1>
      <div class="overflow-x-auto overflow-y-hidden shrink-0">
        <div class="flex space-x-2 sm:space-x-3 pb-0">
          <div
            v-for="group in groups"
            :key="group.name"
            class="bg-gray-800 p-2 sm:p-3 rounded-lg flex-shrink-0 w-28 sm:w-32 md:w-36 flex flex-col"
          >
            <div class="flex justify-center mb-2 sm:mb-3">
              <label class="relative inline-flex items-center cursor-pointer">
                <input
                  type="checkbox"
                  v-model="selectedGroups"
                  :value="group.name"
                  class="sr-only peer"
                />
                <div class="w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>
            <div class="flex flex-col gap-1 sm:gap-2 flex-1">
              <div v-for="char in group.characters" :key="char.kana" class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl">{{ char.kana }}</div>
                <hr class="my-1 sm:my-1.5 border-gray-600" />
                <div class="text-[10px] sm:text-xs md:text-sm">{{ char.roman }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-col items-center mt-4 sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-4 shrink-0">
        <button
          @click="startWritingTest"
          class="cursor-pointer inline-flex items-center rounded-lg px-5 py-2.5 sm:px-6 sm:py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 text-white font-semibold"
        >
          <span class="sm:hidden">Begin Writing ({{ selectedGroups.length }})</span>
          <span class="hidden sm:inline">Begin Writing Test ({{ selectedGroups.length }})</span>
        </button>
        <button
          @click="startTest"
          class="cursor-pointer inline-flex items-center rounded-lg px-5 py-2.5 sm:px-6 sm:py-3 text-base bg-gray-800/60 hover:bg-blue-600/80 transition-colors ring-1 ring-gray-700 text-white font-semibold"
        >
          <span class="sm:hidden">Begin Reading ({{ selectedGroups.length }})</span>
          <span class="hidden sm:inline">Begin Reading Test ({{ selectedGroups.length }})</span>
        </button>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from '../Layouts/Layout.vue';

export default {
  name: 'Hiragana',
  components: { Layout },
  data() {
    return {
      selectedGroups: [],
      groups: [
        { name: 'Vowels', characters: [
          { kana: 'あ', roman: 'a' }, { kana: 'い', roman: 'i' }, { kana: 'う', roman: 'u' }, { kana: 'え', roman: 'e' }, { kana: 'お', roman: 'o' },
        ]},
        { name: 'Ka', characters: [
          { kana: 'か', roman: 'ka' }, { kana: 'き', roman: 'ki' }, { kana: 'く', roman: 'ku' }, { kana: 'け', roman: 'ke' }, { kana: 'こ', roman: 'ko' },
        ]},
        { name: 'Sa', characters: [
          { kana: 'さ', roman: 'sa' }, { kana: 'し', roman: 'shi' }, { kana: 'す', roman: 'su' }, { kana: 'せ', roman: 'se' }, { kana: 'そ', roman: 'so' },
        ]},
        { name: 'Ta', characters: [
          { kana: 'た', roman: 'ta' }, { kana: 'ち', roman: 'chi' }, { kana: 'つ', roman: 'tsu' }, { kana: 'て', roman: 'te' }, { kana: 'と', roman: 'to' },
        ]},
        { name: 'Na', characters: [
          { kana: 'な', roman: 'na' }, { kana: 'に', roman: 'ni' }, { kana: 'ぬ', roman: 'nu' }, { kana: 'ね', roman: 'ne' }, { kana: 'の', roman: 'no' },
        ]},
        { name: 'Ha', characters: [
          { kana: 'は', roman: 'ha' }, { kana: 'ひ', roman: 'hi' }, { kana: 'ふ', roman: 'fu' }, { kana: 'へ', roman: 'he' }, { kana: 'ほ', roman: 'ho' },
        ]},
        { name: 'Ma', characters: [
          { kana: 'ま', roman: 'ma' }, { kana: 'み', roman: 'mi' }, { kana: 'む', roman: 'mu' }, { kana: 'め', roman: 'me' }, { kana: 'も', roman: 'mo' },
        ]},
        { name: 'Ya', characters: [
          { kana: 'や', roman: 'ya' }, { kana: 'ゆ', roman: 'yu' }, { kana: 'よ', roman: 'yo' },
        ]},
        { name: 'Ra', characters: [
          { kana: 'ら', roman: 'ra' }, { kana: 'り', roman: 'ri' }, { kana: 'る', roman: 'ru' }, { kana: 'れ', roman: 're' }, { kana: 'ろ', roman: 'ro' },
        ]},
        { name: 'Wa', characters: [
          { kana: 'わ', roman: 'wa' }, { kana: 'を', roman: 'wo' },
        ]},
        { name: 'N', characters: [
          { kana: 'ん', roman: 'n' },
        ]},
        { name: 'Ga', characters: [
          { kana: 'が', roman: 'ga' }, { kana: 'ぎ', roman: 'gi' }, { kana: 'ぐ', roman: 'gu' }, { kana: 'げ', roman: 'ge' }, { kana: 'ご', roman: 'go' },
        ]},
        { name: 'Za', characters: [
          { kana: 'ざ', roman: 'za' }, { kana: 'じ', roman: 'ji' }, { kana: 'ず', roman: 'zu' }, { kana: 'ぜ', roman: 'ze' }, { kana: 'ぞ', roman: 'zo' },
        ]},
        { name: 'Da', characters: [
          { kana: 'だ', roman: 'da' }, { kana: 'ぢ', roman: 'di' }, { kana: 'づ', roman: 'du' }, { kana: 'で', roman: 'de' }, { kana: 'ど', roman: 'do' },
        ]},
        { name: 'Ba', characters: [
          { kana: 'ば', roman: 'ba' }, { kana: 'び', roman: 'bi' }, { kana: 'ぶ', roman: 'bu' }, { kana: 'べ', roman: 'be' }, { kana: 'ぼ', roman: 'bo' },
        ]},
        { name: 'Pa', characters: [
          { kana: 'ぱ', roman: 'pa' }, { kana: 'ぴ', roman: 'pi' }, { kana: 'ぷ', roman: 'pu' }, { kana: 'ぺ', roman: 'pe' }, { kana: 'ぽ', roman: 'po' },
        ]},
      ],
    };
  },
  computed: {
    selectedCharacters() {
      return this.groups
        .filter(g => this.selectedGroups.includes(g.name))
        .flatMap(g => g.characters);
    },
  },
  mounted() {
    const saved = localStorage.getItem('selectedHiraganaGroups');
    if (saved) this.selectedGroups = JSON.parse(saved);
  },
  watch: {
    selectedGroups: {
      handler(newVal) {
        localStorage.setItem('selectedHiraganaGroups', JSON.stringify(newVal));
      },
      deep: true,
    },
  },
  methods: {
    startTest() {
      this.$inertia.visit('/flashcard?selectedCharacters=' + encodeURIComponent(JSON.stringify(this.selectedCharacters)));
    },
    startWritingTest() {
      this.$inertia.visit('/writing-flashcard?selectedCharacters=' + encodeURIComponent(JSON.stringify(this.selectedCharacters)));
    },
  },
};
</script>
