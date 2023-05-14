"use client";
import { useEffect, useState } from "react";
import { Combobox, Transition } from "@headlessui/react";
import { TextInput } from "./TextInput";
import { CheckIcon, MapPinIcon } from "@heroicons/react/24/outline";
import { SelectedLocation } from "@/types/location";

const locations = [
  {
    slug: "praha",
    name: "Praha",
    lat: 50.073658,
    lng: 14.41854,
  },
];

type AutocompleteInputProps = {
  selectedLocation?: SelectedLocation | null;
  onSelectedLocationChange: (location: SelectedLocation) => void;
} & React.InputHTMLAttributes<HTMLInputElement>;

export function AutocompleteInput({
  selectedLocation,
  onSelectedLocationChange,
  ...rest
}: AutocompleteInputProps) {
  const [query, setQuery] = useState(selectedLocation?.name || "");

  useEffect(() => {
    setQuery(selectedLocation?.name || "");
  }, [selectedLocation]);

  const filteredLocations =
    query === ""
      ? locations
      : locations.filter((location) => {
          return location.name.toLowerCase().includes(query.toLowerCase());
        });

  return (
    <div className="w-full md:max-w-sm relative z-10">
      <Combobox value={selectedLocation} onChange={onSelectedLocationChange}>
        <TextInput
          as={Combobox.Input}
          onChange={(event) => setQuery(event.target.value)}
          {...rest}
        />
        <Transition
          enter="transition ease-out duration-200"
          enterFrom="transform opacity-0 scale-95"
          enterTo="transform opacity-100 scale-100"
          leave="transition ease-in duration-75"
          leaveFrom="transform opacity-100 scale-100"
          leaveTo="transform opacity-0 scale-95"
        >
          <Combobox.Options className="z-10 absolute left-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            {filteredLocations.map((location) => (
              <Combobox.Option
                //   className={ "block px-4 py-2 text-sm text-gray-700 w-full text-left hover:bg-gray-50 focus:bg-gray-100"}
                className={({ active }) =>
                  `block px-4 py-2 text-sm text-gray-700 w-full text-left hover:bg-gray-50 ${
                    active ? "bg-gray-100" : ""
                  }`
                }
                key={location.slug}
                value={location}
              >
                {location.name}
              </Combobox.Option>
            ))}
          </Combobox.Options>
        </Transition>
      </Combobox>
      <button className="absolute right-4 top-3">
        <MapPinIcon className="w-5 h-5 text-gray-400" />
      </button>
    </div>
  );
}
