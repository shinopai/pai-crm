import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// vue setting
import { createApp } from "vue";

import App from "./Component/App.vue";

const app = createApp(App);

app.mount("#crm_app");
