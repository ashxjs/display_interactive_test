import { create } from "zustand";
import { Purchase } from "@/types/purchase.type";
import { purchaseService } from "@/services/purchase.service";

type PurchaseStore = {
  purchases: Purchase[];
  getCustomerPurchases: (customerId: number) => Promise<Purchase[]>;
};

export const usePurchaseStore = create<PurchaseStore>((set, get) => ({
  purchases: [],
  setPurchases: (purchases: Purchase[]) => set({ purchases }),
  getCustomerPurchases: async (customerId: number) => {
    const { purchases } = get();

    const customerPurchases = purchases.filter(
      (purchase) => purchase.customerId === customerId
    );

    if (customerPurchases.length > 0) {
      set({ purchases: customerPurchases });
      return customerPurchases;
    }

    const fetchedPurchases = await purchaseService.getAllPurchaseByCustomerId(
      customerId
    );

    if (fetchedPurchases.length >= 0) {
      set({ purchases: fetchedPurchases });
      return fetchedPurchases;
    }

    return [];
  },
}));
