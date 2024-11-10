import { defineStore } from "pinia";
import api from "@/services/http";
import { getToken } from "@/utils/getToken";

export const useTransactionStore = defineStore("transaction", {
  state: () => ({
    transactions: [],
    categories: [],
  }),

  actions: {
    async getCategories(type) {
      const token = await getToken();

      try {
        const url = type ? `transactions/categories?type=${type}` : "transactions/categories";
        const response = await api.get(url, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.categories = response.data;

        return response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },
});
