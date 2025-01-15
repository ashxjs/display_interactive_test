import { useEffect } from "react";
import { usePurchaseStore } from "@/stores/purchase.store";
import { useParams } from "react-router";

const DEVISE = {
  euros: 1,
  dollars: 1,
};

export const useCustomerOrders = () => {
  const { purchases, getCustomerPurchases } = usePurchaseStore();
  const { id } = useParams();

  useEffect(() => {
    if (id) {
      const fetchCustomerPurchases = async () => {
        await getCustomerPurchases(id);
      };

      fetchCustomerPurchases();
    }
  }, [id, getCustomerPurchases]);

  const totalPrice = purchases.reduce(
    (acc, purchase) =>
      acc +
      purchase.quantity *
        purchase.price *
        DEVISE[purchase.currency as keyof typeof DEVISE],
    0
  );

  return { purchases, totalPrice };
};
