"use client";
import { Button } from "@/components/common/Button";
import { FormikTextInput } from "@/components/common/formik/FormikTextInput";
import { Modal } from "@/components/common/modal/Modal";
import { api } from "@/lib/api";
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
  restaurantId: string;
};

const Schema = z.object({
  name: z
    .string({ required_error: "Název je povinný." })
    .min(3, { message: "Název musí mít alespoň 3 znaky." })
    .max(50, { message: "Název může mít maximálně 50 znaků." }),
});

const createRestaurantInitialValues = {
  name: "",
};

export function AddMenuSectionModal({
  open,
  onClose,
  onAdded,
  restaurantId,
}: Props) {
  const router = useRouter();
  const { mutateAsync: createMenuSection, isLoading } =
    api.menuSections.create.useMutation({
      onSuccess: () => {
        onAdded();
        toast.success("Sekce byla úspěšně přidána.");
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

  const handleOnCreateRestaurant = async (
    values: typeof createRestaurantInitialValues
  ) => {
    await createMenuSection({
      name: values.name,
      restaurant_id: restaurantId,
    });
  };

  return (
    <Modal
      open={open}
      onClose={handleClose}
      maxHeightClassName="w-full max-w-md"
      mode="auto"
    >
      <div className="shadow-sm z-40">
        <Modal.Header
          start={<Modal.Title>Přidat sekci</Modal.Title>}
          end={<Modal.CloseButton />}
        />
        <Modal.Spacer />
      </div>
      <Formik
        validationSchema={toFormikValidationSchema(Schema)}
        initialValues={createRestaurantInitialValues}
        onSubmit={handleOnCreateRestaurant}
      >
        {({ isSubmitting }) => (
          <Form action="#" method="POST">
            <Modal.Spacer />
            <Modal.Content className="space-y-6">
              <div>
                <label
                  htmlFor="name"
                  className="block text-sm font-medium leading-6 text-gray-900"
                >
                  Název sekce
                </label>
                <div className="mt-2">
                  <FormikTextInput
                    autoFocus
                    id="name"
                    name="name"
                    type="text"
                    placeholder="např. Předkrmy"
                  />
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
                    title="Přidat sekci"
                    loading={isLoading}
                  />
                </>
              }
            />
          </Form>
        )}
      </Formik>
    </Modal>
  );
}
