import { createRouter, createWebHistory } from "vue-router";
import ItemIndex from "../Component/Item/Index.vue";
import ItemCreate from "../Component/Item/Create.vue";
import ItemShow from "../Component/Item/Show.vue";
import ItemEdit from "../Component/Item/Edit.vue";
import CustomerIndex from "../Component/Customer/Index.vue";
import CustomerCreate from "../Component/Customer/Create.vue";
import PurchaseIndex from "../Component/Purchase/Index.vue";
import PurchaseCreate from "../Component/Purchase/Create.vue";
import PurchaseShow from "../Component/Purchase/Show.vue";
import PurchaseEdit from "../Component/Purchase/Edit.vue";

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
            path: "/purchases/",
            name: "purchase-index",
            component: PurchaseIndex,
        },
        {
            path: "/purchases/:id/show",
            name: "purchase-show",
            component: PurchaseShow,
        },
        {
            path: "/purchases/:item_id/create",
            name: "purchase-create",
            component: PurchaseCreate,
        },
        {
            path: "/purchases/:id/edit",
            name: "purchase-edit",
            component: PurchaseEdit,
        },
    ],
});

export default router;
