import { ModalCloseButton } from "./ModalCloseButton";
import { ModalContent } from "./ModalContent";
import { ModalContext } from "./ModalContext";
import { ModalFooter } from "./ModalFooter";
import { ModalHeader } from "./ModalHeader";
import { ModalScrollView } from "./ModalScrollView";
import { ModalSpacer } from "./ModalSpacer";
import { ModalTitle } from "./ModalTitle";
import { Dialog, Transition } from "@headlessui/react";
import classNames from "clsx";
import { Fragment, UIEventHandler, useMemo } from "react";

export type ModalProps = {
  children: React.ReactNode;
  open: boolean;
  onClose: () => void;
  mode?: "fullscreen" | "auto" | "fullheight" | "mobile-fullscreen";
  maxWidthClassName?: string;
  maxHeightClassName?: string;
  fullscreen?: boolean;
  inBackground?: boolean;
  mobileOnlyInBackground?: boolean;
};
export function Modal({
  children,
  open,
  onClose,
  fullscreen,
  mode = "auto",
  maxWidthClassName = undefined,
  maxHeightClassName = undefined,
  inBackground,
  mobileOnlyInBackground,
}: ModalProps) {
  const handleCloseModal = () => {
    onClose();
  };

  const modalClassNames = useMemo(() => {
    return classNames(
      mode == "fullscreen" &&
        "fixed top-[2.5%] left-0 bottom-0 right-0 h-[97.5vh] sm:bottom-[2.5%] sm:left-[2.5%] sm:right-[2.5%] z-10 w-[95ww] md:h-[95vh]",
      mode == "mobile-fullscreen" &&
        "fixed top-[2.5%] left-0 bottom-0 right-0 h-[97.5vh] sm:bottom-[2.5%] sm:left-[2.5%] sm:right-[2.5%] z-10 w-[95ww] md:h-[95vh] md:inset-auto md:relative md:my-8",
      mode == "auto" && "relative sm:my-8",
      inBackground && "scale-95 -translate-y-[3.5%] ",
      mobileOnlyInBackground &&
        "scale-95 -translate-y-[3.5%] md:scale-100 md:translate-y-0",
      "transform rounded-lg bg-white text-left shadow-xl transition-all rounded-md flex flex-col rounded-t-md lg:rounded-md overflow-hidden",

      maxWidthClassName && maxWidthClassName,
      maxHeightClassName && maxHeightClassName
    );
  }, [
    mode,
    inBackground,
    mobileOnlyInBackground,
    maxWidthClassName,
    maxHeightClassName,
  ]);

  return (
    <ModalContext.Provider
      value={{
        onClose,
        open,
        fullscreen,
      }}
    >
      <Transition.Root show={open} as={Fragment}>
        <Dialog as="div" className="relative z-40" onClose={handleCloseModal}>
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="ease-in duration-100"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <div className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
          </Transition.Child>

          <div className="fixed inset-0 z-10 overflow-y-auto">
            <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
              <Transition.Child
                as={Fragment}
                enter="ease-out duration-300"
                enterFrom="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                enterTo="opacity-100 translate-y-0 sm:scale-100"
                leave="ease-in duration-100"
                leaveFrom="opacity-100 translate-y-0 sm:scale-100"
                leaveTo="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
              >
                <Dialog.Panel className={modalClassNames}>
                  {children}
                </Dialog.Panel>
              </Transition.Child>
            </div>
          </div>
        </Dialog>
      </Transition.Root>
    </ModalContext.Provider>
  );
}

Modal.CloseButton = ModalCloseButton;
Modal.Content = ModalContent;
Modal.Footer = ModalFooter;
Modal.Header = ModalHeader;
Modal.Title = ModalTitle;
Modal.Spacer = ModalSpacer;
Modal.ScrollView = ModalScrollView;
