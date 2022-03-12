export const SET_SONGS = (state, payload) => {
  state.data = payload
}

export const ADD_SONG = (state, payload) => {
  state.data = {...payload}
}
