import { Container } from "@/components/common/Container";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";

type Props = {};

function Page({}: Props) {
  return (
    <>
      <PageHeader>
        <PageHeader.BackButton mobileOnly href="/settings" />
        <PageHeader.Title title="Profil" />
      </PageHeader>
      <Container paddingClassName="mt-6 px-4">
        <div></div>
      </Container>
    </>
  );
}

export default Page;
