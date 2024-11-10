import { defineStore } from "pinia";
import api from "@/services/http";
import { getToken } from "@/utils/getToken";
import { useUserStore } from "@/stores/UserStore";

export const useTransactionStore = defineStore("transaction", {
  state: () => ({
    recentTransactions: [],
    transactions: [],
    categories: [],
  }),

  actions: {
    async getCategories(type) {
      const token = await getToken();

      try {
        const url = type
          ? `transactions/categories?type=${type}`
          : "transactions/categories";
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

    async createTransaction(transaction) {
      const token = await getToken();
      const userStore = useUserStore();
    
      if (!transaction.amount || !transaction.type || !transaction.name) {
        throw new Error("Preencha todos os campos obrigatórios 👀");
      }
    
      const body = {
        ...transaction,
        user_id: userStore.user.id,
      };
    
      try {
        const response = await api.post("transactions", body, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
    
        if(!response.status[0] !== 2) {
          this.transactions.unshift(response.data);
          return response.data;
        }
    
        if (response.status === 401) {
          throw new Error("Sua sessão expirou");
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          const errorMessage = error.response.data.message || "Erro de validação";
          throw new Error(errorMessage);
        } else {
          throw new Error(error.message);
        }
      }
    },

    async getTransactions() {
      const token = await getToken();

      try {
        const response = await api.get("transactions", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.transactions = response.data;

        return response.data;
      } catch (error) {
        console.error(error);
      }
    },

    async getTransaction(id) {
      const token = await getToken();

      try {
        const response = await api.get(`transactions/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        return response.data;
      } catch (error) {
        console.error(error);
      }
    },

    async updateTransaction(transaction) {
      const token = await getToken();
      const userStore = useUserStore();

      let body = {
        ...transaction,
        user_id: userStore.user.id,
      };

      try {
        const response = await api.put(`transactions/${transaction.id}`, body, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.status === 200) {
          const index = this.transactions.findIndex((t) => t.id === transaction.id);
          this.transactions[index] = response.data;
          return response.data;
        }

        if (response.status === 401) {
          throw new Error("Sua sessão expirou");
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          const errorMessage = error.response.data.message || "Erro de validação";
          throw new Error(errorMessage);
        } else {
          throw new Error(error.message);
        }
      }
    },

    async deleteTransaction(id) {
      const token = await getToken();

      try {
        const response = await api.delete(`transactions/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.status === 200) {
          this.transactions = this.transactions.filter((t) => t.id !== id);
          this.recentTransactions = this.recentTransactions.filter((t) => t.id !== id);
          return response.data;
        }

        if (response.status === 401) {
          throw new Error("Sua sessão expirou");
        }
      } catch (error) {
        console.error(error);
      }
    },

    async getRecentTransactions() {
      const token = await getToken();

      try {
        const response = await api.get("transactions/recent", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.recentTransactions = response.data;

        return response.data;
      } catch (error) {
        console.error(error);
      }
    }
  },
});
