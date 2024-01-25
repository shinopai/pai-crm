import { createRouter, createWebHistory } from "vue-router";
import ItemIndex from "../Component/Item/Index.vue";
import ItemCreate from "../Component/Item/Create.vue";
import ItemShow from "../Component/Item/Show.vue";
import ItemEdit from "../Component/Item/Edit.vue";

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
        {
            path: "/items/:id/show",
            name: "item-show",
            component: ItemShow,
        },
        {
            path: "/items/:id/edit",
            name: "item-edit",
            component: ItemEdit,
        },
    ],
});

export default router;
