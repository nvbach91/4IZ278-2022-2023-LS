import React, { useMemo } from "react";
import { SettingsMenu } from "../SettingsMenu";
import { Container } from "@/components/common/Container";
import { usePathname } from "next/navigation";
import classNames from "clsx";

type Props = {
  children: React.ReactNode;
};

function SettingsLayout({ children }: Props) {
  return (
    <Container paddingClassName="sm:px-6 lg:px-8">
      <div className="flex md:space-x-6 md:py-6">
        <div className="hidden md:block">
          <SettingsMenu />
        </div>
        <div className={classNames("flex-1")}>{children}</div>
      </div>
    </Container>
  );
}

export default SettingsLayout;
