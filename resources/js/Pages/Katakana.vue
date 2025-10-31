<template>
  <Layout>
    <div class="bg-gray-900 text-white p-8 flex flex-col">
      <h1 class="text-3xl font-bold mb-6 text-center">Select Katakana Groups for Flashcards</h1>
      <div class="overflow-x-auto">
        <div class="flex space-x-6 pb-4">
          <div v-for="group in groups" :key="group.name" class="bg-gray-800 p-6 rounded min-w-64 max-w-64 flex flex-col">
            <div class="flex justify-center mb-4">
              <label class="relative inline-flex items-center cursor-pointer">
                <input
                  type="checkbox"
                  v-model="selectedGroups"
                  :value="group.name"
                  class="sr-only peer"
                />
                <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>
            <div class="flex flex-col gap-4 flex-1">
              <div v-for="char in group.characters" :key="char.kana" class="text-center">
                <div class="text-4xl font-bold">{{ char.kana }}</div>
                <hr class="my-2 border-gray-600" />
                <div class="text-lg">{{ char.roman }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex justify-end">
        <button class="px-8 py-4 mr-4 mt-4 bg-green-600 hover:bg-green-500 rounded-lg text-white font-semibold text-xl">Begin Test ({{ selectedGroups.length }})</button>
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
      ],
    };
  },
};
</script>
