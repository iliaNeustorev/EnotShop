export default () => ({
  namespaced: true,

  state: {
    alerts: [],
    ai: 0,
  },
  getters: {
    all: (state) => state.alerts,
  },
  mutations: {
    add(state, alert) {
      state.alerts.push({ id: ++state.ai, ...alert });
    },
    remove(state, id) {
      let idx = state.alerts.findIndex((alert) => alert.id == id);
      state.alerts.splice(idx, 1);
    },
  },
  actions: {
    async add(
      context,
      { text, timeout = null, closeable = false, importance = "info" }
    ) {
      context.commit("add", { text, timeout, closeable, importance });
      let id = context.state.ai;
      if (timeout != null) {
        setTimeout(() => {
          context.dispatch("remove", id);
        }, timeout);
      }
    },
    async remove({ commit }, id) {
      commit("remove", id);
    },
  },
});
