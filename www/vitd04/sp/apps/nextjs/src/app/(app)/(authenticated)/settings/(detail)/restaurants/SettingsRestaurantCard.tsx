import { RestaurantActions } from "@/app/(app)/(public)/(explore)/restaurants/[slug]/RestaurantActions";
import { Restaurant } from "@/types/restaurant";
import Link from "next/link";
import React from "react";

type Props = {
  restaurant: Restaurant;
  index: number;
};

export function SettingsRestaurantCard({ restaurant, index }: Props) {
  return (
    <Link
      href={"/restaurants/" + restaurant.slug}
      className="bg-white px-4 py-3 w-full rounded-md flex items-baseline space-x-3 hover:bg-gray-50/50 border border-gray-100"
      style={{
        zIndex: 100 - index,
      }}
    >
      <span className="font-semibold text-gray-900">{restaurant.name}</span>
      <span className="text-gray-600">
        {restaurant.address && restaurant.city
          ? restaurant.address + ", " + restaurant.city
          : "Nemá zadanou adresu"}
      </span>
      <span className="flex-1"></span>
      <RestaurantActions slug={restaurant.slug} />
    </Link>
  );
}
