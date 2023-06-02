"use client";
import { Button } from "@/components/common/Button";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import { PlusIcon } from "@heroicons/react/24/outline";
import React from "react";
import { AddRestaurantModal } from "./AddRestaurantModal";

type Props = {};

export function SettingsRestaurantsHeader({}: Props) {
  const [addRestaurantVisible, setAddRestaurantVisible] = React.useState(false);
  const handleOnAddRestaurantClose = () => {
    setAddRestaurantVisible(false);
  };
  const handleOnOpenAddRestaurantModal = () => {
    setAddRestaurantVisible(true);
  };
  return (
    <>
      <PageHeader>
        <PageHeader.BackButton mobileOnly href="/settings" />
        <PageHeader.Title title="Restaurace" />
        <Button
          icon={PlusIcon}
          title="Přidat"
          onClick={handleOnOpenAddRestaurantModal}
        />
      </PageHeader>
      <AddRestaurantModal
        open={addRestaurantVisible}
        onClose={handleOnAddRestaurantClose}
        onSelected={handleOnAddRestaurantClose}
      />
    </>
  );
}
