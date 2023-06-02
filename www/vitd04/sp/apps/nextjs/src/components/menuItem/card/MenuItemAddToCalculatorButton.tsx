import { useNutritionalCalculatorContext } from "@/components/calculator/CalculatorContext";
import { Button } from "@/components/common/Button";
import { MenuItem, MenuItemWithRelations } from "@/types/menuItem";
import React from "react";

type Props = {
  menuItem: MenuItemWithRelations;
};

function MenuItemAddToCalculatorButton({ menuItem }: Props) {
  const { addMenuItem } = useNutritionalCalculatorContext();
  return (
    <Button
      look="primary"
      onClick={() => addMenuItem(menuItem)}
      title="Přidat do kalkulačky"
    />
  );
}

export default MenuItemAddToCalculatorButton;
