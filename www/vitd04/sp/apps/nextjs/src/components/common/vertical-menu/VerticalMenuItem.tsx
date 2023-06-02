import React from "react";
import classNames from "clsx";
import Link from "next/link";
import { VerticalMenuItemBadge } from "./VerticalMenuItemBadge";
import { VerticalMenuItemIcon } from "./VerticalMenuItemIcon";
import { VerticalMenuItemTitle } from "./VerticalMenuItemTitle";

type Props = {
  isCurrent: boolean;
  href: string;
  children: React.ReactNode;
};

export function VerticalMenuItem({ children, isCurrent, href }: Props) {
  return (
    <li>
      <Link
        href={href}
        className={classNames(
          isCurrent
            ? "md:bg-gray-100 md:text-gray-900"
            : "md:hover:bg-gray-50 md:bg-transparent",
          "group flex gap-x-3 rounded-md p-3 md:p-2 text-sm leading-6 text-gray-700 hover:text-gray-900 bg-gray-100"
        )}
      >
        {children}
      </Link>
    </li>
  );
}

VerticalMenuItem.Badge = VerticalMenuItemBadge;
VerticalMenuItem.Icon = VerticalMenuItemIcon;
VerticalMenuItem.Title = VerticalMenuItemTitle;
