"use client";
import { Container } from "@/components/common/Container";
import { ExploreHeaderBar } from "@/app/(app)/(explore)/ExploreHeaderBar";
import { RestaurantCard } from "@/app/(app)/(explore)/search/RestaurantCard";
import React, { useEffect } from "react";
import { cookies } from "next/headers";
import { redirect, useSearchParams } from "next/navigation";
import { api } from "@/lib/api";

function Search() {
  const searchParams = useSearchParams();
  console.log(searchParams);
  useEffect(() => {
    if (!searchParams.get("lat") || !searchParams.get("lng")) {
      redirect("/");
    }
  }, [searchParams]);

  const { data } = api.restauranst.search.useQuery({
    lat: searchParams.get("lat"),
    lng: searchParams.get("lng"),
  });

  return (
    <Container>
      {data && <div className="flex items-center justify-between">DATA</div>}
      <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-6">
        <RestaurantCard />
        <RestaurantCard />
        <RestaurantCard />
        <RestaurantCard />
        <RestaurantCard />
        <RestaurantCard />
      </div>
    </Container>
  );
}

export default Search;
