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

// ロケール設定
dayjs.locale("ja");

import App from "./Component/Item/Index.vue";

const app = createApp(App);

// dayjsをprovideに設定する
app.provide("dayjs", dayjs);

app.mount("#crm_item");
