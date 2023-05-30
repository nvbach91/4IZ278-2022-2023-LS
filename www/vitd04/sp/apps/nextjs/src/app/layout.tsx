import { ToastContainer } from "@/components/common/toast/ToastContainer";
import "./globals.css";
import { Inter } from "next/font/google";
import "react-toastify/dist/ReactToastify.css";
import { ClerkProvider } from "@clerk/nextjs";
import { ReactQueryProviders } from "@/lib/reactQuery";
import { AuthSessionContextProvider } from "@/components/auth/AuthSessionContext";
import { getUser } from "@/services/user";

const inter = Inter({ subsets: ["latin"] });

export const metadata = {
  title: "Kam za jídlem",
  description: "Najděte restaurace s kaloriemi v jídelním lístku",
};

export default async function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const user = await getUser();
  return (
    <ReactQueryProviders>
      <AuthSessionContextProvider user={user}>
        <html lang="en" className="h-full bg-white">
          <body className={"h-full " + inter.className}>
            {children}
            <ToastContainer />
          </body>
        </html>
      </AuthSessionContextProvider>
    </ReactQueryProviders>
  );
}
