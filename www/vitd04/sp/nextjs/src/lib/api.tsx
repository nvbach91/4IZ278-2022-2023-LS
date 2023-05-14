"use client";
import { API_URL } from "@/constants";
import { QueryKey, useQuery } from "@tanstack/react-query";

function convertRecordToString(
  record: Record<string, any>
): Record<string, string> {
  const result: Record<string, string> = {};

  for (const key in record) {
    if (record.hasOwnProperty(key)) {
      const value = record[key];
      result[key] = String(value);
    }
  }

  return result;
}

async function apiFetch(
  input: RequestInfo | URL,
  init?: RequestInit | undefined
) {
  return await fetch(input, {
    ...init,
    headers: {
      ...init?.headers,
      "X-Requested-With": "XMLHttpRequest",
    },
    credentials: "include",
  });
}

function createQueryFetcher<TPayload extends Record<string, any>>(
  path: string
) {
  return async (params: TPayload) => {
    const response = await apiFetch(
      API_URL +
        "/" +
        path +
        "?" +
        new URLSearchParams(convertRecordToString(params)),
      {
        method: "GET",
      }
    );
    const data = await response.json();
    return data;
  };
}

function createMutationFetcher<TPayload extends Record<string, any>>(
  method: "POST" | "PUT" | "DELETE",
  path: string
) {
  return async (params: TPayload) => {
    const response = await apiFetch(API_URL + "/" + path, {
      method: method,
      body: JSON.stringify(params),
    });
    const data = await response.json();
    return data;
  };
}

function queryBuilder<TPayload extends Record<string, any>, TResponse>(
  key: QueryKey
) {
  return (payload: TPayload) =>
    useQuery<TResponse>(key, async () =>
      createQueryFetcher<TPayload>("restaurants/search")(payload)
    );
}

type ApiContract = {
  restaurants: {
    search: {
      payload: {};
      response: {
        data: {
          id: number;
          name: string;
        }[];
      };
    };
  };
};
export const api = {
  restauranst: {
    search: {
      useQuery: queryBuilder<
        ApiContract["restaurants"]["search"]["payload"],
        ApiContract["restaurants"]["search"]["response"]
      >(["restaurants/search"]),
    },
  },
};
