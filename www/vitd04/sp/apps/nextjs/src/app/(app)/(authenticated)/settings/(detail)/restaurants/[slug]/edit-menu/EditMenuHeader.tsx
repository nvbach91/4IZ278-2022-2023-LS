"use client";
import { Button } from "@/components/common/Button";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";

type Props = {};

export function EditMenuHeader({}: Props) {
  const handleSave = () => {
    console.log("save");
  };
  return (
    <PageHeader>
      <PageHeader.BackButton />
      <PageHeader.Title
        title="Upravit jídelní lístek"
        subtitle="McDonalds Chodov"
      />
    </PageHeader>
  );
}
