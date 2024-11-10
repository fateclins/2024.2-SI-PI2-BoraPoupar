import { defineStore } from "pinia";
import { Preferences } from "@capacitor/preferences";
import api from "@/services/http";
import { getToken } from "@/utils/getToken";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: {},
    monthIncome: 0,
    monthExpense: 0,
    showBalance: false,
  }),

  actions: {
    async getUser() {
      const { value } = await Preferences.get({ key: "user" });

      this.user = JSON.parse(value);
    },

    async toggleShowBalance() {
      let { value } = await Preferences.get({ key: "showBalance" });

      value = JSON.parse(value);

      value = !value;

      await Preferences.set({
        key: "showBalance",
        value: JSON.stringify(value),
      });

      this.showBalance = value;
    },

    async getShowBalance() {
      const { value } = await Preferences.get({ key: "showBalance" });

      this.showBalance = JSON.parse(value);
    },

    async getMonthResume() {
      const token = await getToken();

      try {
        const response = await api.get("transactions/monthly", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.monthIncome = response.data.incomes;
        this.monthExpense = response.data.expenses;

        return response.data;

      } catch (error) {
        console.error(error);
      }
    }
  },

  getters: {
    firstName() {
      return this.user.name.split(" ")[0];
    },

    balance() {
      return this.user.balance
    },
  },
});
