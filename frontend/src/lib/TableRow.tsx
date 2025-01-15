import { FunctionComponent, PropsWithChildren } from "react";
import cx from "classnames";

type TableRowProps = PropsWithChildren & { shouldHover?: boolean };

export const TableRow: FunctionComponent<TableRowProps> = ({
  children,
  shouldHover = true,
}) => (
  <div
    className={cx(
      "flex flex-row justify-start border-b border-gray-200 dark:border-gray-800 min-h-[50px]",
      shouldHover && "hover:bg-gray-900"
    )}
  >
    {children}
  </div>
);
