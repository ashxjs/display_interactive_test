export type Purchase = {
  id: number;
  customerId: number;
  productId: number;
  quantity: number;
  price: number;
  currency: string;
  date: Date;
};
