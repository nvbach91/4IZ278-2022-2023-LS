import React, { useState } from "react";
import { Transition } from "@headlessui/react";

type TooltipProps = {
  children: React.ReactNode;
  className?: string;
  bg?: "dark" | "light";
  size?: "lg" | "md" | "sm";
  position?: "right" | "left" | "bottom" | "top";
};
export function Tooltip({
  children,
  className,
  bg,
  size,
  position,
}: TooltipProps) {
  const [tooltipOpen, setTooltipOpen] = useState(false);

  const positionOuterClasses = (p: typeof position) => {
    switch (p) {
      case "right":
        return "left-full top-1/2 -translate-y-1/2";
      case "left":
        return "right-full top-1/2 -translate-y-1/2";
      case "bottom":
        return "top-full left-1/2 -translate-x-1/2";
      default:
        return "bottom-full left-1/2 -translate-x-1/2";
    }
  };

  const sizeClasses = (s: typeof size) => {
    switch (s) {
      case "lg":
        return "min-w-72  p-3";
      case "md":
        return "min-w-56 p-3";
      case "sm":
        return "min-w-44 p-2";
      default:
        return "p-2";
    }
  };

  const positionInnerClasses = (p: typeof position) => {
    switch (p) {
      case "right":
        return "ml-2";
      case "left":
        return "mr-2";
      case "bottom":
        return "mt-2";
      default:
        return "mb-2";
    }
  };

  return (
    <div
      className={`relative ${className}`}
      onMouseEnter={() => setTooltipOpen(true)}
      onMouseLeave={() => setTooltipOpen(false)}
      onFocus={() => setTooltipOpen(true)}
      onBlur={() => setTooltipOpen(false)}
    >
      <button
        className="block"
        aria-haspopup="true"
        aria-expanded={tooltipOpen}
        onClick={(e) => e.preventDefault()}
      >
        <svg
          className="w-4 h-4 fill-current text-slate-400"
          viewBox="0 0 16 16"
        >
          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
        </svg>
      </button>
      <div className={`z-10 absolute ${positionOuterClasses(position)}`}>
        <Transition
          show={tooltipOpen}
          as="div"
          className={`rounded overflow-hidden ${
            bg === "dark"
              ? "bg-slate-800"
              : "bg-white border border-slate-200 shadow-lg"
          } ${sizeClasses(size)} ${positionInnerClasses(position)}`}
          enter="transition ease-out duration-200 transform"
          enterFrom="opacity-0 -translate-y-2"
          enterTo="opacity-100 translate-y-0"
          leave="transition ease-out duration-200"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          {children}
        </Transition>
      </div>
    </div>
  );
}
