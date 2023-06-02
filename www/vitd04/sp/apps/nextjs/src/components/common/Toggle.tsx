import React from "react";
import { Switch } from "@headlessui/react";
import classNames from "clsx";

type Props = {
  children?: React.ReactNode;
  value: boolean;
  label: string;
  onChange: (value: boolean) => void;
};

export function Toggle({ children, value, onChange, label }: Props) {
  return (
    <Switch
      checked={value}
      onChange={onChange}
      className={classNames(
        value ? "bg-green-600" : "bg-gray-200",
        "relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2"
      )}
    >
      <span className="sr-only">Use setting</span>
      <span
        aria-hidden="true"
        className={classNames(
          value ? "translate-x-5" : "translate-x-0",
          "pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
        )}
      />
    </Switch>
  );
  return (
    <div className="flex items-center w-12 h-12">
      <div className="form-switch w-12 h-12">
        <input
          type="checkbox"
          id="switch-1"
          className="sr-only"
          checked={value}
          onChange={() => onChange(!value)}
        />
        <label className="bg-gray-400block" htmlFor="switch-1">
          <span className="bg-white shadow-sm" aria-hidden="true"></span>
          <span className="sr-only">{label}</span>
        </label>
      </div>
      {children && (
        <div className="text-sm text-gray-400 italic ml-2">{children}</div>
      )}
    </div>
  );
}
