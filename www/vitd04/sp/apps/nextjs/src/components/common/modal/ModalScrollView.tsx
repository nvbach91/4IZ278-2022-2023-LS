import React, { UIEventHandler } from "react";
import classNames from "clsx";

type Props = {
  children: React.ReactNode;
  onScroll?: UIEventHandler<HTMLDivElement>;
  className?: string;
};

export function ModalScrollView({ children, onScroll, className }: Props) {
  return (
    <div
      className={classNames("overflow-y-auto max-w-full max-h-full", className)}
      onScroll={onScroll}
    >
      {children}
    </div>
  );
}
