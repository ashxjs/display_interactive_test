import { FunctionComponent } from "react";
import { ValueDisplayer } from "@/lib/ValueDisplayer";
import { TableColumn } from "@/lib/TableColumn";

type PurchaseColumnProps = {
  value: string | number;
};

export const PurchaseColumn: FunctionComponent<PurchaseColumnProps> = ({
  value,
}) => {
  return (
    <TableColumn>
      <ValueDisplayer value={value} />
    </TableColumn>
  );
};

PurchaseColumn.displayName = "PurchaseColumn";
