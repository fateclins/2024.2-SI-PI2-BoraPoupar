import { defineStore } from "pinia";
import api from "@/services/http";
import { Preferences } from "@capacitor/preferences";
import setCredentialsInStorage from "@/utils/setCredentialsInStorage";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    isAuthenticated: false,
  }),

  actions: {
    async register(form) {
      if (!form.name || !form.email || !form.password) {
        throw new Error("Todos os campos são obrigatórios");
      }

      if (form.password.length < 6) {
        throw new Error("A senha deve ter no mínimo 6 caracteres");
      }

      try {
        const response = await api.post("auth/register", {
          name: form.name,
          email: form.email,
          password: form.password,
        });

        if (response.status === 201) {
          await setCredentialsInStorage(response);

          return true;
        }

        throw new Error("Houve um erro ao registrar sua conta");
      } catch (error) {
        if (error.response) {
          // O servidor respondeu com um status diferente de 2xx

          throw new Error(error.response.data.message);
        } else if (error.request) {
          // A requisição foi feita, mas nenhuma resposta foi recebida
          throw new Error("Erro ao registrar sua conta");
        } else {
          // Algo aconteceu ao configurar a requisição
          throw new Error("Erro ao registrar sua conta");
        }
      }
    },

    async verify() {
      const { value } = await Preferences.get({ key: "token" });

      try {
        const response = await api.get("auth/verify", {
          headers: {
            Authorization: `Bearer ${value}`,
          },
        });

        if (response.status === 200) {
          await Preferences.set({
            key: "user",
            value: JSON.stringify(response.data.user),
          });
          this.isAuthenticated = true;
          return;
        }

        if (response.status === 401) {
          await Preferences.remove({ key: "token" });
          this.isAuthenticated = false;
          return;
        }

        this.isAuthenticated = false;
        throw new Error("Houve um erro ao verificar sua conta");
      } catch (error) {
        this.isAuthenticated = false;
        await Preferences.remove({ key: "token" });
        return;
      }
    },

    async login(form) {
      if (!form.email || !form.password) {
        throw new Error("Todos os campos são obrigatórios.");
      }

      if (!form.email.includes("@")) {
        throw new Error("Esse email não parece válido 👀");
      }

      if (form.password.length < 6) {
        throw new Error("A sua senha tinha no mínimo 6 caracteres, lembra? 🤔");
      }

      try {
        const response = await api.post("auth/login", {
          email: form.email,
          password: form.password,
        });

        if (response.status === 200) {
          await setCredentialsInStorage(response);
          return;
        }

        throw new Error("Houve um erro ao fazer login");
      } catch (error) {
        if (error.response) {
          // O servidor respondeu com um status diferente de 2xx
          if (error.response.status === 401) {
            throw new Error("Email ou senha inválidos");
          }
        } else if (error.request) {
          // A requisição foi feita, mas nenhuma resposta foi recebida
          throw new Error("Erro ao fazer login");
        } else {
          // Algo aconteceu ao configurar a requisição
          throw new Error("Erro ao fazer login");
        }
      }
    },
  },
});
