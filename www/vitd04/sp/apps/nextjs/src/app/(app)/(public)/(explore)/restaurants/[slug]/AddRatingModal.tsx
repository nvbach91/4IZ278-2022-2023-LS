"use client";
import { Button } from "@/components/common/Button";
import { FormikTextInput } from "@/components/common/formik/FormikTextInput";
import { Modal } from "@/components/common/modal/Modal";
import { api } from "@/lib/api";
import { Rating } from "@/types/rating";
import { StarIcon } from "@heroicons/react/24/solid";
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
  existingRating: Rating | null;
  restaurantId: string;
};

export function AddRatingModal({
  open,
  onClose,
  onAdded,
  restaurantId,
  existingRating,
}: Props) {
  const router = useRouter();

  const { mutateAsync: addRating, isLoading } = api.ratings.create.useMutation({
    onSuccess: () => {
      onAdded();
      toast.success("Hodnocení bylo úspěšně přidáno.");
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

  const handleRate = async (rating: number) => {
    await addRating({
      rating,
      restaurant_id: restaurantId,
    });
  };

  const [hoveredRating, setHoveredRating] = useState<number | null>(null);

  return (
    <Modal
      open={open}
      onClose={handleClose}
      maxHeightClassName="w-full max-w-md"
      mode="auto"
    >
      <div className="shadow-sm z-40">
        <Modal.Header
          start={<Modal.Title>Přidat hodnocení</Modal.Title>}
          end={<Modal.CloseButton />}
        />
        <Modal.Spacer />
      </div>
      <Modal.Spacer />
      <Modal.Content className="space-y-6">
        <div className="flex justify-center">
          <div className="flex space-x-2">
            {[1, 2, 3, 4, 5].map((rating) => (
              <button
                key={rating}
                onClick={() => handleRate(rating)}
                className="rounded-full w-8 h-8 flex justify-center items-center bg-gray-100 hover:bg-gray-200"
                onMouseEnter={() => setHoveredRating(rating)}
                onMouseLeave={() => setHoveredRating(null)}
              >
                {rating <= (hoveredRating || existingRating?.rating || 0) ? (
                  <StarIcon className="w-5 h-5 text-yellow-500" />
                ) : (
                  <StarIcon className="w-5 h-5 text-gray-400" />
                )}
              </button>
            ))}
          </div>
        </div>
      </Modal.Content>
      <Modal.Spacer />
    </Modal>
  );
}
