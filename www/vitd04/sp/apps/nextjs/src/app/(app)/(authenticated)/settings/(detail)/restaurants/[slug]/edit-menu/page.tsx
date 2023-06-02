import { Container } from "@/components/common/Container";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";
import { EditMenuHeader } from "./EditMenuHeader";
import { getCookie } from "@/utils/getCookie";
import { api } from "@/lib/api";
import { MenuEditor } from "./MenuEditor";
import { notFound } from "next/navigation";

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

  if (!restaurant) {
    return notFound();
  }

  return (
    <>
      <EditMenuHeader />
      <Container paddingClassName="mt-6 px-4 flex-1">
        <MenuEditor restaurant={restaurant} />
      </Container>
    </>
  );
}

export default SettingsRestaurantEditMenu;
