import React from "react";
import Image from "next/image";
import { Restaurant } from "@/types/restaurant";
import Link from "next/link";
import { StarIcon } from "@heroicons/react/24/solid";

type Props = {
  restaurant: Restaurant;
};

export function RestaurantCard({ restaurant }: Props) {
  return (
    <Link
      href={"/restaurants/" + restaurant.slug}
      className="group w-full shadow-lg bg-white rounded-lg"
    >
      <div className="overflow-hidden rounded-t-lg flex items-center justify-center aspect-[296/155] relative">
        <img
          src={restaurant.thumbnail?.path || ""}
          alt={restaurant.name}
          // fill={true}
          className="group-hover:scale-110 transition-all duration-100 ease-in-out object-cover object-cover w-full h-full"
        />
      </div>
      <span className="py-3 px-4 block">
        <span className="flex justify-between items-start">
          <span className="font-semibold">{restaurant.name}</span>
          {restaurant.ratings_count > 0 ? (
            <span className="flex items-center space-x-2">
              <StarIcon className="w-4 h-4 text-green-400" />
              <span>
                {Math.round(restaurant?.ratings_avg_rating * 10) / 10}{" "}
                <span className="text-gray-500">
                  ({restaurant.ratings_count})
                </span>
              </span>
            </span>
          ) : (
            <span className="text-gray-500 text-ellipsis whitespace-nowrap">
              Bez hodnocení
            </span>
          )}
          {/* <span className="text-sm text-gray-400">$$$ - Italská</span> */}
        </span>
      </span>
    </Link>
  );
}
