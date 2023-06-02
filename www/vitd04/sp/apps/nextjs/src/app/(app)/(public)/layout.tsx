import { Header } from "@/app/Header";

export default function AuthLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <>
      <div className="min-h-full">
        <Header />
        <main>{children}</main>
      </div>
    </>
  );
}
