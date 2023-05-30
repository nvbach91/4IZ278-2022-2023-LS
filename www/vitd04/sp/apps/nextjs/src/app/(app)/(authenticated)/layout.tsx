import { getUser } from "@/services/user";
import { redirect } from "next/navigation";
import { Header } from "@/app/Header";

export default async function AuthLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const user = await getUser();
  if (!user) {
    return redirect("/login");
  }

  return (
    <>
      <div className="min-h-full">
        <Header mobileHidden />
        <main>{children}</main>
      </div>
    </>
  );
}
