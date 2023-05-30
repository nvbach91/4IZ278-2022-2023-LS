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
        {restaurants &&
          restaurants.map((restaurant) => (
            <SettingsRestaurantCard
              key={restaurant.id}
              restaurant={restaurant}
            />
          ))}
      </Container>
    </>
  );
}

export default Restaurants;
