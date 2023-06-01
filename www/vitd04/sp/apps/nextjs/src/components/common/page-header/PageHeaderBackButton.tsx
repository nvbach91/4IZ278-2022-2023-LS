"use client";

import Link from "next/link";
import { useRouter } from "next/navigation";
import React from "react";
import { ArrowLeftIcon } from "@heroicons/react/24/outline";
import classNames from "clsx";

type Props = {
  href?: string;
  mobileOnly?: boolean;
};

function PageHeaderBackButtonContent() {
  return <ArrowLeftIcon className="w-6 h-6" />;
}

export function PageHeaderBackButton({ href, mobileOnly }: Props) {
  const router = useRouter();
  const classes = "p-3 rounded-full hover:bg-gray-100 block";

  if (href) {
    return (
      <div className={classNames("block", mobileOnly && "md:hidden")}>
        <Link className={classes} href={href}>
          <PageHeaderBackButtonContent />
        </Link>
      </div>
    );
  }

  return (
    <div className={classNames("block", mobileOnly && "md:hidden")}>
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
