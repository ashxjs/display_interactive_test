import { FunctionComponent } from "react";
import { Purchase } from "@/types/purchase.type";
import { PurchaseColumn } from "./PurchaseColumn";
import { TableRow } from "@/lib/TableRow";

type PurchaseRowProps = Purchase;

export const PurchaseRow: FunctionComponent<PurchaseRowProps> = ({
  id,
  customerId,
  productId,
  quantity,
  price,
  currency,
  date,
}) => {
  return (
    <TableRow>
      {[id, customerId, productId, quantity, price, currency, date].map(
        (field, index) => (
          <PurchaseColumn
            key={`${field}-${index}`}
            value={field as string | number}
          />
        )
      )}
    </TableRow>
  );
};

PurchaseRow.displayName = "PurchaseRow";
