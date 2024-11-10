const homeRoutes = [
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
    component: () => import("@/pages/Home.vue"),
    meta: {
      auth: true,
    },
  },
];

export default homeRoutes;