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
  onSelected: () => void;
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

export function AddRestaurantModal({ open, onClose }: Props) {
  const router = useRouter();
  const { mutateAsync: createRestaurant, isLoading } =
    api.restaurants.create.useMutation({
      onSuccess: () => {
        onClose();
        toast.success("Restaurace byla úspěšně přidána.");
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
    await createRestaurant({
      name: values.name,
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
          start={<Modal.Title>Přidat restauraci</Modal.Title>}
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
                  Název restaurace
                </label>
                <div className="mt-2">
                  <FormikTextInput
                    autoFocus
                    id="name"
                    name="name"
                    type="text"
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
                    title="Přidat restauraci"
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
