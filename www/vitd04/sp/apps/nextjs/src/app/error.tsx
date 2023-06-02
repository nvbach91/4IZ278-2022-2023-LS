"use client"; // Error components must be Client Components

import { useEffect } from "react";
import { Header } from "./Header";
import { Button } from "@/components/common/Button";
import { useRouter } from "next/navigation";
import { ArrowLeftIcon } from "@heroicons/react/24/outline";

export default function Error({
  error,
  reset,
}: {
  error: any;
  reset: () => void;
}) {
  useEffect(() => {
    // Log the error to an error reporting service
    console.error(error);
  }, [error]);

  let parsedError = {
    code: 500,
    message: "Něco se pokazilo",
  };
  if (typeof error === "string") {
    parsedError.message = error;
  }
  if (typeof error === "object") {
    parsedError = {
      code: error.code || 500,
      message: "Něco se pokazilo",
    };
  }

  const router = useRouter();
  const handleGoBack = () => {
    reset();
    router.back();
  };

  return (
    <>
      <Header />
      <div className="w-full h-full flex items-center justify-center flex-col">
        <div className="text-md font-semibold">{parsedError.code}</div>
        <h2 className="text-3xl font-semibold">{parsedError.message}</h2>

        <div className="flex space-x-4">
          <Button
            icon={ArrowLeftIcon}
            look="secondary"
            onClick={handleGoBack}
            className="mt-6"
            title="Zpět"
          />
          <Button onClick={reset} className="mt-6" title="Zkusit znovu" />
        </div>
      </div>
    </>
  );
}
