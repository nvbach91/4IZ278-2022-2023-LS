import React from "react";
import {
  GoogleMap,
  Marker,
  withGoogleMap,
  withScriptjs,
} from "react-google-maps";

type Props = {
  location: { lat: number; lng: number } | null;
  onLocationChange: (lat: number, lng: number) => void;
};

const DefaultLocation = { lat: 50.073658, lng: 14.41854 };
const DefaultZoom = 10;

export const RestaurantLocationPicker = withScriptjs(
  withGoogleMap(({ location, onLocationChange }: Props) => (
    // @ts-ignore
    <GoogleMap
      defaultZoom={DefaultZoom}
      defaultCenter={location || DefaultLocation}
      onClick={(e) => {
        onLocationChange(e.latLng.lat(), e.latLng.lng());
      }}
      yesIWantToUseGoogleMapApiInternals
    >
      {location && <Marker position={location} />}
    </GoogleMap>
  ))
);
