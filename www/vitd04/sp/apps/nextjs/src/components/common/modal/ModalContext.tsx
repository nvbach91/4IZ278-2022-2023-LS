import { createContext, useContext } from "react";

export const ModalContext = createContext<{
  open: boolean;
  onClose: () => void;
  fullscreen?: boolean;
} | null>(null);

export function useModalContext() {
  const context = useContext(ModalContext);
  if (!context) {
    throw new Error(
      "Modal.* component must be rendered as child of Modal component."
    );
  }
  return context;
}
