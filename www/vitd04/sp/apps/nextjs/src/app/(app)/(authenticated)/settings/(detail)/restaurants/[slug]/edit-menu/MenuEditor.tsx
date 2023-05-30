"use client";
import { Button } from "@/components/common/Button";
import { Tabs } from "@/components/common/tabs/Tabs";
import { MenuSection } from "@/types/menuSection";
import { PlusCircleIcon, PlusIcon } from "@heroicons/react/24/outline";
import React, { useState } from "react";
import { AddMenuSectionModal } from "./AddMenuSectionModal";
import { RestaurantWithRelations } from "@/types/restaurant";
import { Container } from "@/components/common/Container";
import { MenuItemCard } from "@/components/menuItem/card/MenuItemCard";
import { AddMenuItemModal } from "./AddMenuItemModal";
import { NoSectionEmptyState } from "./NoSectionEmptyState";
import { NoMenuItemsEmptyState } from "./NoMenuItemsEmptyState";
import { api } from "@/lib/api";
import { toast } from "react-toastify";
import { useRouter } from "next/navigation";
import { EllipsisVerticalIcon } from "@heroicons/react/24/solid";

type Props = {
  restaurant: RestaurantWithRelations;
};

export function MenuEditor({ restaurant }: Props) {
  const { menu_sections } = restaurant;
  console.log(menu_sections);
  const [selectedIndex, setSelectedIndex] = useState(0);
  const handleOnTabChange = (index: number) => {
    setSelectedIndex(index);
  };

  const selectedSection = menu_sections[selectedIndex];

  // Add section
  const [isAddSectionModalOpen, setIsAddSectionModalOpen] = useState(false);
  const handleAddSection = () => {
    console.log("add section");
    setIsAddSectionModalOpen(true);
  };

  const handleCloseAddSectionModal = () => {
    setIsAddSectionModalOpen(false);
  };

  const handleOnSectionAdded = () => {
    setIsAddSectionModalOpen(false);
  };

  // Add item
  const [isAddItemModalOpen, setIsAddItemModalOpen] = useState(false);
  const handleAddItem = () => {
    setIsAddItemModalOpen(true);
  };

  const handleCloseAddItemModal = () => {
    setIsAddItemModalOpen(false);
  };

  const handleOnItemAdded = () => {
    setIsAddItemModalOpen(false);
  };

  // Delete item
  const { mutateAsync: deleteItem } = api.menuItems.delete.useMutation({
    onSuccess: () => {
      toast.success("Položka byla smazána");
    },
    onError: () => {
      toast.error("Nepodařilo se smazat položku");
    },
  });

  const router = useRouter();
  const handleDeleteItem = (menuItem: number) => {
    deleteItem({
      id: menuItem,
    });
    router.refresh();
  };

  // Delete section
  const { mutateAsync: deleteSection } = api.menuSections.delete.useMutation({
    onSuccess: () => {
      toast.success("Sekce byla smazána");
    },
    onError: () => {
      toast.error("Nepodařilo se smazat sekci");
    },
  });
  const handleDeleteSection = async (menuSection: number) => {
    const confirm = window.confirm(
      "Opravdu chcete smazat tuto sekci? Tato akce je nevratná."
    );
    if (confirm) {
      await deleteSection({
        id: menuSection,
      });
      setSelectedIndex(0);
      router.refresh();
    }

    console.log("delete section");
  };

  return (
    <>
      <div className="relative w-full">
        {!menu_sections || menu_sections.length === 0 ? (
          <NoSectionEmptyState onAddSection={handleAddSection} />
        ) : (
          <>
            <Tabs onTabChange={handleOnTabChange} selectedIndex={selectedIndex}>
              {menu_sections.map((menuSection, index) => (
                <Tabs.Tab key={index} index={index}>
                  <span className="flex space-x-2">
                    {menuSection.name}
                    <button onClick={() => handleDeleteSection(menuSection.id)}>
                      <EllipsisVerticalIcon className="w-5 h-5 text-gray-400" />
                    </button>
                  </span>
                </Tabs.Tab>
              ))}
              <Button
                title="Přidat&nbsp;sekci"
                onClick={handleAddSection}
                look="secondary"
                icon={PlusIcon}
              />
            </Tabs>
            {selectedSection.menu_items.length === 0 ? (
              <div className="mt-12">
                <NoMenuItemsEmptyState odAddMenuItem={handleAddItem} />
              </div>
            ) : (
              <div className="mt-12 grid lg:grid-cols-2 grid-cols-1 gap-8">
                {selectedSection.menu_items.map((menuItem) => (
                  <MenuItemCard key={menuItem.id} menuItem={menuItem}>
                    <MenuItemCard.Actions
                      onDelete={() => handleDeleteItem(menuItem.id)}
                    />
                  </MenuItemCard>
                ))}
                <div>
                  <button
                    onClick={handleAddItem}
                    className="p-8 h-full w-full rounded-lg flex flex-col justify-center items-center relative hover:bg-gray-100 bg-gray-50"
                  >
                    <PlusIcon className="h-5 w-5 text-gray-700 text-sm text-elipsis font-medium" />
                    <span className="text-gray-700 text-sm text-elipsis font-medium">
                      Přidat položku
                    </span>
                  </button>
                </div>
              </div>
            )}
          </>
        )}
      </div>
      <AddMenuSectionModal
        restaurantId={restaurant.id}
        open={isAddSectionModalOpen}
        onClose={handleCloseAddSectionModal}
        onAdded={handleOnSectionAdded}
      />
      <AddMenuItemModal
        sectionId={menu_sections[selectedIndex]?.id}
        open={isAddItemModalOpen}
        onClose={handleCloseAddItemModal}
        onAdded={handleOnItemAdded}
      />
    </>
  );
}
