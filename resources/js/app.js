import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// vue setting
import { createApp } from "vue";
// dayjsのインポート
import dayjs from "dayjs";
// ロケールのインポート
import "dayjs/locale/ja";
// routerのインポート
import router from "./router/";

// ロケール設定
dayjs.locale("ja");

import App from "./Component/App.vue";

const app = createApp(App);

// dayjsをprovideに設定する
app.provide("dayjs", dayjs);

app.use(router).mount("#crm_app");
