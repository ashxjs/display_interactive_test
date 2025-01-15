import { FunctionComponent, PropsWithChildren } from "react";
import cx from "classnames";

type TableColumnProps = PropsWithChildren & {
  className?: string;
  shouldHover?: boolean;
  border?: boolean;
};

export const TableColumn: FunctionComponent<TableColumnProps> = ({
  children,
  className,
  shouldHover = true,
}) => (
  <div
    className={cx(
      "flex-1 p-3 [&:not(:last-child)]:border-r border-gray-200 dark:border-gray-800 w-[100px] flex justify-center items-center",
      className,
      shouldHover && "hover:bg-gray-800"
    )}
  >
    {children}
  </div>
);
