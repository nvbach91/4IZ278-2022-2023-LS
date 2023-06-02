import { API_URL, SYSTEM_URL } from "@/constants";
import Axios from "axios";

const axios = Axios.create({
  baseURL: SYSTEM_URL,
  headers: {
    "X-Requested-With": "XMLHttpRequest",
  },
  withCredentials: true,
});

export default axios;
