import { NavBar } from "./components/NavBar";
import { Table } from "./components/Table";
import { useCustomerOrders } from "./hooks/use-customer-orders.hook";

export const CustomerOrders = () => {
  const { purchases, totalPrice } = useCustomerOrders();

  return (
    <div className="flex flex-col p-5">
      <NavBar />
      <Table purchases={purchases} totalPrice={totalPrice} />
    </div>
  );
};

CustomerOrders.displayName = "CustomerOrders";
