const savingsRoutes = [
  {
    path: "/savings",
    name: "Savings",
    component: () => import("@/pages/Savings/Index.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/savings/create",
    name: "CreateSaving",
    component: () => import("@/pages/Savings/Create.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/Savings/edit/:id",
    name: "EditSaving",
    component: () => import("@/pages/Transactions/Edit.vue"),
    meta: {
      auth: true,
    },
  },
];

export default savingsRoutes;