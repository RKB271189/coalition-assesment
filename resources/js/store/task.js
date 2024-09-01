import { commonInitialState, commonGetters, commonMutations } from "./common";
function initialState() {
    return {
        ...commonInitialState,
        projects: [],
        tasks: [],
        task: {},
    };
}
const getters = {
    ...commonGetters,
    projects: (state) => state.projects,
    tasks: (state) => state.tasks,
    task: (state) => state.task,
};
const actions = {
    async GET_PROJECT_DETAILS({ commit }) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.get("/api/projects");
            if (res.status === 200) {
                commit("SET_PROJECTS", res.data.projects);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
    async GET_TASK_DETAILS({ commit }) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.get("/api/tasks");
            if (res.status === 200) {
                commit("SET_TASKS", res.data.tasks);
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
    async GET_SINGLE_TASK({ commit }, params) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.get(`/api/tasks/${params.id}`);
            if (res.status === 200) {
                commit("SET_TASK", res.data.task);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
    async UPDATE_TASK({ commit }, params) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.put(`/api/tasks/${params.id}`, params);
            if (res.status === 200) {
                commit("SET_SUCCESS", res.data.message);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
    async DELETE_TASK({ commit }, params) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.delete(`/api/tasks/${params.id}`);
            if (res.status === 200) {
                commit("SET_SUCCESS", res.data.message);
            }
        } catch (error) {
            commit("SET_ERROR", error.response.data.error);
        }
    },
    async REORDER_TASK_PRIORITY({ commit }, params) {
        let res = await axios.post(`/api/tasks/reorder`, params);
        if (res.status === 200) {
            commit("SET_TASKS", res.data.tasks);
        }
    },
    async GET_TASK_DETAILS_BY_PROJECT({ commit }, params) {
        commit("RESET_RESPONSE_FLAG");
        try {
            let res = await axios.get(
                `/api/tasks/${params.project_id}/project`
            );
            if (res.status === 200) {
                commit("SET_TASKS", res.data.tasks);
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
    SET_TASKS(state, value) {
        state.tasks = value;
    },
    SET_TASK(state, value) {
        state.task = value;
    },
};
export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations,
};
