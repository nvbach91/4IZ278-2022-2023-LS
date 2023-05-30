"use client";
import { Container } from "@/components/common/Container";
import { TextInput } from "@/components/common/TextInput";
import { FormikTextInput } from "@/components/common/formik/FormikTextInput";
import { ImagePickerModal } from "@/components/image-picker/ImagePickerModal";
import { api } from "@/lib/api";
import { Asset } from "@/types/asset";
import { RestaurantWithRelations } from "@/types/restaurant";
import { PhotoIcon } from "@heroicons/react/24/outline";
import { Form, Formik } from "formik";
import { useRouter } from "next/navigation";
import React, { useState } from "react";
import { toast } from "react-toastify";
import { z } from "zod";
import { toFormikValidationSchema } from "zod-formik-adapter";
import { EditRestaurantHeader } from "./EditRestaurantHeader";
import { GoogleMap, Marker } from "react-google-maps";
import { RestaurantLocationPicker } from "./RestaurantLocationPicker";
import { GOOGLE_MAPS_API_KEY } from "@/constants";
import FormikToggle from "@/components/common/formik/FormikToggle";

type Props = {
  restaurant: RestaurantWithRelations;
};

const Schema = z.object({
  name: z
    .string({ required_error: "Jméno je povinné." })
    .min(2, "Jméno musí mít alespoň 2 znaků."),
  address: z
    .string({ required_error: "Adresa je povinná." })
    .min(2, "Adresa musí mít alespoň 2 znaky."),
  city: z
    .string({ required_error: "Město je povinné." })
    .min(2, "Město musí mít alespoň 2 znaky."),
  zip: z
    .string({ required_error: "PSČ je povinné." })
    .min(2, "PSČ musí mít alespoň 2 znaky."),
});

export function RestaurantEditor({ restaurant }: Props) {
  const router = useRouter();

  const restaurantInitialValues = {
    name: restaurant.name || "",
    address: restaurant.address || "",
    city: restaurant.city || "",
    zip: restaurant.zip || "",
    visible: restaurant.visible || false,
  };

  const { mutateAsync: updateRestaurant, isLoading } =
    api.restaurants.update.useMutation({
      onSuccess: (data) => {
        toast.success("Změny byly úspěšně uloženy.");
        router.push(`/settings/restaurants/${data.slug}/edit`);
        router.refresh();
      },
      onError: (error) => {
        toast.error(error?.response?.data?.message || "Nastala chyba.");
      },
    });

  const handleOnRestaurantEdit = async (
    values: typeof restaurantInitialValues
  ) => {
    if (thumbnail === null) {
      toast.error("Vyberte prosím náhledovou fotku.");
      return;
    }
    if (location === null) {
      toast.error("Vyberte prosím polohu restaurace.");
      return;
    }
    await updateRestaurant({
      id: restaurant.id,
      name: values.name,
      address: values.address,
      city: values.city,
      zip: values.zip,
      thumbnail_id: thumbnail?.id,
      lat: location.lat,
      lng: location.lng,
      visible: values.visible,
    });
  };

  // Thumbnail
  const [thumbnail, setThumbnail] = useState<Asset | null>(
    restaurant.thumbnail
  );
  const [imagePickerModalOpen, setImagePickerModalOpen] = useState(false);
  const handleOpenImagePickerModal = (e: any) => {
    e.preventDefault();
    setImagePickerModalOpen(true);
  };
  const handleOnImagePickerModalClose = () => {
    setImagePickerModalOpen(false);
  };
  const handleOnImagePickerModalSelect = (image: Asset) => {
    setThumbnail(image);
  };

  // Location
  const [location, setLocation] = useState<{ lat: number; lng: number } | null>(
    restaurant.lat && restaurant.lng
      ? { lat: restaurant.lat, lng: restaurant.lng }
      : null
  );

  function handleOnLocationSelected(lat: number, lng: number) {
    setLocation({ lat: lat, lng: lng });
  }

  return (
    <>
      <Formik
        validationSchema={toFormikValidationSchema(Schema)}
        initialValues={restaurantInitialValues}
        onSubmit={handleOnRestaurantEdit}
      >
        {({ isSubmitting }) => (
          <Form action="#" method="POST">
            <EditRestaurantHeader isSaving={isLoading} />
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
                      <FormikToggle name="visible" label="Viditelná" />
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
                      <button
                        onClick={handleOpenImagePickerModal}
                        className="p-8 aspect-[24.3/9] w-full rounded-lg flex flex-col justify-center items-center relative hover:bg-gray-900 bg-gray-800"
                      >
                        {thumbnail && (
                          <>
                            <img
                              src={thumbnail.path}
                              className="w-full h-full object-cover rounded-lg absolute"
                            />
                            <div className="absolute inset-0 bg-black bg-opacity-20 rounded-lg" />
                          </>
                        )}
                        <div className="z-50 flex items-center justify-center flex-col">
                          <PhotoIcon className="h-5 w-5 text-white text-sm text-elipsis font-medium" />
                          <span className="text-white text-sm text-elipsis font-medium">
                            Zvolit náhledový obrázek
                          </span>
                        </div>
                      </button>
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
                      <FormikTextInput id="name" name="name" type="text" />
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
                      <FormikTextInput
                        id="address"
                        name="address"
                        type="text"
                      />
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
                      <FormikTextInput id="city" name="city" type="text" />
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
                      <FormikTextInput id="zip" name="zip" type="text" />
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
                      <RestaurantLocationPicker
                        // @ts-ignore
                        onLocationChange={handleOnLocationSelected}
                        location={location}
                        googleMapURL={
                          "https://maps.googleapis.com/maps/api/js?key=" +
                          GOOGLE_MAPS_API_KEY +
                          "&v=3.exp&libraries=geometry,drawing,places"
                        }
                        loadingElement={<div style={{ height: `100%` }} />}
                        containerElement={<div style={{ height: `400px` }} />}
                        mapElement={<div style={{ height: `100%` }} />}
                      />
                    </div>
                  </div>
                </div>
              </div>
            </Container>
          </Form>
        )}
      </Formik>
      <ImagePickerModal
        open={imagePickerModalOpen}
        onClose={handleOnImagePickerModalClose}
        onImageSelected={handleOnImagePickerModalSelect}
      />
    </>
  );
}
