import { FunctionComponent } from "react";
import { Customer } from "@/types/customers.type";
import { ShowOrdersButton } from "./ShowOrdersButton";
import { CustomerColumn } from "./CustomerColumn";
import { TableRow } from "@/lib/TableRow";

export const CustomerRow: FunctionComponent<Customer> = ({
  id,
  title,
  lastname,
  firstname,
  postalCode,
  city,
  email,
}) => {
  return (
    <TableRow>
      {[id, title, firstname, lastname, postalCode, city, email].map(
        (field, index) => (
          <CustomerColumn key={`${field}-${index}`} value={field} />
        )
      )}
      <ShowOrdersButton id={id} />
    </TableRow>
  );
};

CustomerRow.displayName = "CustomerRow";
