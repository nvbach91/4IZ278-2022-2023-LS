import { Container } from "@/components/common/Container";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";
import { EditRestaurantHeader } from "./EditRestaurantHeader";
import { getCookie } from "@/utils/getCookie";
import { api } from "@/lib/api";
import { PhotoIcon, UserCircleIcon } from "@heroicons/react/24/outline";
import { RestaurantEditor } from "./RestaurantEditor";

type Props = {
  params: {
    slug: string;
  };
};

async function SettingsRestaurantEditMenu({ params }: Props) {
  const restaurant = await api.restaurants.getDetail.useServerQuery(
    {
      slug: params.slug,
    },
    getCookie()
  );
  return (
    <>
      <RestaurantEditor restaurant={restaurant} />
    </>
  );
}

export default SettingsRestaurantEditMenu;
