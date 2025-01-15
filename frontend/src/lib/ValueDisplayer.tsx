import { FunctionComponent } from "react";
import cx from "classnames";
import { capitalize as capitalizeFn } from "@/utils/capitalize.util";

type ValueDisplayerProps = {
  value: string | number | Date | null;
  bold?: boolean;
  capitalize?: boolean;
};

export const ValueDisplayer: FunctionComponent<ValueDisplayerProps> = ({
  value,
  bold = false,
  capitalize = false,
}) => {
  let formattedValue =
    typeof value === "string" && capitalize ? capitalizeFn(value) : value;

  if (value instanceof Date) {
    formattedValue = value.toLocaleDateString();
  }

  return (
    <span
      className={cx(
        "flex-1 dark:text-gray-500 text-gray-900 flex justify-center break-keep overflow-x",
        bold && "font-bold"
      )}
    >
      {formattedValue as string}
    </span>
  );
};

ValueDisplayer.displayName = "ValueDisplayer";
