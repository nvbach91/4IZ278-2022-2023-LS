"use client";
import { Tab } from "./Tab";
import { TabsContext } from "./TabsContext";
import React, { useLayoutEffect, useRef, useState } from "react";

type TabsProps = {
  selectedIndex?: number;
  children: React.ReactNode;
  onTabChange: (index: number) => void;
};
export function Tabs({ children, selectedIndex, onTabChange }: TabsProps) {
  const tabsRef = useRef<HTMLDivElement>(null);
  const [componentWidth, setComponentWidth] = useState(0);
  const [itemConstains, setItemConstains] = useState<
    { x: number; y: number; width: number; height: number }[]
  >([]);

  useLayoutEffect(() => {
    if (tabsRef.current) {
      setComponentWidth(tabsRef.current.offsetWidth);
    }
    const constrains = [];
    const children = tabsRef.current?.children;
    if (children) {
      for (let i = 0; i < children.length; i++) {
        const child = children[i] as HTMLElement;
        const indicator = child.getAttribute("data-indicator");
        if (!indicator) {
          constrains.push({
            x: child.offsetLeft,
            y: child.offsetTop,
            width: child.clientWidth,
            height: child.clientHeight,
          });
        }
      }
      setItemConstains(constrains);
    }
  }, [children]);

  const getMaxWidth = () => {
    let width = 0;
    for (let i = 0; i < itemConstains.length; i++) {
      const tab = itemConstains?.[i];
      width += tab?.width || 0;
    }
    return width;
  };

  const handleTabPress = (index: number) => {
    // Tries to center the tab in the middle of the screen
    const maxWidth = getMaxWidth();
    const item = itemConstains[index];
    const widthUntil = item?.x || 0;
    const itemWidth = item?.width || 0;

    console.log(maxWidth, widthUntil, itemWidth);

    // If the tab is too far to the left, scroll to the left
    if (widthUntil + itemWidth / 2 < componentWidth / 2) {
      tabsRef.current?.scrollTo({
        left: 0,
        top: 0,
        behavior: "smooth",
      });
    }

    // If the tab is too far to the right, scroll to the right
    if (widthUntil + itemWidth / 2 > maxWidth - componentWidth / 2) {
      tabsRef.current?.scrollTo({
        left: maxWidth - componentWidth,
        top: 0,
        behavior: "smooth",
      });
    }

    // If the tab is not in the middle, scroll to the middle
    if (componentWidth / 2 - itemWidth / 2 < widthUntil) {
      tabsRef.current?.scrollTo({
        left: widthUntil - componentWidth / 2 + itemWidth / 2,
        top: 0,
        behavior: "smooth",
      });
    }
    onTabChange(index);
  };
  return (
    <TabsContext.Provider
      value={{
        selectedIndex: selectedIndex || 0,
        onTabChange: handleTabPress,
      }}
    >
      <div
        className="flex overflow-x-scroll scrollbar-hide relative"
        ref={tabsRef}
      >
        <div
          data-indicator
          className="h-full absolute bg-gray-900 transition-all duration-200 ease-in-out -z-10 rounded-full"
          style={{
            width: itemConstains[selectedIndex || 0]?.width || 0,
            left: itemConstains[selectedIndex || 0]?.x || 0,
          }}
        ></div>
        {children}
        <div
          data-indicator
          className="w-4 h-full bg-gradient-to-r from-white to-transparent fixed left-0 top-0 pointer-events-none"
        ></div>
        <div
          data-indicator
          className="w-4 h-full bg-gradient-to-r from-transparent to-white fixed right-0 top-0 pointer-events-none"
        ></div>
      </div>
    </TabsContext.Provider>
  );
}

Tabs.Tab = Tab;
