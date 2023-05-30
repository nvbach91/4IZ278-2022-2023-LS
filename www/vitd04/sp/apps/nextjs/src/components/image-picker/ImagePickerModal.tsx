"use client";

import React, { useState } from "react";
import { Modal } from "../common/modal/Modal";
import { Button } from "../common/Button";
import { ArrowUpTrayIcon } from "@heroicons/react/24/outline";
import { api } from "@/lib/api";
import { Spinner } from "../common/Spinner";
import { toast } from "react-toastify";
import classNames from "clsx";
import { Asset } from "@/types/asset";

type Props = {
  open: boolean;
  onClose: () => void;
  onImageSelected: (image: Asset) => void;
};

export function ImagePickerModal({ open, onClose, onImageSelected }: Props) {
  const handleClose = (e?: any) => {
    e?.preventDefault();
    onClose();
  };

  const { data, refetch: refetchImages } = api.assets.getAll.useQuery({});

  // Selecting image
  const [selectedImage, setSelectedImage] = useState<Asset | null>(null);
  const handleSelectImage = (image: Asset) => {
    setSelectedImage(image);
  };
  const { mutateAsync: uploadFile, isLoading: isUploading } =
    api.assets.upload.useMutation({
      onError: (error) => {
        toast.error(error.message);
        refetchImages();
      },
      onSuccess: () => {
        toast.success("Obrázek byl nahrán");
        refetchImages();
      },
    });

  const handleComplete = () => {
    if (!selectedImage) return;
    onImageSelected(selectedImage);
    handleClose();
  };

  const handleUploadImage: React.ChangeEventHandler<HTMLInputElement> = async (
    e
  ) => {
    const file = e.target.files?.[0];
    if (!file) return;
    console.log(file);
    var data = new FormData();
    data.append("image", file);
    console.log(data);
    await uploadFile(data);
    e.target.value = "";
  };

  return (
    <Modal
      open={open}
      onClose={handleClose}
      maxWidthClassName="md:w-full md:max-w-6xl"
      maxHeightClassName="md:max-h-[80vh]"
      mode="mobile-fullscreen"
    >
      {isUploading && (
        <div className="absolute inset-0 h-full w-full flex items-center justify-center bg-black/20 z-[60]">
          <Spinner />
        </div>
      )}
      <div className="sticky top-0 bg-white shadow-sm z-50">
        <Modal.Header
          start={
            <div className="flex space-x-4 items-center z-[70]">
              <Modal.Title>Zvolit obrázek</Modal.Title>
              <Button
                as="label"
                // @ts-ignore
                htmlFor="fileupload"
                look="secondary"
                title="Nahrát obrázek"
                icon={ArrowUpTrayIcon}
              >
                <input
                  id="fileupload"
                  name="fileuupload"
                  type="file"
                  className="sr-only"
                  onChange={handleUploadImage}
                ></input>
              </Button>
            </div>
          }
          end={<Modal.CloseButton />}
        />
        <Modal.Spacer />
      </div>
      <Modal.ScrollView className="h-full relative">
        <div className="h-full">
          <div className="grid grid-flow-row-dense grid-cols-12 gap-4 rounded-lg p-6">
            {data?.map((asset) => (
              <button
                key={asset.id}
                onClick={() => handleSelectImage(asset)}
                className={classNames(
                  "col-span-6 sm:col-span-4 md:col-span-3 lg:col-span-2 aspect-square rounded-lg overflow-hidden",
                  selectedImage?.id === asset.id
                    ? "shadow-xsml ring-2 ring-green-500 ring-offset-2"
                    : "border-transparent"
                )}
              >
                <img
                  src={asset.path}
                  alt={asset.name}
                  className="w-full aspect-square"
                />
              </button>
            ))}
          </div>
        </div>
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
                title="Zvolit"
                onClick={handleComplete}
                disabled={!selectedImage}
              />
            </>
          }
        />
      </Modal.ScrollView>
    </Modal>
  );
}
