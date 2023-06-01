"use client";
import { useEffect, useState } from "react";
import { Combobox, Transition } from "@headlessui/react";
import { TextInput } from "./TextInput";
import { CheckIcon, MapPinIcon } from "@heroicons/react/24/outline";
import { SelectedLocation } from "@/types/location";
import usePlacesService from "react-google-autocomplete/lib/usePlacesAutocompleteService";
import { constants } from "buffer";
import { GOOGLE_MAPS_API_KEY } from "@/constants";

const locations = [
  {
    slug: "praha",
    name: "Praha",
    lat: 50.073658,
    lng: 14.41854,
  },
  {
    slug: "brno",
    name: "Brno",
    lat: 49.19506,
    lng: 16.606837,
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
  const {
    placesService,
    placePredictions,
    getPlacePredictions,
    isPlacePredictionsLoading,
  } = usePlacesService({
    apiKey: GOOGLE_MAPS_API_KEY,
  });

  const [query, setQuery] = useState(selectedLocation?.name || "");

  useEffect(() => {
    setQuery(selectedLocation?.name || "");
  }, [selectedLocation]);

  const handleOnInputChange = (newValue: string) => {
    setQuery(newValue);
    getPlacePredictions({
      input: newValue,
    });
  };

  const handleOnLocationSelected = (location: SelectedLocation) => {
    placesService?.getDetails({ placeId: location.slug }, (placeDetails) => {
      if (!placeDetails) return;
      onSelectedLocationChange({
        ...location,
        lat: placeDetails.geometry?.location?.lat() || 0,
        lng: placeDetails?.geometry?.location?.lng() || 0,
      });
    });
  };

  const mappedLocations = placePredictions.map((prediction) => {
    return {
      slug: prediction.place_id,
      name:
        prediction.structured_formatting.main_text +
        ", " +
        prediction.structured_formatting.secondary_text,
      lat: prediction,
    };
  });

  const handleGeocode = () => {
    if (!navigator.geolocation) {
      console.log("Geolocation is not supported by your browser");
      return;
    } else {
      console.log("else");
      navigator.geolocation.getCurrentPosition(
        (position) => {
          let lat = position.coords.latitude;
          let lng = position.coords.longitude;

          console.log(position);

          // Google geocode
          const geocoder = new google.maps.Geocoder();

          geocoder.geocode(
            {
              location: {
                lat: lat,
                lng: lng,
              },
            },
            (results, status) => {
              console.log(results, status);
              if (status == google.maps.GeocoderStatus.OK) {
                if (results?.[0]) {
                  console.log(results);
                  onSelectedLocationChange({
                    slug: results[0].place_id,
                    name: results[0].formatted_address,
                    lat: lat,
                    lng: lng,
                  });
                }
              } else {
                alert("Selholo načítání vaší aktuální adresy.");
              }
            }
          );
        },
        (error) => {
          console.error(error);
        }
      );
    }
  };

  return (
    <div className="w-full md:max-w-sm relative z-10">
      <Combobox value={selectedLocation} onChange={handleOnLocationSelected}>
        <TextInput
          as={Combobox.Input}
          onChange={(event) => handleOnInputChange(event.target.value)}
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
            {mappedLocations.map((location) => (
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
      <button
        className="absolute right-4 top-3"
        onClick={() => handleGeocode()}
      >
        <MapPinIcon className="w-5 h-5 text-gray-400" />
      </button>
    </div>
  );
}
