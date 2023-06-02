import React from "react";

type Props = {
  children: React.ReactNode;
};

export function VerticalMenuItemTitle({ children }: Props) {
  return <span className="flex-1">{children}</span>;
}
