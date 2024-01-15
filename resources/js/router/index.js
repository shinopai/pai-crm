import { createRouter, createWebHistory } from "vue-router";
import ItemIndex from "../Component/Item/Index.vue";
import ItemCreate from "../Component/Item/Create.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/items/",
            name: "item-index",
            component: ItemIndex,
        },
        {
            path: "/items/create",
            name: "item-create",
            component: ItemCreate,
        },
    ],
});

export default router;
