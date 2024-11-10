import { Preferences } from '@capacitor/preferences';

export default async function setCredentialsInStorage(response) {
  await Preferences.set({ key: "token", value: response.data.token });
  await Preferences.set({
    key: "user",
    value: JSON.stringify(response.data.user),
  });
}
