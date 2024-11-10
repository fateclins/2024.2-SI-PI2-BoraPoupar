const transactionRoutes = [
  {
    path: "/transactions",
    name: "Transactions",
    component: () => import("@/pages/Transactions/Index.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/transactions/create",
    name: "CreateTransaction",
    component: () => import("@/pages/Transactions/Create.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/transactions/edit/:id",
    name: "EditTransaction",
    component: () => import("@/pages/Transactions/Edit.vue"),
    meta: {
      auth: true,
    },
  },
];

export default transactionRoutes;