import classNames from "clsx";
import React from "react";

type Props = {
  className?: string;
  containerClassName?: string;
};

export function Spinner({ className, containerClassName }: Props) {
  return (
    <div className={containerClassName} role="status">
      <svg
        aria-hidden="true"
        className={classNames("animate-spin-fast", className)}
        width="25"
        height="25"
        viewBox="0 0 25 25"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fillRule="evenodd"
          clipRule="evenodd"
          d="M12.8049 24.9964C12.7035 24.9988 12.6019 25 12.5 25C5.59644 25 0 19.4036 0 12.5C0 5.59644 5.59644 0 12.5 0C19.3016 0 24.8345 5.43242 24.9964 12.1951H21.9952C21.8342 7.08951 17.6447 3 12.5 3C7.25329 3 3 7.25329 3 12.5C3 17.7467 7.25329 22 12.5 22C12.602 22 12.7036 21.9984 12.8049 21.9952V24.9964Z"
          fill="url(#paint0_linear_1017_58)"
        />
        <defs>
          <linearGradient
            id="paint0_linear_1017_58"
            x1="12.4982"
            y1="12"
            x2="12.4982"
            y2="25"
            gradientUnits="userSpaceOnUse"
          >
            <stop stopColor="currentColor" />
            <stop offset="1" stopColor="currentColor" stopOpacity="0" />
          </linearGradient>
        </defs>
      </svg>

      <span className="sr-only">Loading...</span>
    </div>
  );
}
