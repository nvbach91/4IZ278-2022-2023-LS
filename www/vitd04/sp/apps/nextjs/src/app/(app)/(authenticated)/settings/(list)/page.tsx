"use client";
import React from "react";
import { SettingsMenu } from "../SettingsMenu";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import { Container } from "@/components/common/Container";

type Props = {};

function SettingsMenuPage({}: Props) {
  return (
    <div>
      <div className="md:hidden">
        <PageHeader>
          <PageHeader.BackButton href="/" />
          <PageHeader.Title title="Nastavení" />
        </PageHeader>
      </div>
      <Container paddingClassName="px-4 pt-6 md:pt-0 md:px-0">
        <SettingsMenu />
      </Container>
    </div>
  );
}

export default SettingsMenuPage;
