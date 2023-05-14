import React from "react";
import Image from "next/image";

type Props = {};

export function RestaurantCard({}: Props) {
  return (
    <a href="#" className="group w-full shadow-lg bg-white rounded-lg">
      <div className="overflow-hidden rounded-t-lg flex items-center justify-center aspect-[296/155] relative">
        <Image
          src="/images/test-restaurant.jpg"
          alt="test-restaurant"
          fill={true}
          className="group-hover:scale-110 transition-all duration-100 ease-in-out object-cover"
        />
      </div>
      <span className="py-3 px-4 block">
        <span className="flex justify-between items-end">
          <span className="font-semibold">Tom&apos;s Burger</span>
          <span className="text-sm text-gray-400">$$$ - Italská</span>
        </span>
      </span>
    </a>
  );
}
