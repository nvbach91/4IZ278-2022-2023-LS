"use client";
import React, { useEffect } from "react";
import { NutritionalCalculatorContext } from "./CalculatorContext";
import { MenuItem, MenuItemWithRelations } from "@/types/menuItem";
import { toast } from "react-toastify";

type Props = {
  children: React.ReactNode;
};

export function NutritionalCalculatorContextProvider({ children }: Props) {
  const [menuItems, setMenuItems] = React.useState<MenuItemWithRelations[]>(
    typeof window.localStorage !== "undefined"
      ? JSON.parse(window.localStorage.getItem("calculator_items") || "[]")
      : []
  );
  const handleAddMenuItem = (menuItem: MenuItemWithRelations) => {
    setMenuItems([...menuItems, menuItem]);
  };

  useEffect(() => {
    if (typeof window.localStorage !== "undefined") {
      window.localStorage.setItem(
        "calculator_items",
        JSON.stringify(menuItems)
      );
    }
  }, [menuItems]);

  const handleDeleteMenuItem = (menuItem: MenuItemWithRelations) => {
    setMenuItems(menuItems.filter((item) => item.id !== menuItem.id));
  };

  const [isOpen, setIsOpen] = React.useState(false);
  return (
    <NutritionalCalculatorContext.Provider
      value={{
        menuItems: menuItems,
        addMenuItem: handleAddMenuItem,
        deleteMenuItem: handleDeleteMenuItem,
        isOpen,
        open: () => setIsOpen(true),
        close: () => setIsOpen(false),
      }}
    >
      {children}
    </NutritionalCalculatorContext.Provider>
  );
}
