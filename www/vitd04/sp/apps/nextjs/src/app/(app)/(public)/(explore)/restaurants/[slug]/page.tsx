import { Container } from "@/components/common/Container";
import { Tabs } from "@/components/common/tabs/Tabs";
import { api } from "@/lib/api";
import { getCookie } from "@/utils/getCookie";
import { StarIcon } from "@heroicons/react/24/solid";
import React from "react";
import { MenuView } from "./MenuView";
import { notFound } from "next/navigation";
import { RestaurantActions } from "./RestaurantActions";
import { getUser } from "@/services/user";
import { Button } from "@/components/common/Button";
import { User } from "@/types/user";
import { Rating } from "@/types/rating";
import { AddRatingModal } from "./AddRatingModal";
import AddRatingButton from "./AddRatingButton";

type Props = {
  params: {
    slug: string;
  };
};

async function RestaurantDetail({ params }: Props) {
  const user = await getUser();
  const restaurant = await api.restaurants.getDetail.useServerQuery(
    {
      slug: params.slug,
    },
    getCookie()
  );

  let rating: Rating | null = null;
  try {
    rating = await api.ratings.get.useServerQuery(
      {
        restaurant_id: restaurant.id,
      },
      getCookie()
    );
  } catch (e) {
    console.log(e);
  }

  return (
    <Container>
      <div className="grid grid-cols-12 gap-6 py-6">
        {/* Thumbnail */}
        <div className="w-full h-56 bg-gray-100 rounded-lg col-span-12 relative">
          <img
            src={restaurant?.thumbnail?.path}
            alt="blog"
            className="object-cover w-full h-full rounded-lg"
          />
        </div>

        {/* Content */}
        <div className="col-span-12 md:col-span-9">
          {/* Title */}
          <div className="flex justify-between items-center">
            <h1 className="text-2xl font-semibold">{restaurant?.name}</h1>
            <div className="space-x-3 flex">
              {user && (
                <AddRatingButton
                  existingRating={rating}
                  restaurantId={restaurant?.id}
                />
              )}
              {user?.id === restaurant.user_id && (
                <RestaurantActions slug={restaurant.slug} />
              )}
            </div>
          </div>
          {/* Rating */}
          {restaurant.ratings_count > 0 ? (
            <span className="mt-2 flex items-center space-x-2">
              <StarIcon className="w-4 h-4 text-green-400" />
              <span>
                {Math.round(restaurant?.ratings_avg_rating * 10) / 10}{" "}
                <span className="text-gray-500">
                  ({restaurant.ratings_count})
                </span>
              </span>
            </span>
          ) : (
            <span className="mt-2 text-gray-500 text-ellipsis whitespace-nowrap">
              Bez hodnocení
            </span>
          )}
          {/* Menu View */}
          <MenuView menuSections={restaurant?.menu_sections || []} />
        </div>
      </div>
    </Container>
  );
}

export default RestaurantDetail;
