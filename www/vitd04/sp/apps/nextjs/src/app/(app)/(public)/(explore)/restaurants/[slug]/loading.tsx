import { Container } from "@/components/common/Container";
import { Spinner } from "@/components/common/Spinner";
import React from "react";

type Props = {};

export default function Loading({}: Props) {
  return (
    <Container>
      <div className="grid grid-cols-12 gap-6 py-6">
        {/* Thumbnail */}
        <div className="w-full h-56 bg-gray-100 rounded-lg col-span-12 relative"></div>

        {/* Content */}
        <div className="col-span-12 md:col-span-9">
          {/* Title */}
          <div className="flex justify-between items-center">
            <div className="text-2xl font-semibold h-7 w-16 bg-gray-100 rounded-full"></div>
            <div className="space-x-3 flex"></div>
          </div>
          {/* Rating */}
          <span className="mt-2 bg-gray-100 w-8 h-4 rounded-fulltext-ellipsis whitespace-nowrap"></span>

          {/* Menu View */}
          <Spinner />
        </div>
      </div>
    </Container>
  );
}
