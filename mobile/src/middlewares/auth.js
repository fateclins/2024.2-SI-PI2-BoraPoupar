import { useUserStore } from "@/stores/UserStore";
import { useAuthStore } from "@/stores/AuthStore";

export default async function authMiddleware(to, from, next) {
  const authStore = useAuthStore();
  const userStore = useUserStore();

  if (to.meta?.auth) {
    await authStore.verify();

    if (authStore.isAuthenticated) {
      await userStore.getUser();
      await userStore.getShowBalance();
      next();
    } 
    
    else {
      next({ path: "/auth/" });
    }

  } 
  
  else if (to.meta?.auth === false) {
    await authStore.verify();

    if (authStore.isAuthenticated) {
      next({ path: "/" });
    } 
    
    else {
      await userStore.getUser();
      await userStore.getShowBalance();
      next();
    }
  } 
  
  else {
    next();
  }
}
