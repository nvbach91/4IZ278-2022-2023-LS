import { subscribe } from "diagnostics_channel";
import React from "react";

type Props = {
  title: string;
  subtitle?: string;
};

export function PageHeaderTitle({ title, subtitle }: Props) {
  return (
    <div className="flex flex-col items-start justify-start space-y-1 flex-1">
      <h1 className="text-xl md:text-3xl font-semibold">{title}</h1>
      <span className="text-xs  text-gray-600">{subtitle}</span>
    </div>
  );
}
