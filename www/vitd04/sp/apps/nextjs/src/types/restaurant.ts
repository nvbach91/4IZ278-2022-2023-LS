import { Asset } from "./asset";
import { MenuSectionWithRelations } from "./menuSection";

export type Restaurant = {
  id: string;
  name: string;
  slug: string;
  location: {
    latitude: number;
    longitude: number;
  } | null;
  address: string | null;
  city: string | null;
  zip: string | null;
  thumbnail_id: string | null;
  user_id: number;
  visible: boolean;
  thumbnail: Asset | null;
  ratings_count: number;
  ratings_avg_rating: number;
};

export type RestaurantWithRelations = Restaurant & {
  menu_sections: MenuSectionWithRelations[];
  lat?: number;
  lng?: number;
};
