import { getUser } from "@/services/user";
import { redirect } from "next/navigation";

export default async function AuthLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const user = await getUser();
  if (user) {
    return redirect("/");
  }
  return <>{children}</>;
}
