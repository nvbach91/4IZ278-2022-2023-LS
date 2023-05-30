"use client";
import { Rating } from "@/types/rating";
import React from "react";
import { AddRatingModal } from "./AddRatingModal";
import { Button } from "@/components/common/Button";
import { useRouter } from "next/navigation";

type Props = {
  existingRating: Rating | null;
  restaurantId: string;
};

function AddRatingButton({ existingRating, restaurantId }: Props) {
  const router = useRouter();
  const [open, setOpen] = React.useState(false);
  const handleOpen = () => setOpen(true);
  const handleClose = () => setOpen(false);
  const handleOnRatingAdded = () => {
    router.refresh();
    handleClose();
  };

  return (
    <>
      <Button look="primary" title="Přidat hodnocení" onClick={handleOpen} />
      <AddRatingModal
        open={open}
        onClose={handleClose}
        onAdded={handleOnRatingAdded}
        existingRating={existingRating}
        restaurantId={restaurantId}
      />
    </>
  );
}

export default AddRatingButton;
