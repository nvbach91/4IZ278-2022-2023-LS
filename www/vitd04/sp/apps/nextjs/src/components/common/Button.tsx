"use client";
import { Spinner } from "./Spinner";
import classNames from "clsx";
import React, { AnchorHTMLAttributes, ButtonHTMLAttributes } from "react";

type Props = {
  title?: string;
  loading?: boolean;
  look?: "primary" | "secondary" | "tertiary";
  size?: "sm" | "md";
  dark?: boolean;
  icon?: any;
  as?: any;
} & ButtonHTMLAttributes<HTMLButtonElement> &
  AnchorHTMLAttributes<HTMLAnchorElement>;

// export const Button = React.forwardRef<RNButton, Props>((props, ref) => {
// 	return <RNButton {...props} ref={ref} />;
// });

export const Button = ({
  as: As = "button",
  look = "primary",
  ...props
}: Props) => {
  const getButtonClasses = () => {
    const baseClasses = [props.className];
    const sizeClasses = [
      !props.size && "px-4 py-3",
      props.size === "sm" && "px-4 py-2",
    ];
    let classes = classNames(
      ...baseClasses,
      ...sizeClasses,
      "rounded-lg flex flex-row justify-center items-center relative cursor-pointer",
      "bg-gray-900 hover:bg-gray-800"
    );

    switch (look) {
      case "secondary":
        classes = classNames(
          ...baseClasses,
          ...sizeClasses,
          "rounded-lg flex flex-row justify-center items-center relative cursor-pointer",
          "hover:bg-gray-100 bg-gray-50"
        );
        break;
    }
    return classes;
  };

  const getTextClasses = () => {
    const baseClasses = "text-elipsis font-medium";
    let classes = classNames("text-white text-sm", baseClasses);
    switch (look) {
      case "secondary":
        classes = classNames("text-gray-700 text-sm", baseClasses);
        break;
    }
    return classes;
  };
  return (
    <div className="relative rounded-md">
      <As
        {...props}
        onClick={(e: any) => {
          props.onClick?.(e);
        }}
        disabled={props.disabled}
        style={{
          opacity: props.disabled ? 0.5 : 1,
        }}
        className={getButtonClasses()}
      >
        {props.icon && (
          <div className="mr-3">
            <props.icon className={classNames("h-5 w-5", getTextClasses())} />
          </div>
        )}
        <span className={getTextClasses()}>{props.title}</span>
        {props.children}
      </As>
      {props.loading && (
        <div className="absolute top-0 left-0 z-20 flex h-full w-full items-center justify-center rounded-md bg-gray-600">
          <Spinner />
        </div>
      )}
    </div>
  );
};

Button.displayName = "Button";
