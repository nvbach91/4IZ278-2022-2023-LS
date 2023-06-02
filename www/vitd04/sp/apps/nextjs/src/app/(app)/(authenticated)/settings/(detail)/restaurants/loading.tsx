import LoadingPagePlaceholder from "@/components/common/LoadingPagePlaceholder";
import React from "react";
import { SettingsRestaurantsHeader } from "./SettingsRestaurantsHeader";
import { Container } from "@/components/common/Container";

type Props = {};

export default function loading({}: Props) {
  return (
    <>
      <SettingsRestaurantsHeader />
      <Container paddingClassName="mt-6 px-3">
        <div className="flex flex-col space-y-3">
          <LoadingPagePlaceholder />;
        </div>
      </Container>
    </>
  );
}
