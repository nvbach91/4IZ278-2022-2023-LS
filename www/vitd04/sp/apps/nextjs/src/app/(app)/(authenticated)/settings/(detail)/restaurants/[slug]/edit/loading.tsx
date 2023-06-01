import { Container } from "@/components/common/Container";
import React from "react";
import { EditRestaurantHeader } from "./EditRestaurantHeader";
import { Spinner } from "@/components/common/Spinner";

type Props = {};

export default function loading({}: Props) {
  return (
    <>
      <EditRestaurantHeader isSaving={true} />
      <Container paddingClassName="mt-6 px-4 flex-1 space-y-6">
        <div className="space-y-6">
          {/* Thumbnail */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="name"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Viditelná
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-4">
                <Spinner />
              </div>
            </div>
          </div>

          {/* Thumbnail */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="name"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Záhlaví
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-4">
                <div className="p-8 aspect-[24.3/9] w-full rounded-lg flex flex-col justify-center items-center relative hover:bg-gray-900 bg-gray-800">
                  <Spinner />
                </div>
              </div>
            </div>
          </div>

          {/* Name */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="name"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Název
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-5">
                <Spinner />
              </div>
            </div>
          </div>

          {/* Address */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="address"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Ulice a číslo popisné
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-3">
                <Spinner />
              </div>
            </div>
          </div>

          {/* Město */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="city"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Město
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-3">
                <Spinner />
              </div>
            </div>
          </div>

          {/* PSČ */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="zip"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                PSČ
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-2">
                <Spinner />
              </div>
            </div>
          </div>

          {/* Location */}
          <div className="grid grid-cols-1 gap-x-8 gap-y-4 border-b border-gray-900/10 pb-6 md:grid-cols-3">
            <div>
              <label
                htmlFor="zip"
                className="text-base font-semibold leading-7 text-gray-900"
              >
                Poloha
              </label>
            </div>

            <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
              <div className="sm:col-span-6">
                <Spinner />
              </div>
            </div>
          </div>
        </div>
      </Container>
    </>
  );
}
