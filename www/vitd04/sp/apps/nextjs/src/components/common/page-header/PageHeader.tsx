import React from "react";
import { PageHeaderBackButton } from "./PageHeaderBackButton";
import { PageHeaderTitle } from "./PageHeaderTitle";

type Props = {
  children: React.ReactNode;
};

export function PageHeader({ children }: Props) {
  return (
    <div className="flex space-x-3 items-center py-2 px-2 md:py-0 md:px-0 md:mb-4 shadow-sm md:shadow-none">
      {children}
    </div>
  );
}

PageHeader.BackButton = PageHeaderBackButton;
PageHeader.Title = PageHeaderTitle;
