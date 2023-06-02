import React from "react";
import Image from "next/image";
import { Restaurant } from "@/types/restaurant";
import Link from "next/link";
import { StarIcon } from "@heroicons/react/24/solid";

export function RestaurantCardSkeleton() {
  return (
    <div className="group w-full shadow-lg bg-white rounded-lg">
      <div className="overflow-hidden rounded-t-lg flex items-center justify-center aspect-[296/155] relative bg-gray-200"></div>
      <span className="py-3 px-4 block">
        <span className="flex justify-between items-start">
          <span className="font-semibold h-5 w-12 bg-gray-300 rounded-full"></span>
          <span className="h-4 w-7 bg-gray-200 rounded-full"></span>
        </span>
      </span>
    </div>
  );
}
