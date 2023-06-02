import { API_URL, FRONTEND_URL, SYSTEM_URL } from "@/constants";
import { convertRecordToString } from "@/utils/convertRecordToString";

async function apiFetch(
  input: RequestInfo | URL,
  init?: RequestInit | undefined
) {
  const res = await fetch(input, {
    ...init,
    headers: {
      ...init?.headers,
      "X-Requested-With": "XMLHttpRequest",
      origin: new URL(FRONTEND_URL || "").hostname,
    },
    credentials: "same-origin",
  });
  return res;
}

export function createQueryFetcher<TPayload extends Record<string, any>>(
  path: string
) {
  return async (params: TPayload, options?: RequestInit | undefined) => {
    const response = await apiFetch(
      API_URL +
        "/" +
        path +
        "?" +
        new URLSearchParams(convertRecordToString(params)),
      {
        ...options,
        method: "GET",
      }
    );

    if (response.status >= 400) {
      const data = await response.json();
      if (data?.error) {
        throw {
          code: response.status,
          message: data?.error,
        };
      } else {
        throw {
          code: response.status,
          message: "Něco se pokazilo",
        };
      }
    }

    const data = await response.json();
    return data;
  };
}
export function createMutationFetcher<
  TPayload extends Record<string, any> | FormData
>(method: "POST" | "PUT" | "DELETE", path: string) {
  return async (
    params: TPayload,
    options?:
      | (RequestInit & {
          ignoreContentType?: boolean;
          disableStringify?: boolean;
        })
      | undefined
  ) => {
    // CSFR
    const csfrRes = await apiFetch(SYSTEM_URL + "/sanctum/csrf-cookie", {
      method: "GET",
    });

    const cookieName = "XSRF-TOKEN";
    let token = "";
    if (document.cookie && document.cookie !== "") {
      const cookies = document.cookie.split(";");
      for (let i = 0; i < cookies.length; i += 1) {
        const cookie = cookies[i].trim();
        if (cookie.substring(0, cookieName.length + 1) === `${cookieName}=`) {
          token = decodeURIComponent(cookie.substring(cookieName.length + 1));
          break;
        }
      }
    }

    const response = await apiFetch(API_URL + "/" + path, {
      ...options,
      method: method,
      // @ts-ignore
      body: options?.disableStringify ? params : JSON.stringify(params),
      headers: {
        ...(options?.ignoreContentType
          ? {}
          : {
              "Content-Type": "application/json",
            }),
        Accept: "application/json",
        "X-XSRF-TOKEN": token,
        ...options?.headers,
      },
    });

    if (response.status >= 400) {
      const data = await response.json();
      if (data?.error) {
        throw {
          code: response.status,
          message: data?.error,
        };
      } else {
        throw {
          code: response.status,
          message: "Něco se pokazilo",
        };
      }
    }

    if (response.status == 204) {
      return {};
    }

    const data = await response.json();
    return data;
  };
}
