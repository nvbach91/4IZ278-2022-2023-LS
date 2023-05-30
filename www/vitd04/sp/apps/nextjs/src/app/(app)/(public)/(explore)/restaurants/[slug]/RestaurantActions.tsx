"use client";
import { Menu, Transition } from "@headlessui/react";
import Link from "next/link";
import React, { Fragment } from "react";
import classNames from "clsx";
import { Button } from "@/components/common/Button";
import { EllipsisHorizontalCircleIcon } from "@heroicons/react/24/outline";
import { EllipsisHorizontalIcon } from "@heroicons/react/24/solid";

type Props = {
  slug: string;
};

export function RestaurantActions({ slug }: Props) {
  return (
    <Menu as="div" className="relative ml-3 z-20">
      <div>
        <Button
          as={Menu.Button}
          title="Akce"
          look="secondary"
          icon={EllipsisHorizontalIcon}
        />
        {/* <Menu.Button className="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 items-center md:space-x-3"></Menu.Button> */}
      </div>
      <Transition
        as={Fragment}
        enter="transition ease-out duration-200"
        enterFrom="transform opacity-0 scale-95"
        enterTo="transform opacity-100 scale-100"
        leave="transition ease-in duration-75"
        leaveFrom="transform opacity-100 scale-100"
        leaveTo="transform opacity-0 scale-95"
      >
        <Menu.Items className="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
          <Menu.Item>
            <Link
              href={"/settings/restaurants/" + slug + "/edit"}
              className={classNames(
                "block px-4 py-2 text-sm text-gray-700 w-full text-left"
              )}
            >
              Upravit stránku
            </Link>
          </Menu.Item>
          <Menu.Item>
            <Link
              href={"/settings/restaurants/" + slug + "/edit-menu"}
              className={classNames(
                "block px-4 py-2 text-sm text-gray-700 w-full text-left"
              )}
            >
              Upravit jídlení lístek
            </Link>
          </Menu.Item>
          {/* <>
              {item.as === "button" ? (
                <button
                  onClick={item.onClick}
                  className={classNames(
                    active ? "bg-gray-100" : "",
                    "block px-4 py-2 text-sm text-gray-700 w-full text-left"
                  )}
                >
                  {item.name}
                </button>
              ) : (
                <Link
                  href={item.href}
                  className={classNames(
                    active ? "bg-gray-100" : "",
                    "block px-4 py-2 text-sm text-gray-700 w-full text-left"
                  )}
                >
                  {item.name}
                </Link>
              )}
            </> 
          </Menu.Item>*/}
        </Menu.Items>
      </Transition>
    </Menu>
  );
}
