"use client";
import { Button } from "@/components/common/Button";
import { FormikTextArea } from "@/components/common/formik/FormikTextArea";
import { FormikTextInput } from "@/components/common/formik/FormikTextInput";
import { Modal } from "@/components/common/modal/Modal";
import { ImagePickerModal } from "@/components/image-picker/ImagePickerModal";
import { api } from "@/lib/api";
import { Asset } from "@/types/asset";
import { PlusIcon, PhotoIcon } from "@heroicons/react/24/outline";
import { Form, Formik } from "formik";
import { useRouter } from "next/navigation";
import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import { z } from "zod";
import { toFormikValidationSchema } from "zod-formik-adapter";

type Props = {
  open: boolean;
  onClose: () => void;
  onAdded: () => void;
  sectionId: number;
};

const Schema = z.object({
  name: z
    .string({ required_error: "Název je povinný." })
    .min(3, { message: "Název musí mít alespoň 3 znaky." })
    .max(50, { message: "Název může mít maximálně 50 znaků." }),
  description: z
    .string({ required_error: "Popis je povinný." })
    .min(0, { message: "Popis musí mít alespoň 3 znaky." })
    .max(256, { message: "Popis může mít maximálně 128 znaků." })
    .optional(),
  kcal: z
    .number({ required_error: "Kcal je povinné." })
    .min(0, { message: "Kcal musí být kladné číslo." })
    .max(10000, { message: "Kcal může mít maximálně 10000." }),
  protein: z
    .number({ required_error: "Bílkobiny jsou povinné." })
    .min(0, { message: "Bílkoviny musí být kladné číslo." })
    .max(10000, { message: "Protein může mít maximálně 10000." }),
  carbs: z
    .number({ required_error: "Sacharidy jsou povinné" })
    .min(0, { message: "Sacharidy musí být kladné číslo." })
    .max(10000, { message: "Sacharidy mohou mít maximálně 10000." }),
  fat: z
    .number({ required_error: "Tuk je povinný." })
    .min(0, { message: "Tuk musí být kladné číslo." })
    .max(10000, { message: "Tuk může mít maximálně 10000." }),
  amountInGrams: z
    .number({ required_error: "Množství je povinné." })
    .min(0, { message: "Množství musí být kladné číslo." })
    .max(10000, { message: "Množství může mít maximálně 10000." }),
});

const createMenuItemInitialValues = {
  name: "",
  description: "",
  kcal: null,
  protein: null,
  carbs: null,
  fat: null,
  amountInGrams: null,
};

export function AddMenuItemModal({ open, onClose, onAdded, sectionId }: Props) {
  const router = useRouter();
  const [thumbnail, setThumbnail] = useState<Asset | null>(null);
  const { mutateAsync: createMenuItem, isLoading } =
    api.menuItems.create.useMutation({
      onSuccess: () => {
        onAdded();
        toast.success("Položka byla úspěšně přidána.");
        router.refresh();
      },
      onError: (error) => {
        toast.error(error?.response?.data?.message || "Nastala chyba.");
      },
    });

  const handleClose = (e?: any) => {
    e?.preventDefault();
    onClose();
  };

  const handleOnCreateMenuItem = async (
    values: typeof createMenuItemInitialValues
  ) => {
    console.log({
      name: values.name,
      description: values.description,
      kcal: values.kcal || 0,
      protein: values.protein || 0,
      carbs: values.carbs || 0,
      fat: values.fat || 0,
      amount_in_grams: values.amountInGrams || 0,
      menu_section_id: sectionId,
      thumbnail_id: thumbnail?.id,
    });
    await createMenuItem({
      name: values.name,
      description: values.description,
      kcal: values.kcal || 0,
      protein: values.protein || 0,
      carbs: values.carbs || 0,
      fat: values.fat || 0,
      amount_in_grams: values.amountInGrams || 0,
      menu_section_id: sectionId,
      thumbnail_id: thumbnail?.id,
    });
  };

  // Thumbnail
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

  return (
    <Modal
      open={open}
      onClose={handleClose}
      maxWidthClassName="md:w-full md:max-w-6xl"
      maxHeightClassName="md:max-h-[80vh]"
      mode="mobile-fullscreen"
      inBackground={imagePickerModalOpen}
    >
      <div className="sticky top-0 bg-white shadow-sm z-40">
        <Modal.Header
          start={<Modal.Title>Přidat položku</Modal.Title>}
          end={<Modal.CloseButton />}
        />
        <Modal.Spacer />
      </div>
      <Modal.ScrollView className="h-full">
        <Formik
          validationSchema={toFormikValidationSchema(Schema)}
          initialValues={createMenuItemInitialValues}
          onSubmit={handleOnCreateMenuItem}
        >
          {({ isSubmitting }) => (
            <Form
              action="#"
              method="POST"
              className="flex-1 flex flex-col min-h-full"
            >
              <Modal.Spacer />
              <Modal.Content className="grid grid-cols-12 gap-6 flex-1 w-full">
                <div className="space-y-6 col-span-12 md:col-span-7">
                  <div>
                    <label
                      htmlFor="name"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Náhledový obrázek
                    </label>
                    <div>
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
                  <div>
                    <label
                      htmlFor="name"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Název
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="name"
                        name="name"
                        type="text"
                        placeholder="např. Pho Bo"
                      />
                    </div>
                  </div>
                  <div>
                    <label
                      htmlFor="name"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Popis
                    </label>
                    <div className="mt-2">
                      <FormikTextArea
                        autoFocus
                        id="description"
                        name="description"
                        type="text"
                      />
                    </div>
                  </div>
                </div>
                <div className="space-y-6 col-span-12 md:col-span-5">
                  <div>
                    <label
                      htmlFor="amountInGrams"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Množství v grammech
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="amountInGrams"
                        name="amountInGrams"
                        type="number"
                        placeholder="např. 440"
                      />
                    </div>
                  </div>
                  <div>
                    <label
                      htmlFor="kcal"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Kcal (na porci)
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="kcal"
                        name="kcal"
                        type="number"
                        placeholder="např. 690"
                      />
                    </div>
                  </div>
                  <div>
                    <label
                      htmlFor="protein"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Bílkoviny v gramech (na porci)
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="protein"
                        name="protein"
                        type="number"
                        placeholder="např. 30"
                      />
                    </div>
                  </div>
                  <div>
                    <label
                      htmlFor="carbs"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Sacharidy v gramech (na porci)
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="carbs"
                        name="carbs"
                        type="number"
                        placeholder="např. 60"
                      />
                    </div>
                  </div>
                  <div>
                    <label
                      htmlFor="fat"
                      className="block text-sm font-medium leading-6 text-gray-900"
                    >
                      Tuky v gramech (na porci)
                    </label>
                    <div className="mt-2">
                      <FormikTextInput
                        autoFocus
                        id="fat"
                        name="fat"
                        type="number"
                        placeholder="např. 20"
                      />
                    </div>
                  </div>
                </div>
              </Modal.Content>
              <Modal.Spacer />
              <Modal.Footer
                start={
                  <>
                    <Button
                      onClick={handleClose}
                      look="secondary"
                      type="submit"
                      title="Zrušit"
                    />
                  </>
                }
                end={
                  <>
                    <Button
                      type="submit"
                      title="Přidat položku"
                      loading={isLoading}
                    />
                  </>
                }
              />
            </Form>
          )}
        </Formik>
      </Modal.ScrollView>
      <ImagePickerModal
        open={imagePickerModalOpen}
        onClose={handleOnImagePickerModalClose}
        onImageSelected={handleOnImagePickerModalSelect}
      />
    </Modal>
  );
}
