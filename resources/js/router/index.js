import { createRouter, createWebHistory } from "vue-router";
import ItemIndex from "../Component/Item/Index.vue";
import ItemCreate from "../Component/Item/Create.vue";
import ItemShow from "../Component/Item/Show.vue";
import ItemEdit from "../Component/Item/Edit.vue";
import CustomerIndex from "../Component/Customer/Index.vue";
import CustomerCreate from "../Component/Customer/Create.vue";
import CustomerShow from "../Component/Customer/Show.vue";
import CustomerEdit from "../Component/Customer/Edit.vue";

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
        {
            path: "/customers/",
            name: "customer-index",
            component: CustomerIndex,
        },
        {
            path: "/customers/create",
            name: "customer-create",
            component: CustomerCreate,
        },
        {
            path: "/customers/:id/show",
            name: "customer-show",
            component: CustomerShow,
        },
        {
            path: "/customers/:id/edit",
            name: "customer-edit",
            component: CustomerEdit,
        },
    ],
});

export default router;
