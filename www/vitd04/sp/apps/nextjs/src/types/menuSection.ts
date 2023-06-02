import { MenuItem, MenuItemWithRelations } from "./menuItem";

export type MenuSection = {
  id: number;
  name: string;
  position: number;
  restaurant_id: number;
};

export type MenuSectionWithRelations = MenuSection & {
  menu_items: MenuItemWithRelations[];
};
