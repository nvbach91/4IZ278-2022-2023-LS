import useSWR from "swr";
import axios from "@/lib/axios";
import { useEffect } from "react";
import { useRouter, useSearchParams } from "next/navigation";

type useAuthOptions = {
  middleware?: "auth" | "guest";
  redirectIfAuthenticated?: string;
  redirectIfNotAuthenticated?: string;
};

export const useAuth = ({
  middleware,
  redirectIfAuthenticated,
}: useAuthOptions = {}) => {
  const router = useRouter();
  const params = useSearchParams();

  const {
    data: user,
    error,
    mutate,
    isLoading: isUserLoading,
  } = useSWR("/user", () =>
    axios
      .get("/user")
      .then((res) => res.data)
      .catch((error) => {
        if (error.response.status !== 409) throw error;

        router.push("/verify-email");
      })
  );

  const csrf = () => axios.get("/sanctum/csrf-cookie");

  const register = async ({ setErrors, ...props }: any) => {
    await csrf();

    setErrors([]);

    return axios
      .post("/register", props)
      .then(() => mutate())
      .catch((error) => {
        if (error.response.status !== 422) throw error;

        setErrors(error.response.data.errors);
      });
  };

  const login = async ({ setErrors, setStatus, ...props }: any) => {
    await csrf();

    setErrors([]);
    setStatus(null);

    return axios
      .post("/login", props)
      .then(() => mutate())
      .catch((error) => {
        if (error.response.status !== 422) throw error;

        setErrors(error.response.data.errors);
      });
  };

  const forgotPassword = async ({ setErrors, setStatus, email }: any) => {
    await csrf();

    setErrors([]);
    setStatus(null);

    return axios
      .post("/forgot-password", { email })
      .then((response) => setStatus(response.data.status))
      .catch((error) => {
        if (error.response.status !== 422) throw error;

        setErrors(error.response.data.errors);
      });
  };

  const resetPassword = async ({ setErrors, setStatus, ...props }: any) => {
    await csrf();

    setErrors([]);
    setStatus(null);

    return axios
      .post("/reset-password", { token: params.get("token"), ...props })
      .then((response) =>
        router.push("/login?reset=" + btoa(response.data.status))
      )
      .catch((error) => {
        if (error.response.status !== 422) throw error;

        setErrors(error.response.data.errors);
      });
  };

  const resendEmailVerification = ({ setStatus }: any) => {
    return axios
      .post("/email/verification-notification")
      .then((response) => setStatus(response.data.status));
  };

  const logout = async () => {
    if (!error) {
      await axios.post("/logout").then(() => mutate());
    }

    window.location.pathname = "/login";
  };

  useEffect(() => {
    if (middleware === "guest" && redirectIfAuthenticated && user)
      router.push(redirectIfAuthenticated);
    if (
      window.location.pathname === "/verify-email" &&
      redirectIfAuthenticated &&
      user?.email_verified_at
    ) {
      router.push(redirectIfAuthenticated);
    }
    if (middleware === "auth" && error) logout();
  }, [user, error]);

  return {
    user,
    isUserLoading,
    register,
    login,
    forgotPassword,
    resetPassword,
    resendEmailVerification,
    logout,
  };
};
