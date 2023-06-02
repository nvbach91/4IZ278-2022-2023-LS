import { Asset } from "./asset";

export type MenuItem = {
  id: number;
  name: string;
  description: string;
  kcal: number;
  protein: number;
  carbs: number;
  fat: number;
  amount_in_grams: number;
  position: number;
  menu_section_id: number;
  thumbnail_id: string;
};

export type MenuItemWithRelations = MenuItem & {
  thumbnail: Asset;
};
