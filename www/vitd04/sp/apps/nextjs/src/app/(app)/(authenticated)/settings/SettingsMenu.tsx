"use client";
import { VerticalMenu } from "@/components/common/vertical-menu/VerticalMenu";
import {
  UserCircleIcon,
  BuildingStorefrontIcon,
} from "@heroicons/react/24/outline";
import { usePathname } from "next/navigation";
import React, { useMemo } from "react";

type Props = {};

export function SettingsMenu({}: Props) {
  const pathname = usePathname();
  const getIsCurrent = useMemo(
    () => (url: string, fullMatch?: boolean) => {
      if (fullMatch) return pathname === url;
      return pathname.startsWith(url);
    },
    [pathname]
  );
  const settingsMenuItem = useMemo(() => {
    return [
      {
        title: "Profil",
        href: "/settings/profile",
        icon: UserCircleIcon,
        isCurrent:
          getIsCurrent("/settings/profile") || getIsCurrent("/settings", true),
      },
      {
        title: "Restaurace",
        href: "/settings/restaurants",
        icon: BuildingStorefrontIcon,
        isCurrent: getIsCurrent("/settings/restaurants"),
      },
    ];
  }, [getIsCurrent]);

  return (
    <VerticalMenu>
      <>
        {settingsMenuItem.map((item) => (
          <VerticalMenu.Item
            key={item.title}
            href={item.href}
            isCurrent={item.isCurrent}
          >
            <VerticalMenu.Item.Icon
              icon={item.icon}
              isCurrent={item.isCurrent}
            />
            <VerticalMenu.Item.Title>{item.title}</VerticalMenu.Item.Title>
          </VerticalMenu.Item>
        ))}
      </>
    </VerticalMenu>
  );
}
