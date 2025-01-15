import { create } from "zustand";
import { Customer } from "@/types/customers.type";

type CustomerStore = {
  customers: Customer[];
  setCustomers: (customers: Customer[]) => void;
};

export const useCustomerStore = create<CustomerStore>((set) => ({
  customers: [],
  setCustomers: (customers: Customer[]) => set({ customers }),
}));
