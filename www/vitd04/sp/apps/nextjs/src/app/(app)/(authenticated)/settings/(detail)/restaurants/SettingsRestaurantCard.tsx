import { Restaurant } from "@/types/restaurant";
import Link from "next/link";
import React from "react";

type Props = {
  restaurant: Restaurant;
};

export function SettingsRestaurantCard({ restaurant }: Props) {
  return (
    <Link
      href={"/restaurants/" + restaurant.slug}
      className="bg-gray-50 px-4 py-3 w-full rounded-md flex items-baseline space-x-3 hover:bg-gray-100"
    >
      <span className="font-semibold text-gray-900">{restaurant.name}</span>
      <span className="text-gray-600">
        {restaurant.address && restaurant.city
          ? restaurant.address + ", " + restaurant.city
          : "Nemá zadanou adresu"}
      </span>
    </Link>
  );
}
