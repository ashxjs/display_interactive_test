import { useEffect } from "react";
import { useCustomerStore } from "@/stores/customer.store";
import { Customer } from "@/types/customers.type";
import { customerService } from "@/services/customer.service";

type UseCustomersReturnType = {
  customers: Customer[];
};

type UseCustomersType = () => UseCustomersReturnType;

export const useCustomers: UseCustomersType = () => {
  const { customers, setCustomers } = useCustomerStore();

  useEffect(() => {
    const fetchCustomers = async () => {
      const fetchedCustomers = await customerService.getAll();
      setCustomers(fetchedCustomers);
    };

    fetchCustomers();
  }, []);

  return {
    customers,
  };
};
