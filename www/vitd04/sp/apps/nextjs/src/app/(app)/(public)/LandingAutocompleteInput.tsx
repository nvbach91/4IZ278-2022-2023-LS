"use client";
import React from "react";
import { useRouter } from "next/navigation";
import { SELECTED_LOCATION_KEY } from "@/constants";
import { AutocompleteInput } from "@/components/common/AutocompleteInput";
import { SelectedLocation } from "@/types/location";

type Props = {};
function LandingAutocompleteInput({}: Props) {
  const router = useRouter();
  const handleLocationSelected = (location: SelectedLocation) => {
    localStorage?.setItem(SELECTED_LOCATION_KEY, JSON.stringify(location));
    router.push("/search?lat=" + location.lat + "&lng=" + location.lng);
  };
  return (
    <AutocompleteInput
      id="address"
      type="text"
      name="address"
      placeholder="Zadejte vaši ulici a číslo popisné"
      autoComplete="off"
      data-1p-ignore
      selectedLocation={null}
      onSelectedLocationChange={handleLocationSelected}
    />
  );
}

export default LandingAutocompleteInput;
