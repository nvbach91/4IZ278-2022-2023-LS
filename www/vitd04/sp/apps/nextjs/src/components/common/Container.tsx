import React from "react";
import classNames from "clsx";

type Props = {
  children: React.ReactNode;
  paddingClassName?: string;
};

export const DEFAULT_CONTAINER_PADDING_CLASS_NAME = "px-4 sm:px-6 lg:px-8";

export function Container({
  children,
  paddingClassName = DEFAULT_CONTAINER_PADDING_CLASS_NAME,
}: Props) {
  return (
    <div className={classNames("mx-auto max-w-7xl", paddingClassName)}>
      {children}
    </div>
  );
}
