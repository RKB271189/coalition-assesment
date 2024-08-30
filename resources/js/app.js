import "./bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import App from "../../resources/js/views/App.vue";

import { createApp } from "vue";
import store from "./store";
import router from "./router";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);
app.use(store);
app.use(router);
app.use(Toast);
app.mount("#app");
