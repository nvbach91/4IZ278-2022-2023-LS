import { Restaurant, RestaurantWithRelations } from "@/types/restaurant";
import { User } from "@/types/user";
import { createMutation, createQuery } from "./queryBuilders";
import { MenuSection } from "@/types/menuSection";
import { Asset } from "@/types/asset";
import { MenuItem } from "@/types/menuItem";
import { Paginated } from "@/types/pagination";
import { Rating } from "@/types/rating";

export const api = {
  auth: {
    user: createQuery<{}, User>(["user"]),
    register: createMutation<
      {
        email: string;
        password: string;
        password_confirmation: string;
      },
      {
        email: string;
        id: number;
      }
    >("../register", "POST"),
    login: createMutation<
      {
        email: string;
        password: string;
        remember: boolean;
      },
      {
        email: string;
        id: number;
      }
    >("../login", "POST"),
    logout: createMutation<{}, {}>("../logout", "POST"),
  },
  restaurants: {
    search: createQuery<
      { lat: number; lng: number; page?: number; per_page?: number },
      Paginated<Restaurant>
    >(["restaurants/search"]),
    create: createMutation<
      {
        name: string;
      },
      Restaurant
    >("restaurants", "POST"),
    update: createMutation<
      {
        id: string;
        name: string;
        address: string;
        city: string;
        zip: string;
        thumbnail_id: string;
        lat: number;
        lng: number;
        visible: boolean;
      },
      Restaurant
    >("restaurants", "PUT"),
    my: createQuery<{}, Restaurant[]>(["restaurants"]),
    getDetail: createQuery<
      {
        slug: string;
      },
      RestaurantWithRelations
    >(["restaurants/detail", "slug"]),
  },

  menuSections: {
    create: createMutation<
      {
        name: string;
        restaurant_id: string;
      },
      MenuSection
    >("menu-sections", "POST"),
    delete: createMutation<
      {
        id: number;
      },
      {}
    >("menu-sections", "DELETE"),
  },

  assets: {
    getAll: createQuery<{}, Asset[]>(["assets"]),
    upload: createMutation<FormData, Asset>("assets/upload", "POST", {
      ignoreContentType: true,
      disableStringify: true,
    }),
  },

  menuItems: {
    create: createMutation<
      {
        name: string;
        description: string;
        kcal: number;
        protein: number;
        carbs: number;
        fat: number;
        amount_in_grams: number;
        menu_section_id: number;
        thumbnail_id?: string;
        visible: boolean;
      },
      MenuItem
    >("menu-items", "POST"),
    delete: createMutation<
      {
        id: number;
      },
      {}
    >("menu-items", "DELETE"),
  },
  ratings: {
    get: createQuery<
      {
        restaurant_id: string;
      },
      Rating
    >(["ratings"]),
    create: createMutation<
      {
        rating: number;
        restaurant_id: string;
      },
      Rating
    >("ratings", "POST"),
  },
};
