import React, { AnchorHTMLAttributes } from "react";
import NextLink, { LinkProps } from "next/link";

type Props = LinkProps & AnchorHTMLAttributes<HTMLAnchorElement>;

export function Link({ children, ...props }: Props) {
  return (
    <NextLink
      className="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
      {...props}
    >
      {children}
    </NextLink>
  );
}
