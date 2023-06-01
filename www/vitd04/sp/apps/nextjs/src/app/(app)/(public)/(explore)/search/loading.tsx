import { Container } from "@/components/common/Container";
import { Pagination } from "@/components/common/Pagination";
import React from "react";
import { ExploreHeaderBar } from "./ExploreHeaderBar";
import { RestaurantCard } from "./RestaurantCard";
import { RestaurantCardSkeleton } from "./RestaurantCardSkeleton";

type Props = {};

export default function Loading({}: Props) {
  return (
    <>
      <ExploreHeaderBar />
      <Container>
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-6">
          {Array.from({
            length: 8,
          }).map((restaurant) => (
            <RestaurantCardSkeleton key={restaurant as string} />
          ))}
        </div>
      </Container>
      <Pagination
        total={0}
        from={0}
        to={0}
        currentPage={0}
        firstPage={1}
        lastPage={0}
      />
    </>
  );
}
