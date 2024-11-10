const authRoutes = [
  {
    path: "/auth",
    component: () => import("@/pages/Auth/Index.vue"),
  },
  {
    path: "/auth/register",
    component: () => import("@/pages/Auth/Register.vue"),
  },
  {
    path: "/auth/login",
    component: () => import("@/pages/Auth/Login.vue"),
  },
];

export default authRoutes;