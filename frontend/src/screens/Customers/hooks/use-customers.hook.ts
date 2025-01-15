import { useEffect, useState } from "react";
import { useCustomerStore } from "@/stores/customer.store";
import { Customer } from "@/types/customers.type";
import { customerService } from "@/services/customer.service";

type UseCustomersReturnType = {
  customers: Customer[];
  isLoading: boolean;
};

type UseCustomersType = () => UseCustomersReturnType;

export const useCustomers: UseCustomersType = () => {
  const { customers, setCustomers } = useCustomerStore();
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    const fetchCustomers = async () => {
      setIsLoading(true);
      const fetchedCustomers = await customerService.getAll();

      const delay = setTimeout(() => {
        setIsLoading(false);
        setCustomers(fetchedCustomers);
        clearTimeout(delay);
      }, 350);
    };

    fetchCustomers();
  }, [setCustomers]);

  return {
    customers,
    isLoading,
  };
};
