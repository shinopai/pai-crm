import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// vue setting
import { createApp } from "vue";

import App from "./Component/Item/Index.vue";

const app = createApp(App);

app.mount("#crm_item");
