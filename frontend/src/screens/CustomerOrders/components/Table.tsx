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

type TableProps = {
  isLoading: boolean;
  purchases: Purchase[];
  totalPrice: number;
};

export const Table: FunctionComponent<TableProps> = ({
  purchases,
  totalPrice,
  isLoading,
}) => (
  <>
    <TableHeader columns={columns} />
    {isLoading ? (
      <div className="flex justify-center items-center h-full p-5">
        <span className="text-2xl font-bold text-gray-500 text-center">
          Loading...
        </span>
      </div>
    ) : null}
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
    {purchases.length === 0 && !isLoading && (
      <TableRow shouldHover={false}>
        <TableColumn border={false} shouldHover={false}>
          <ValueDisplayer value="No purchases found" />
        </TableColumn>
      </TableRow>
    )}
  </>
);
