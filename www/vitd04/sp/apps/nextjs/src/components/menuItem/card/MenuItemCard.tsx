import { MenuItem, MenuItemWithRelations } from "@/types/menuItem";
import React from "react";
import { MenuItemCardActions } from "./MenuItemCardActions";
import MenuItemAddToCalculatorButton from "./MenuItemAddToCalculatorButton";

type Props = {
  menuItem: MenuItemWithRelations;
  children?: React.ReactNode;
};

export function MenuItemCard({ menuItem, children }: Props) {
  return (
    <div className="flex flex-col-reverse md:flex-row">
      <div className="flex-1">
        <h3 className="font-semibold">{menuItem.name}</h3>
        <p className="text-gray-600 mt-2">{menuItem.description}</p>
        <div className="mt-3 text-sm text-gray-700">
          {menuItem.kcal} kcal ({menuItem.amount_in_grams} g)
        </div>
        {children && <div className="mt-2 relative">{children}</div>}
      </div>
      <div className="mb-6 md:mb-0 w-full md:w-48 aspect-video rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
        <img
          src={menuItem.thumbnail.path}
          alt="Beef burger"
          className="object-cover w-full h-full"
        />
      </div>
    </div>
  );
}

MenuItemCard.Actions = MenuItemCardActions;
MenuItemCard.AddToCalculatorButton = MenuItemAddToCalculatorButton;
