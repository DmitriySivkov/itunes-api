<template>
  <q-page class="column q-mt-xl">
    <div class="row justify-center">
      <div class="col-xs-12 col-md-6">
        <q-form>
          <q-input
            filled
            v-model="search"
            label="Search"
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'Please type something']"
          >
            <template v-slot:after>
              <q-btn label="find and store" color="secondary" size="lg" @click="searchItunes"/>
              <q-btn label="empty table" color="red-9" size="lg" @click="emptyTable"/>
            </template>
          </q-input>
        </q-form>
      </div>
    </div>
    <div v-for="(arSongs, year) in songsByYear"
         :key="year"
         class="row justify-center"
    >
      <div class="col-xs-12 col-md-8">
        <q-markup-table
          dark
          class="bg-indigo-8 q-mb-xl"
        >
          <thead>
            <tr>
              <td class="text-center">collectionName</td>
              <td class="text-center">collectionPrice</td>
              <td class="text-center">kind</td>
              <td class="text-center">primaryGenreName</td>
              <td class="text-center">releaseDate</td>
              <td class="text-center">trackCount</td>
              <td class="text-center">trackName</td>
              <td class="text-center">trackNumber</td>
              <td class="text-center">trackPrice</td>
            </tr>
          </thead>
          <tbody>
          <tr
            v-for="(song, index) in arSongs"
            :key="index"
          >
            <td class="text-center">{{ song.collectionName }}</td>
            <td class="text-center">{{ song.collectionPrice }}</td>
            <td class="text-center">{{ song.kind }}</td>
            <td class="text-center">{{ song.primaryGenreName }}</td>
            <td class="text-center">{{ song.releaseDate }}</td>
            <td class="text-center">{{ song.trackCount }}</td>
            <td class="text-center">{{ song.trackName }}</td>
            <td class="text-center">{{ song.trackNumber }}</td>
            <td class="text-center">{{ song.trackPrice }}</td>
          </tr>
          </tbody>
        </q-markup-table>
      </div>
    </div>
  </q-page>
</template>

<script>
import { computed } from "vue"
import { useStore } from "vuex"
import { external_api } from "src/boot/axios";
import { ref } from "vue"

export default {
  setup() {
    const $store = useStore()
    const songsByYear = computed(() => $store.state.song.data)

    const search = ref("")

    if (songsByYear.value.length < 1)
      $store.dispatch("song/getList")

    return {
      songsByYear,
      search,

      async searchItunes() {
        await external_api.get("", {
          params: {
            term: search.value
          }
        }).then((response) => {
          $store.dispatch("song/addSong", response.data.results)
        })
      },

      async emptyTable() {
        $store.dispatch("song/truncateSong")
      }
    }
  }
};
</script>
