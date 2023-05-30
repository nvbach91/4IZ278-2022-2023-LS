export type ModalFooterProps = {
  start?: React.ReactNode;
  end?: React.ReactNode;
};
export function ModalFooter({ start, end }: ModalFooterProps) {
  return (
    <div className="w-full flex justify-between px-4 pb-4 z-40 sticky bottom-0 bg-white">
      <div>{start}</div>
      <div>{end}</div>
    </div>
  );
}
