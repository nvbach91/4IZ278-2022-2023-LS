export const BASE_URL = process.env.NEXT_PUBLIC_BACKEND_URL;
export const FRONTEND_URL = process.env.NEXT_PUBLIC_FRONTEND_URL;
export const SYSTEM_URL = FRONTEND_URL + "/system";
export const API_URL = SYSTEM_URL + "/api";
export const SELECTED_LOCATION_KEY = "selectedLocation";
export const GOOGLE_MAPS_API_KEY =
  process.env.NEXT_PUBLIC_GOOGLE_MAPS_API_KEY || "";
