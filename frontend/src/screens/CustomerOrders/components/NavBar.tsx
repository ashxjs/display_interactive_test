import { FunctionComponent } from "react";
import { NavLink } from "react-router";

export const NavBar: FunctionComponent = () => (
  <div className="flex items-center gap-5">
    <NavLink to="/customers" className="text-gray-900 dark:text-gray-500">
      <span className="text-3xl">←</span>
    </NavLink>
    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-500">
      Customer Orders
    </h1>
  </div>
);
