"use client";
import { Fragment, MouseEventHandler } from "react";
import { Disclosure, Menu, Transition } from "@headlessui/react";
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/react/24/outline";
import { Logo } from "@/components/common/Logo";
import classNames from "clsx";
import { Button } from "@/components/common/Button";
import Link from "next/link";
import { useAuthSession } from "@/hooks/useAuthSession";
import { api } from "@/lib/api";
import { useRouter } from "next/navigation";
import { toast } from "react-toastify";

export type HeaderProps = {
  mobileHidden?: boolean;
};
export function Header({ mobileHidden = false }: HeaderProps) {
  const router = useRouter();
  const user = useAuthSession();

  const { mutateAsync: logout, isLoading } = api.auth.logout.useMutation();

  const handleLogout: MouseEventHandler<HTMLButtonElement> = async (e) => {
    e.preventDefault();
    await logout(
      {},
      {
        onSuccess: () => {
          router.refresh();
          router.push("/");
        },
        onError: (error) => {
          toast.error(error?.response?.data?.message || "Nastala chyba.");
        },
      }
    );
  };

  const userNavigation = [
    { name: "Nastavení", href: "/settings" },
    { name: "Odhlásit se", href: "#", as: "button", onClick: handleLogout },
  ];

  return (
    <Disclosure
      as="nav"
      className={classNames(
        "bg-white sticky top-0 z-40",
        mobileHidden && "hidden md:block"
      )}
    >
      {({ open }) => (
        <>
          <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div className="flex h-16 justify-between">
              <div className="flex">
                <div className="flex flex-shrink-0 items-center">
                  <Link href="/">
                    <Logo className="h-4 w-auto lg:block" alt="Kam za jídlem" />
                  </Link>
                </div>
              </div>
              <div className="ml-6 flex items-center">
                {/* <button
                                            type="button"
                                            className="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                        >
                                            <span className="sr-only">
                                                View notifications
                                            </span>
                                            <BellIcon
                                                className="h-6 w-6"
                                                aria-hidden="true"
                                            />
                                        </button> */}

                {/* Profile dropdown */}
                {!user && (
                  <Button as={Link} title="Přihlásit se" href="/login" />
                )}
                {user && (
                  <Menu as="div" className="relative ml-3">
                    <div>
                      <Menu.Button className="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 items-center md:space-x-3">
                        <span className="sr-only">Open user menu</span>
                        <div className="text-gray-600 hidden md:block">
                          {user?.email}
                        </div>
                        <div className="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center">
                          {user?.email?.[0].toUpperCase()}
                        </div>
                      </Menu.Button>
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
                        {userNavigation.map((item) => (
                          <Menu.Item key={item.name}>
                            {({ active }) => (
                              <>
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
                            )}
                          </Menu.Item>
                        ))}
                      </Menu.Items>
                    </Transition>
                  </Menu>
                )}
              </div>
            </div>
          </div>
        </>
      )}
    </Disclosure>
  );
}
