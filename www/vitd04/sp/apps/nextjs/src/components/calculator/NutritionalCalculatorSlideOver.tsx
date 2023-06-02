"use client";
import React from "react";
import { SlideOver } from "../common/slide-over/SlideOver";
import { useNutritionalCalculatorContext } from "./CalculatorContext";
import { MenuItemCard } from "../menuItem/card/MenuItemCard";
import { Button } from "../common/Button";
import { XMarkIcon } from "@heroicons/react/24/outline";

export function NutritionalCalculatorSlideOver() {
  const { isOpen, close, menuItems } = useNutritionalCalculatorContext();
  const { deleteMenuItem } = useNutritionalCalculatorContext();
  const sumOfCalories = menuItems.reduce((acc, item) => acc + item.kcal, 0);
  return (
    <SlideOver open={isOpen} onClose={close} title="Nutriční kalkulačka">
      {menuItems.length === 0 ? (
        <div className="px-12 py-10 flex flex-col space-y-3 items-center justify-center rounded-lg border border-gray-200">
          <h2 className="text-xl font-semibold text-center">
            Zatím nemtáte v kalkulačce žádné položky
          </h2>
        </div>
      ) : (
        <div className="flex flex-col space-y-12">
          <div className="w-full flex justify-between border-b border-gray-200 pb-5">
            <span className="text-gray-500">Celkem</span>
            <span className="text-2xl font-semibold">{sumOfCalories} kcal</span>
          </div>
          {menuItems.map((item) => (
            <MenuItemCard key={item.id} menuItem={item}>
              <Button
                look="secondary"
                title="Odebrat"
                icon={XMarkIcon}
                onClick={() => deleteMenuItem(item)}
              />
            </MenuItemCard>
          ))}
        </div>
      )}
    </SlideOver>
  );
}
