import { TableHeader } from "@/lib/TableHeader";
import { useCustomers } from "./hooks/use-customers.hook";
import { CustomersTable } from "./components/CustomersTable";

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
  const { customers, isLoading } = useCustomers();

  return (
    <div className="flex flex-col p-5">
      <TableHeader columns={columns} />
      <CustomersTable isLoading={isLoading} customers={customers} />
    </div>
  );
};

Customers.displayName = "Customers";
