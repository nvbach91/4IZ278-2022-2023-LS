"use client";
import { Button } from "@/components/common/Button";
import { Container } from "@/components/common/Container";
import LandingAutocompleteInput from "@/app/(app)/(public)/LandingAutocompleteInput";
import Image from "next/image";

export default function Home() {
  return (
    <Container>
      <div className="py-10 flex md:mt-20 flex-col md:flex-row px-4 space-y-12 md:space-y-0 md:items-center w-full">
        <div className="flex-1">
          <h1 className="text-3xl lg:text-5xl font-semibold max-w-lg leading-tight">
            Objevte restaurace, ve kterých víte, co jíte.
          </h1>
          <p className="max-w-lg mt-5 text-gray-500">
            Jíst v restauracích může být pro lidi snažící se hlídat si makra
            nebo kalorie velmi komplikované, někdy až nemožné. My chceme toto
            změnit.
          </p>
          <div className="mt-8 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 w-full">
            <LandingAutocompleteInput />
            <Button title="Zobrazit&nbsp;restaurace" />
          </div>
        </div>
        <Image
          width={400}
          height={300}
          className="object-fill"
          src="/images/landing-food.png"
          alt=""
        />
      </div>
    </Container>
  );
}
