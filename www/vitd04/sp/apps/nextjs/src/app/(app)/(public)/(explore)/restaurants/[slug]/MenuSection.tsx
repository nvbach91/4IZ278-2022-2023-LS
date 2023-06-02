import { MenuItemCard } from "@/components/menuItem/card/MenuItemCard";
import { MenuSection, MenuSectionWithRelations } from "@/types/menuSection";
import React from "react";

type Props = {
  menuSection: MenuSectionWithRelations;
  index: number;
};

export function MenuSectionView({ menuSection, index }: Props) {
  if (!menuSection.menu_items.length) return null;
  return (
    <div id={"section-" + index} className="scroll-mt-32">
      <h2 className="font-semibold text-2xl mt-12 mb-4">{menuSection.name}</h2>
      <div className="grid lg:grid-cols-2 grid-cols-1 gap-8">
        {menuSection.menu_items.map((menuItem) => (
          <MenuItemCard key={menuItem.id} menuItem={menuItem}>
            <MenuItemCard.AddToCalculatorButton menuItem={menuItem} />
          </MenuItemCard>
        ))}
      </div>
    </div>
  );
}
