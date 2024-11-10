import { createRouter, createWebHistory } from "@ionic/vue-router";
import HomePage from "@/pages/Home.vue";
import Index from "@/pages/Auth/Index.vue";
import Register from "@/pages/Auth/Register.vue";
import authMiddleware from "@/middlewares/auth";

const routes = [
  {
    path: "/",
    redirect: "/home",
    meta: {
      auth: true,
    },
  },
  {
    path: "/home",
    name: "Home",
    component: HomePage,
    meta: {
      auth: true,
    },
  },
  {
    path: "/transactions",
    name: "Transactions",
    component: () => import("@/pages/Transactions.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/message/:id",
    component: () => import("@/pages/ViewMessage.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/auth",
    component: Index,
  },
  {
    path: "/auth/register",
    component: Register,
  },
  {
    path: "/auth/login",
    component: () => import("@/pages/Auth/Login.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach(
  async (to, from, next) => await authMiddleware(to, from, next)
);

export default router;
