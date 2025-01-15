import { Customer } from "@/types/customers.type";
import { FunctionComponent } from "react";
import { CustomerRow } from "./CustomerRow";

type CustomersTableProps = {
  isLoading: boolean;
  customers: Customer[];
};

export const CustomersTable: FunctionComponent<CustomersTableProps> = ({
  isLoading,
  customers,
}) => {
  if (isLoading) {
    return (
      <div className="flex justify-center items-center h-full p-5">
        <span className="text-2xl font-bold text-gray-500 text-center">
          Loading...
        </span>
      </div>
    );
  }

  return customers.map((customer) => (
    <CustomerRow key={customer.id} {...customer} />
  ));
};

CustomersTable.displayName = "CustomersTable";
