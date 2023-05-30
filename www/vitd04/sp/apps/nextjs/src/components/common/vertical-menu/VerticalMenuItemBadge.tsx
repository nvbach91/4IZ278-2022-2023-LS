import React from "react";

type Props = {
  children: React.ReactNode;
};

export function VerticalMenuItemBadge({ children }: Props) {
  return (
    <span
      className="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-white px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-gray-600 ring-1 ring-inset ring-gray-200"
      aria-hidden="true"
    >
      {children}
    </span>
  );
}
