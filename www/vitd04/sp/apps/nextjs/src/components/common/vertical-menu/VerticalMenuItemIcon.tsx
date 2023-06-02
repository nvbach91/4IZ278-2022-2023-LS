import React from "react";
import classNames from "clsx";

type Props = {
  isCurrent: boolean;
  icon: React.ElementType;
};

export function VerticalMenuItemIcon({ isCurrent, icon }: Props) {
  const Icon = icon;
  return (
    <Icon
      className={classNames(
        isCurrent && "md:text-gray-800",
        "h-6 w-6 shrink-0 text-gray-400 md:group-hover:text-gray-90"
      )}
      aria-hidden="true"
    />
  );
}
