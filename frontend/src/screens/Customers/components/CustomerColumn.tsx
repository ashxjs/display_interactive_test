import { FunctionComponent } from "react";
import { ValueDisplayer } from "@/lib/ValueDisplayer";
import { TableColumn } from "@/lib/TableColumn";

type CustomerColumnProps = {
  value: string | number;
  className?: string;
};

export const CustomerColumn: FunctionComponent<CustomerColumnProps> = ({
  value,
  className,
}) => {
  const shouldHover = value !== "" && value !== null && value !== undefined;

  return (
    <TableColumn shouldHover={shouldHover} className={className}>
      <ValueDisplayer value={value} />
    </TableColumn>
  );
};

CustomerColumn.displayName = "CustomerColumn";
