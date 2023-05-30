"use client";
import { Menu, Transition } from "@headlessui/react";
import Link from "next/link";
import React, { Fragment } from "react";
import classNames from "clsx";
import { Button } from "@/components/common/Button";
import { EllipsisHorizontalCircleIcon } from "@heroicons/react/24/outline";
import { EllipsisHorizontalIcon } from "@heroicons/react/24/solid";

type Props = {
  onDelete: () => void;
};

export function MenuItemCardActions({ onDelete }: Props) {
  return (
    <Menu as="div" className="relative z-20">
      <div>
        <Button
          as={Menu.Button}
          title="Akce"
          look="secondary"
          icon={EllipsisHorizontalIcon}
          size="sm"
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
        <Menu.Items className="absolute left-0 z-10 mt-2 w-48 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
          <Menu.Item>
            <button
              onClick={onDelete}
              className={classNames(
                "block px-4 py-2 text-sm text-gray-700 w-full text-left"
              )}
            >
              Odstranit
            </button>
          </Menu.Item>
        </Menu.Items>
      </Transition>
    </Menu>
  );
}
