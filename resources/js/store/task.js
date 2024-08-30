import { commonInitialState, commonGetters, commonMutations } from "./common";
function initialState() {
    return {
        ...commonInitialState,
        projects: [],
    };
}
const getters = {
    ...commonGetters,
    projects: (state) => state.projects,
};
const actions = {
    async GET_PROJECT_DETAILS({ commit }) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.get("/api/projects");
            if (res.status === 200) {
                console.log(res.data.projects);
                commit("SET_PROJECTS", res.data.projects);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
    async CREATE_TASK({ commit }, params) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.post(`/api/tasks`, params);
            if (res.status === 200) {
                commit("SET_SUCCESS", res.data.message);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
};
const mutations = {
    ...commonMutations,
    SET_PROJECTS(state, value) {
        state.projects = value;
    },
};
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations,
};
