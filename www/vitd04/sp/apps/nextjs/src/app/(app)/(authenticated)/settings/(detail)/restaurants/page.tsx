import { Button } from "@/components/common/Button";
import { Container } from "@/components/common/Container";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import { PlusIcon } from "@heroicons/react/24/outline";
import React from "react";
import { SettingsRestaurantsHeader } from "./SettingsRestaurantsHeader";
import { api } from "@/lib/api";
import { getCookie } from "@/utils/getCookie";
import { SettingsRestaurantCard } from "./SettingsRestaurantCard";

type Props = {};

async function Restaurants({}: Props) {
  const restaurants = await api.restaurants.my.useServerQuery({}, getCookie());

  return (
    <>
      <SettingsRestaurantsHeader />
      <Container paddingClassName="mt-6 px-3">
        <div className="flex flex-col space-y-3">
          {restaurants &&
            restaurants.map((restaurant, index) => (
              <SettingsRestaurantCard
                key={restaurant.id}
                restaurant={restaurant}
                index={index}
              />
            ))}
        </div>
      </Container>
    </>
  );
}

export default Restaurants;
