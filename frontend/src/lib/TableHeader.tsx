import { FunctionComponent } from "react";
import { ValueDisplayer } from "./ValueDisplayer";

type TableHeaderProps = {
  columns: string[];
};

export const TableHeader: FunctionComponent<TableHeaderProps> = ({
  columns,
}) => {
  return (
    <div className="flex flex-row justify-start items-center gap-4 p-3 border-b border-gray-200 dark:border-gray-800">
      {columns.map((column) => (
        <div className="flex-1" key={column}>
          <ValueDisplayer bold capitalize value={column} />
        </div>
      ))}
    </div>
  );
};

TableHeader.displayName = "TableHeader";
