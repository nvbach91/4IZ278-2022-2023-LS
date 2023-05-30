"use client";
import { useTabsContext } from "./TabsContext";
import classNames from "clsx";
import React, { ReactNode } from "react";

type ChildrenFunction = {
  isActive: boolean;
  onTabChange: () => void;
  className: string;
  index: number;
};

type Props = {
  index: number;
  children: ((props: ChildrenFunction) => ReactNode) | ReactNode;
  disabled?: boolean;
};

export function Tab({ children, disabled, index }: Props) {
  const tabs = useTabsContext();
  const isActive = tabs.selectedIndex === index;
  const className = classNames([
    "px-4 py-2 text-sm font-medium text-gray-500 rounded-full whitespace-nowrap transition-all duration-500",
    isActive && "text-white",
    !isActive && "",
  ]);

  const handleTabChange = () => {
    tabs.onTabChange(index);
  };
  if (typeof children === "function") {
    const Component = children({
      isActive: isActive,
      onTabChange: handleTabChange,
      className,
      index,
    });
    return <>{Component}</>;
  }
  return (
    <button className={className} disabled={disabled} onClick={handleTabChange}>
      {children}
    </button>
  );
}
