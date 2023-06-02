"use client";
import { Tabs } from "@/components/common/tabs/Tabs";
import { MenuSection, MenuSectionWithRelations } from "@/types/menuSection";
import React, { useState } from "react";
import { MenuSectionView } from "./MenuSection";

type Props = {
  menuSections: MenuSectionWithRelations[];
};

export function MenuView({ menuSections }: Props) {
  const [selectedIndex, setSelectedIndex] = useState(-1);
  const handleOnTabChange = (index: number) => {
    const element = document.getElementById("section-" + index);
    // Scroll to element smoothly
    element?.scrollIntoView({ behavior: "smooth" });
  };

  return (
    <div className="mt-6">
      <div className="w-full sticky top-16 z-10 bg-white">
        <Tabs onTabChange={handleOnTabChange} selectedIndex={selectedIndex}>
          {menuSections
            .filter((c) => c.menu_items.length > 0)
            .map((menuSection, index) => (
              <Tabs.Tab key={index} index={index}>
                {menuSection.name}
              </Tabs.Tab>
            ))}
        </Tabs>
      </div>
      {menuSections.map((menuSection, index) => (
        <MenuSectionView index={index} key={index} menuSection={menuSection} />
      ))}
    </div>
  );
}
