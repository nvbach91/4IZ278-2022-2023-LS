import { useModalContext } from "./ModalContext";
import classNames from "clsx";

export type ModalContentProps = {
  children?: React.ReactNode;
  className?: string;
};
export function ModalContent({ children, className }: ModalContentProps) {
  const { fullscreen } = useModalContext();
  return (
    <div
      className={classNames(["w-full px-4", fullscreen && "flex-1", className])}
    >
      {children}
    </div>
  );
}
