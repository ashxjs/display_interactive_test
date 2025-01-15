import { FunctionComponent } from "react";
import { Purchase } from "@/types/purchase.type";
import { TableHeader } from "@/lib/TableHeader";
import { TableRow } from "@/lib/TableRow";
import { TableColumn } from "@/lib/TableColumn";
import { ValueDisplayer } from "@/lib/ValueDisplayer";
import { PurchaseRow } from "./PurchaseRow";

const columns = [
  "id",
  "customerId",
  "productId",
  "quantity",
  "price",
  "currency",
  "date",
];

export const Table: FunctionComponent<{
  purchases: Purchase[];
  totalPrice: number;
}> = ({ purchases, totalPrice }) => (
  <>
    <TableHeader columns={columns} />
    {purchases.map((purchase) => (
      <PurchaseRow key={purchase.id} {...purchase} />
    ))}
    {purchases.length > 0 ? (
      <TableRow shouldHover={false}>
        {["", "", "", "", "", "Total", totalPrice].map((value, index) => (
          <TableColumn
            border={value !== ""}
            key={`${value}-${index}`}
            shouldHover={false}
          >
            <ValueDisplayer value={value} />
          </TableColumn>
        ))}
      </TableRow>
    ) : null}
    {purchases.length === 0 && (
      <TableRow shouldHover={false}>
        <TableColumn border={false} shouldHover={false}>
          <ValueDisplayer value="No purchases found" />
        </TableColumn>
      </TableRow>
    )}
  </>
);
