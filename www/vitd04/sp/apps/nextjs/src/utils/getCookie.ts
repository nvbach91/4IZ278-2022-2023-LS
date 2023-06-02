import { headers } from "next/headers";

export const getCookie = () => {
  const headersList = headers();
  return headersList.get("cookie") || "";
};
