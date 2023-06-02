"use client";
import { MenuItemWithRelations } from "@/types/menuItem";
import { createContext, useContext } from "react";

export const NutritionalCalculatorContext = createContext<{
  menuItems: MenuItemWithRelations[];
  addMenuItem: (menuItem: MenuItemWithRelations) => void;
  deleteMenuItem: (menuItem: MenuItemWithRelations) => void;
  isOpen: boolean;
  open: () => void;
  close: () => void;
} | null>(null);

export function useNutritionalCalculatorContext() {
  const context = useContext(NutritionalCalculatorContext);
  if (!context) {
    throw new Error("Provider not initialized");
  }
  return context;
}
