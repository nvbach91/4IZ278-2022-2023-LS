"use client";
import React, { useEffect, useState } from "react";
import { Container } from "@/components/common/Container";
import { useRouter } from "next/navigation";
import { SELECTED_LOCATION_KEY } from "@/constants";
import { MapPinIcon } from "@heroicons/react/24/solid";
import { SelectedLocation } from "@/types/location";

type Props = {};

export function ExploreHeaderBar({}: Props) {
  const [selectedLocation, setSelectedLocation] = useState(
    typeof localStorage !== "undefined" &&
      localStorage?.getItem(SELECTED_LOCATION_KEY)
      ? (JSON.parse(
          localStorage?.getItem(SELECTED_LOCATION_KEY) || "{}"
        ) as SelectedLocation)
      : null
  );
  const router = useRouter();
  useEffect(() => {
    if (!selectedLocation) {
      router.push("/");
    }
  }, [selectedLocation, router]);
  return (
    <div className="bg-white shadow-sm">
      <Container>
        <div className="py-3">
          <span className="items-center flex">
            <MapPinIcon className="w-5 h-5 inline-block mr-2" />
            {selectedLocation?.name}
          </span>
        </div>
      </Container>
    </div>
  );
}
