import { ExploreHeaderBar } from "@/app/(app)/(explore)/ExploreHeaderBar";
import { Header } from "@/app/Header";

export default function AuthLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <>
      <ExploreHeaderBar />
      {children}
    </>
  );
}
