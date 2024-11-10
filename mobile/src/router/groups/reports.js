const reportsRoutes = [
  {
    path: "/reports",
    name: "Reports",
    component: () => import("@/pages/Reports.vue"),
    meta: {
      auth: true,
    },
  },
];

export default reportsRoutes;