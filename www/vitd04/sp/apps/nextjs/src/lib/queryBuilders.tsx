import { QueryKey } from "@tanstack/query-core";
import {
  useQuery,
  UseMutationOptions,
  useMutation,
} from "@tanstack/react-query";
import { createQueryFetcher, createMutationFetcher } from "./fetcher";

export function createQuery<TPayload extends Record<string, any>, TResponse>(
  key: QueryKey
) {
  return {
    useQuery: (payload: TPayload) =>
      useQuery<TResponse>(
        key,
        async () => createQueryFetcher<TPayload>((key as string[])[0])(payload),
        {
          useErrorBoundary: false,
        }
      ),
    useServerQuery: async (payload: TPayload, cookies: string) => {
      const res = await createQueryFetcher<TPayload>((key as string[])[0])(
        payload,
        {
          headers: {
            Cookie: cookies,
            // ...headers(),
          },
        }
      );
      return res as TResponse;
    },
  };
}

export function createMutation<
  TPayload extends Record<string, any> | FormData,
  TResponse
>(
  path: string,
  method: "POST" | "PUT" | "DELETE",
  fetchOptions?: RequestInit & {
    ignoreContentType?: boolean;
    disableStringify?: boolean;
  }
) {
  return {
    useMutation: (options?: UseMutationOptions<TResponse, any, TPayload>) =>
      useMutation<TResponse, any, TPayload>({
        ...options,
        mutationFn: (payload: TPayload) =>
          createMutationFetcher<TPayload>(method, path)(payload, {
            ...fetchOptions,
          }),
      }),
  };
}
