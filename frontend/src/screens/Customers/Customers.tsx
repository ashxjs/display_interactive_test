import { TableHeader } from "@/lib/TableHeader";
import { CustomerRow } from "./components/CustomerRow";
import { useCustomers } from "./hooks/use-customers.hook";

const columns = [
  "id",
  "title",
  "firstname",
  "lastname",
  "postalCode",
  "city",
  "email",
  "actions",
];

export const Customers = () => {
  const { customers } = useCustomers();

  return (
    <div className="flex flex-col p-5">
      <TableHeader columns={columns} />
      {customers.map((customer) => (
        <CustomerRow key={customer.id} {...customer} />
      ))}
    </div>
  );
};

Customers.displayName = "Customers";
