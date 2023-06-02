"use client";
import { User } from "@/types/user";
import { createContext } from "react";

export const AuthSessionContext = createContext<User | null>(null);

export type AuthSessionContextProviderProps = {
  children: React.ReactNode;
  user: User | null;
};
export function AuthSessionContextProvider({
  children,
  user,
}: AuthSessionContextProviderProps) {
  return (
    <AuthSessionContext.Provider value={user}>
      {children}
    </AuthSessionContext.Provider>
  );
}
