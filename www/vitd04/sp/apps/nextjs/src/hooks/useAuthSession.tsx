"use client";

import { AuthSessionContext } from "@/components/auth/AuthSessionContext";
import { User } from "@/types/user";
import { createContext, useContext } from "react";

export const useAuthSession = () => {
  const context = useContext(AuthSessionContext);
  return context;
};
