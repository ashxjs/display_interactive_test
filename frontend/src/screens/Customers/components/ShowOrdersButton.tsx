import { FunctionComponent, memo } from "react";
import { NavLink } from "react-router";

type ShowOrdersButtonProps = {
  id: string;
};

export const ShowOrdersButton: FunctionComponent<ShowOrdersButtonProps> = memo(
  ({ id }) => (
    <NavLink
      to={`/customers/${id}`}
      className="py-2 px-3 rounded-xl border-gray-500 border"
    >
      <span className="dark:text-gray-500 text-[black]" role="button">
        Show orders 🛒
      </span>
    </NavLink>
  )
);

ShowOrdersButton.displayName = "ShowOrdersButton";
