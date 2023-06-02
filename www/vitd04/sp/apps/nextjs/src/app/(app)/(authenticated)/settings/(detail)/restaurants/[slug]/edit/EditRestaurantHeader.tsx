"use client";
import { Button } from "@/components/common/Button";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";

type Props = {
  isSaving: boolean;
};

export function EditRestaurantHeader({ isSaving }: Props) {
  return (
    <PageHeader>
      <PageHeader.BackButton />
      <PageHeader.Title title="Upravit stránku" subtitle="McDonalds Chodov" />
      <Button title="Uložit" type="submit" loading={isSaving} />
    </PageHeader>
  );
}
