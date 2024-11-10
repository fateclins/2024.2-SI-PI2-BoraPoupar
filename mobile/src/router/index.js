import { createRouter, createWebHistory } from "@ionic/vue-router";
import authMiddleware from "@/middlewares/auth";
import authRoutes from "./groups/auth";
import transactionRoutes from "./groups/transactions";
import homeRoutes from "./groups/home";
import reportsRoutes from "./groups/reports";
import savingsRoutes from "./groups/savings";

const routes = [
  ...homeRoutes,
  ...authRoutes,
  ...transactionRoutes,
  ...reportsRoutes,
  ...savingsRoutes
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach(
  async (to, from, next) => await authMiddleware(to, from, next)
);

export default router;
