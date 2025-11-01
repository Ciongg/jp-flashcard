<template>
  <Layout>
    <div class="bg-gray-900 text-white p-8 flex flex-col min-h-screen">
      <h1 class="text-3xl font-bold mb-6 text-center shrink-0">Select Katakana Groups for Flashcards</h1>
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
  name: 'Katakana',
  components: {
    Layout,
  },
  data() {
    return {
      selectedGroups: [],
      groups: [
        {
          name: 'Vowels',
          characters: [
            { kana: 'ア', roman: 'a' },
            { kana: 'イ', roman: 'i' },
            { kana: 'ウ', roman: 'u' },
            { kana: 'エ', roman: 'e' },
            { kana: 'オ', roman: 'o' },
          ],
        },
        {
          name: 'Ka',
          characters: [
            { kana: 'カ', roman: 'ka' },
            { kana: 'キ', roman: 'ki' },
            { kana: 'ク', roman: 'ku' },
            { kana: 'ケ', roman: 'ke' },
            { kana: 'コ', roman: 'ko' },
          ],
        },
        {
          name: 'Sa',
          characters: [
            { kana: 'サ', roman: 'sa' },
            { kana: 'シ', roman: 'shi' },
            { kana: 'ス', roman: 'su' },
            { kana: 'セ', roman: 'se' },
            { kana: 'ソ', roman: 'so' },
          ],
        },
        {
          name: 'Ta',
          characters: [
            { kana: 'タ', roman: 'ta' },
            { kana: 'チ', roman: 'chi' },
            { kana: 'ツ', roman: 'tsu' },
            { kana: 'テ', roman: 'te' },
            { kana: 'ト', roman: 'to' },
          ],
        },
        {
          name: 'Na',
          characters: [
            { kana: 'ナ', roman: 'na' },
            { kana: 'ニ', roman: 'ni' },
            { kana: 'ヌ', roman: 'nu' },
            { kana: 'ネ', roman: 'ne' },
            { kana: 'ノ', roman: 'no' },
          ],
        },
        {
          name: 'Ha',
          characters: [
            { kana: 'ハ', roman: 'ha' },
            { kana: 'ヒ', roman: 'hi' },
            { kana: 'フ', roman: 'fu' },
            { kana: 'ヘ', roman: 'he' },
            { kana: 'ホ', roman: 'ho' },
          ],
        },
        {
          name: 'Ma',
          characters: [
            { kana: 'マ', roman: 'ma' },
            { kana: 'ミ', roman: 'mi' },
            { kana: 'ム', roman: 'mu' },
            { kana: 'メ', roman: 'me' },
            { kana: 'モ', roman: 'mo' },
          ],
        },
        {
          name: 'Ya',
          characters: [
            { kana: 'ヤ', roman: 'ya' },
            { kana: 'ユ', roman: 'yu' },
            { kana: 'ヨ', roman: 'yo' },
          ],
        },
        {
          name: 'Ra',
          characters: [
            { kana: 'ラ', roman: 'ra' },
            { kana: 'リ', roman: 'ri' },
            { kana: 'ル', roman: 'ru' },
            { kana: 'レ', roman: 're' },
            { kana: 'ロ', roman: 'ro' },
          ],
        },
        {
          name: 'Wa',
          characters: [
            { kana: 'ワ', roman: 'wa' },
            { kana: 'ヲ', roman: 'wo' },
          ],
        },
        {
          name: 'N',
          characters: [
            { kana: 'ン', roman: 'n' },
          ],
        },
        {
          name: 'Ga',
          characters: [
            { kana: 'ガ', roman: 'ga' },
            { kana: 'ギ', roman: 'gi' },
            { kana: 'グ', roman: 'gu' },
            { kana: 'ゲ', roman: 'ge' },
            { kana: 'ゴ', roman: 'go' },
          ],
        },
        {
          name: 'Za',
          characters: [
            { kana: 'ザ', roman: 'za' },
            { kana: 'ジ', roman: 'zi' },
            { kana: 'ズ', roman: 'zu' },
            { kana: 'ゼ', roman: 'ze' },
            { kana: 'ゾ', roman: 'zo' },
          ],
        },
        {
          name: 'Da',
          characters: [
            { kana: 'ダ', roman: 'da' },
            { kana: 'ヂ', roman: 'di' },
            { kana: 'ヅ', roman: 'du' },
            { kana: 'デ', roman: 'de' },
            { kana: 'ド', roman: 'do' },
          ],
        },
        {
          name: 'Ba',
          characters: [
            { kana: 'バ', roman: 'ba' },
            { kana: 'ビ', roman: 'bi' },
            { kana: 'ブ', roman: 'bu' },
            { kana: 'ベ', roman: 'be' },
            { kana: 'ボ', roman: 'bo' },
          ],
        },
        {
          name: 'Pa',
          characters: [
            { kana: 'パ', roman: 'pa' },
            { kana: 'ピ', roman: 'pi' },
            { kana: 'プ', roman: 'pu' },
            { kana: 'ペ', roman: 'pe' },
            { kana: 'ポ', roman: 'po' },
          ],
        },
      ],
    };
  },
  computed: {
    selectedCharacters() {
      return this.groups
        .filter(group => this.selectedGroups.includes(group.name))
        .flatMap(group => group.characters);
    },
  },
  mounted() {
    const saved = localStorage.getItem('selectedKatakanaGroups');
    if (saved) {
      this.selectedGroups = JSON.parse(saved);
    }
  },
  watch: {
    selectedGroups: {
      handler(newVal) {
        localStorage.setItem('selectedKatakanaGroups', JSON.stringify(newVal));
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
