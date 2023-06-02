import { VerticalMenuItem } from "./VerticalMenuItem";
type Props = {
  children: React.ReactNode;
};
export function VerticalMenu({ children }: Props) {
  return (
    <nav className="flex w-full md:w-64 flex-col" aria-label="Sidebar">
      <ul role="list" className="-mx-2 md:space-y-1 space-y-2">
        {children}
      </ul>
    </nav>
  );
}

VerticalMenu.Item = VerticalMenuItem;
