import classes from "clsx";
import React from "react";

type Props = {
  className?: string;
  isError?: boolean;
} & React.TextareaHTMLAttributes<HTMLTextAreaElement>;

export function TextArea({ className, isError, ...rest }: Props) {
  return (
    <textarea
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
