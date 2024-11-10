import { defineStore } from "pinia";
import api from "@/services/http";
import { getToken } from "@/utils/getToken";
import { useUserStore } from "@/stores/UserStore";

export const useSavingStore = defineStore("saving", {
  state: () => ({
    savings: [],
  }),

  actions: {

    async getSavings() {
      const token = await getToken();

      try {
        const response = await api.get("savings", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.savings = response.data;

        return response.data;
      }
      catch (error) {
        console.error(error);
      }
    },

    async createSaving(saving) {
      const token = await getToken();

      if(saving.amount === '' || saving.amount === null || saving.amount === undefined) {
        saving.amount = 0;
      }

      if (saving.name === '') {
        throw new Error("Preencha todos os campos obrigatórios 👀");
      }

      const body = {
        ...saving,
      };

      try {

        const response = await api.post("savings", body, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
    
        if(!response.status[0] !== 2) {
          this.savings.unshift(response.data);
          return response.data;
        }
    
        if (response.status === 401) {
          throw new Error("Sua sessão expirou");
        }

      } catch(error) {
        if (error.response && error.response.status === 422) {
          const errorMessage = error.response.data.message || "Erro de validação";
          throw new Error(errorMessage);
        } else {
          throw new Error(error.message);
        }
      }
    },

    async deleteSaving(savingId) {
      const token = await getToken();

      try {
        const response = await api.delete(`savings/${savingId}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.status === 200) {
          this.savings = this.savings.filter((saving) => saving.id !== savingId);
        }

        return response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },
});