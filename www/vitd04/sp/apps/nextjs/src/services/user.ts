import { api } from "@/lib/api";
import { getCookie } from "@/utils/getCookie";

export async function getUser() {
  try {
    const res = await api.auth.user.useServerQuery({}, getCookie());
    return res;
  } catch (error: any) {
    if (error?.code === 401) {
      return null;
    } else {
      throw error;
    }
  }
}
