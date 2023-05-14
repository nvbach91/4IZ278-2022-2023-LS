import classes from "clsx";
import React from "react";

type Props = {
  as?: React.ElementType;
  className?: string;
  isError?: boolean;
} & React.InputHTMLAttributes<HTMLInputElement>;

export function TextInput({ className, isError, ...rest }: Props) {
  const Component = rest.as || "input";
  return (
    <Component
      className={classes(
        "block w-full appearance-none rounded-md border px-4 py-3 placeholder-gray-400 shadow-sm sm:text-sm",
        !isError
          ? "focus:outline-none border-gray-300 focus:border-green-500 focus:ring-green-500"
          : "border-rose-300 focus:border-rose-600 focus:outline-none focus:ring-rose-300",
        className
      )}
      {...rest}
    />
  );
}
