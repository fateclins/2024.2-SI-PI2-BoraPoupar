import { Preferences } from "@capacitor/preferences";

export async function getToken() {
  const token = await Preferences.get({ key: "token" });

  return token.value;
}