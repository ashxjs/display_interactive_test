import { Purchase } from "@/types/purchase.type";

const API_URL = import.meta.env.VITE_BASE_URL || "http://localhost:8080";

type PurchaseJson = {
  id: number;
  customer_id: string;
  productId: number;
  quantity: number;
  price: number;
  currency: string;
  date: string;
};

class PurchaseService {
  private jsonToPurchase(json: PurchaseJson): Purchase {
    return {
      id: json["id"],
      customerId: Number(json["customer_id"]),
      productId: json["productId"],
      quantity: json["quantity"],
      price: json["price"],
      currency: json["currency"],
      date: new Date(json["date"]),
    };
  }

  public async getAllPurchaseByCustomerId(customerId: number) {
    const url = `${API_URL}/customers/${customerId}/orders`;
    try {
      const response = await fetch(url);
      const data = await response.json();
      return data.map(this.jsonToPurchase);
    } catch (error) {
      console.error(error);
      return [];
    }
  }
}

export const purchaseService = new PurchaseService();
