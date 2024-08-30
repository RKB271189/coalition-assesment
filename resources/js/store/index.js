import { createStore } from "vuex";
import Task from "./task";
const store = createStore({
    modules: {
        Task,
    },
    plugins: [],
});
export default store;
