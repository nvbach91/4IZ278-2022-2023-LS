export type ModalHeaderProps = {
  start?: React.ReactNode;
  end?: React.ReactNode;
};
export function ModalHeader({ start, end }: ModalHeaderProps) {
  return (
    <div className="w-full flex justify-between px-4 pt-4 sticky top-0 z-40 bg-white">
      <div>{start}</div>
      <div>{end}</div>
    </div>
  );
}
