import { api } from "boot/axios"

export const getList = async ({commit}) => {
  await api.get("songs").then((response) => {
    commit("SET_SONGS", response.data)
  })
}

export const addSong = async ({commit}, payload) => {
  await api.post("songs", payload).then((response) => {
    commit("ADD_SONG", response.data)
  })
}

export const truncateSong = async ({commit}, payload) => {
  await api.delete("songs").then(() => {
    commit("SET_SONGS", [])
  })
}
