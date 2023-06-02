"use client";

import Link from "next/link";
import React, { useState, useEffect } from "react";
import { Button } from "./Button";
import { usePathname, useRouter, useSearchParams } from "next/navigation";
import { convertRecordToString } from "@/utils/convertRecordToString";
import { Container } from "./Container";

type Props = {
  total: number;
  from: number;
  to: number;
  currentPage: number;
  lastPage: number;
  firstPage: number;
};

export function Pagination({
  from,
  to,
  total,
  currentPage,
  lastPage,
  firstPage,
}: Props) {
  const searchParams = useSearchParams();
  const router = useRouter();
  const pathname = usePathname();
  const handleNextPage = () => {
    const entries = searchParams.entries();
    const params = Object.fromEntries(entries);
    params.page = (currentPage + 1).toString();
    router.push(
      pathname + "?" + new URLSearchParams(convertRecordToString(params))
    );
  };

  const handlePreviousPage = () => {
    const entries = searchParams.entries();
    const params = Object.fromEntries(entries);
    params.page = (currentPage - 1).toString();
    router.push(
      pathname + "?" + new URLSearchParams(convertRecordToString(params))
    );
  };

  return (
    <nav
      className="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
      aria-label="Pagination"
    >
      <div className="hidden sm:block">
        <p className="text-sm text-gray-700">
          Zobrazeno <span className="font-medium">{from}</span> až{" "}
          <span className="font-medium">{to}</span> z{" "}
          <span className="font-medium">{total}</span> výsledků
        </p>
      </div>
      <div className="flex flex-1 justify-between sm:justify-end space-x-4">
        {currentPage > firstPage && (
          <Button
            look="secondary"
            title="Předchozí"
            onClick={handlePreviousPage}
            disabled={currentPage == firstPage}
          />
        )}
        {currentPage < lastPage && (
          <Button
            look="secondary"
            title="Další"
            onClick={handleNextPage}
            disabled={currentPage == lastPage}
          />
        )}
      </div>
    </nav>
  );
}
