import { defineStore } from "pinia";
import { Preferences } from "@capacitor/preferences";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: {},
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
