"use client";

import Link from "next/link";
import { useRouter } from "next/navigation";
import React from "react";
import { ArrowLeftIcon } from "@heroicons/react/24/outline";

type Props = {
  href?: string;
};

function PageHeaderBackButtonContent() {
  return <ArrowLeftIcon className="w-6 h-6" />;
}

export function PageHeaderBackButton({ href }: Props) {
  const router = useRouter();
  const classes = "p-3 rounded-full hover:bg-gray-100 block";

  if (href) {
    return (
      <div className="block md:hidden">
        <Link className={classes} href={href}>
          <PageHeaderBackButtonContent />
        </Link>
      </div>
    );
  }

  return (
    <div className="block md:hidden">
      <button
        className={classes}
        onClick={(e: any) => {
          e.preventDefault();
          router.back();
        }}
      >
        <PageHeaderBackButtonContent />
      </button>
    </div>
  );
}
