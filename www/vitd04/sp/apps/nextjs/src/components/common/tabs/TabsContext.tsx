"use client";
import { createContext, useContext } from "react";

export const TabsContext = createContext<{
  selectedIndex?: number;
  onTabChange: (index: number) => void;
} | null>(null);

export function useTabsContext() {
  const context = useContext(TabsContext);
  if (!context) {
    throw new Error(
      "Tabs.* component must be rendered as child of Modal component."
    );
  }
  return context;
}
