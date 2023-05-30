import { Button } from "@/components/common/Button";
import React from "react";

type Props = {
  onAddSection: () => void;
};

export function NoSectionEmptyState({ onAddSection }: Props) {
  return (
    <div className="px-12 py-10 flex flex-col space-y-3 items-center justify-center rounded-lg border border-gray-200">
      <h2 className="text-xl font-semibold text-center">
        Zatím nemáte v jídelním lístku žádnou sekci
      </h2>
      <p className="text-gray-600 text-sm max-w-sm text-center">
        Začněte vytvořením nové sekce. Sekce může být např. dezerty, hlavní
        jídla, nápoje atd.
      </p>
      <div className="pt-3">
        <Button title="Vytvořit sekci" onClick={onAddSection} />
      </div>
    </div>
  );
}
