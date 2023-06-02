import React, { useMemo } from "react";
import { SettingsMenu } from "../SettingsMenu";
import { Container } from "@/components/common/Container";
import { usePathname } from "next/navigation";
import classNames from "clsx";

type Props = {
  children: React.ReactNode;
  profile: React.ReactNode;
};

function SettingsLayout({ children, profile }: Props) {
  return (
    <Container paddingClassName="sm:px-6 lg:px-8">
      <div className="flex md:space-x-6 md:py-6">
        <div className="w-full md:w-auto">{children}</div>
        <div className={classNames("flex-1 hidden md:block")}>{profile}</div>
      </div>
    </Container>
  );
}

export default SettingsLayout;
