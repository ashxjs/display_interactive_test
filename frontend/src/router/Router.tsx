import { Route, Routes } from "react-router";
import { Customers } from "@/screens/Customers/Customers";
import { CustomerOrders } from "@/screens/CustomerOrders/CustomerOrders";

export const Router = () => {
  return (
    <Routes>
      <Route index element={<Customers />} />
      <Route path="customers">
        <Route index element={<Customers />} />
        <Route path=":id" element={<CustomerOrders />} />
      </Route>
    </Routes>
  );
};

Router.displayName = "Router";
