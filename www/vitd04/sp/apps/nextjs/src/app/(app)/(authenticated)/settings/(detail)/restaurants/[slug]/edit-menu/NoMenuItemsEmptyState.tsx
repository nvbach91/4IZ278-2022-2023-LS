import { Button } from "@/components/common/Button";
import React from "react";

type Props = {
  odAddMenuItem: () => void;
};

export function NoMenuItemsEmptyState({ odAddMenuItem }: Props) {
  return (
    <div className="px-12 py-10 flex flex-col space-y-3 items-center justify-center rounded-lg border border-gray-200">
      <h2 className="text-xl font-semibold text-center">
        V této sekci zatím nejsou žádné položky
      </h2>
      <p className="text-gray-600 text-sm max-w-sm text-center">
        Přidejte novou položku do jídelního lístku.
      </p>
      <div className="pt-3">
        <Button title="Přidat položku" onClick={odAddMenuItem} />
      </div>
    </div>
  );
}
