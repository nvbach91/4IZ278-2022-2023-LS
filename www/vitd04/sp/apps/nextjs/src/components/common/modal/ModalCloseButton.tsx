import { Tooltip } from "../Tooltip";
import { useModalContext } from "./ModalContext";
import { XMarkIcon } from "@heroicons/react/24/outline";

export function ModalCloseButton() {
  const { onClose } = useModalContext();
  const handleClick = () => {
    onClose();
  };
  return (
    <button className="" onClick={handleClick}>
      <XMarkIcon className="w-5 h-5 text-gray-500" />
    </button>
  );
}
