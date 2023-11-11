export default {
    namespaced: true,
    state: () => ({
        isLoading: false,
    }),
    mutations: {
        setLoading(state, val) {
            state.isLoading = val
        },
    },
}