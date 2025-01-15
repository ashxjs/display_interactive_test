import { useEffect, useState } from "react";
import { usePurchaseStore } from "@/stores/purchase.store";
import { useParams } from "react-router";

const DEVISE = {
  euros: 1,
  dollars: 1,
};

export const useCustomerOrders = () => {
  const [isLoading, setIsLoading] = useState(false);
  const { purchases, getCustomerPurchases } = usePurchaseStore();
  const { id } = useParams();

  useEffect(() => {
    if (id) {
      setIsLoading(true);
      const fetchCustomerPurchases = async () => {
        await getCustomerPurchases(Number.parseInt(id));
        setIsLoading(false);
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

  return { purchases, totalPrice, isLoading };
};
