import { Container } from "@/components/common/Container";
import { ExploreHeaderBar } from "@/app/(app)/(public)/(explore)/search/ExploreHeaderBar";
import { RestaurantCard } from "@/app/(app)/(public)/(explore)/search/RestaurantCard";
import React, { useEffect } from "react";
import { cookies } from "next/headers";
import { redirect, useSearchParams } from "next/navigation";
import { api } from "@/lib/api";
import { headers } from "next/headers";
import { getUser } from "@/services/user";
import { getCookie } from "@/utils/getCookie";
import { Pagination } from "@/components/common/Pagination";

type Props = {
  searchParams: {
    lat: string;
    lng: string;
    page?: string;
    per_page?: string;
  };
};
async function Search({ searchParams }: Props) {
  const data = await api.restaurants.search.useServerQuery(
    {
      lat: parseFloat(searchParams.lat),
      lng: parseFloat(searchParams.lng),
      page: parseInt(searchParams.page || "1"),
      per_page: parseInt(searchParams.per_page || "10"),
    },
    getCookie()
  );

  return (
    <>
      <ExploreHeaderBar />
      <Container>
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-6">
          {data.data.map((restaurant) => (
            <RestaurantCard key={restaurant.id} restaurant={restaurant} />
          ))}
        </div>
      </Container>
      <Pagination
        total={data.total}
        from={data.from}
        to={data.to}
        currentPage={data.current_page}
        firstPage={1}
        lastPage={data.last_page}
      />
    </>
  );
}

export default Search;
