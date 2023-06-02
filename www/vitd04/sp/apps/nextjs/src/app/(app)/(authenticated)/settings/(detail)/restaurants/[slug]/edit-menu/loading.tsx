import { Container } from "@/components/common/Container";
import { PageHeader } from "@/components/common/page-header/PageHeader";
import React from "react";
import { EditMenuHeader } from "./EditMenuHeader";
import { getCookie } from "@/utils/getCookie";
import { api } from "@/lib/api";
import { notFound } from "next/navigation";
import LoadingPagePlaceholder from "@/components/common/LoadingPagePlaceholder";

type Props = {
  params: {
    slug: string;
  };
};

export default function Loading({ params }: Props) {
  return (
    <>
      <EditMenuHeader />
      <Container paddingClassName="mt-6 px-4 flex-1">
        <LoadingPagePlaceholder />
      </Container>
    </>
  );
}
