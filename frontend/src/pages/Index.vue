<template>
  <q-page class="column q-mt-xl">
    <div class="row justify-center">
      <div class="col-xs-12 col-md-6">
        <q-form @submit="onSubmit">
          <q-input
            filled
            v-model="song"
            label="Search"
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'Please type something']"
          >
            <template v-slot:after>
              <q-btn label="Find" type="submit" color="primary" size="lg" />
            </template>
          </q-input>
        </q-form>
      </div>
    </div>
    <div class="row justify-center">
      <div class="col-xs-12 col-md-6">
        <q-markup-table
          dark
          class="bg-indigo-8 table_fixed"
        >
          <thead>
            <tr>
              <td class="text-center" style="width:5%">№</td>
              <td class="text-center" style="width:15%">Title</td>
              <td class="text-center">Description</td>
              <td class="text-center" style="width:25%">Action</td>
            </tr>
          </thead>
          <tbody>
          <tr
            v-for="(song, index) in songs"
            :key="index"
          >
            <td class="text-center">{{ song.id }}</td>
            <td class="td_break-word text-center">{{ song.title }}</td>
            <td class="td_break-word">{{ song.description }}</td>
            <td class="text-center">
              <div class="q-gutter-sm">
                <q-btn
                  label="Update"
                  size="sm"
                  color="info"
                  :to="{ name: 'updatesong', params: { id: song.id } }"
                />
                <q-btn
                  label="Delete"
                  size="sm"
                  color="negative"
                  @click="confirmDelete(song.id)"
                />
              </div>
            </td>
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
import { useQuasar } from "quasar"
export default {
  setup() {
    const $store = useStore()
    const songs = computed(() => $store.state.song.data)
    const $q = useQuasar()

    if (songs.value.length < 1)
      $store.dispatch("song/getList")

    return {
      songs,

      confirmDelete(songId) {
        $q.dialog({
          title: 'Confirm',
          message: 'Are you sure you want to delete the song ?',
          cancel: true,
          persistent: true
        }).onOk(() => {
          $store.dispatch("song/deletesong", {
            id: songId
          }).then(() => {
            $q.notify({
              color: "green-4",
              textColor: "white",
              icon: "cloud_done",
              message: "The song is successfully deleted"
            })
          })
        })
      }
    }
  }
};
</script>
