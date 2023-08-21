import { ControllerProps, FieldValues } from "react-hook-form";

export function makeMaxLengthRule(maxLength: number): ControllerProps<FieldValues>["rules"] {
  return {
    maxLength: {
      value: maxLength,
      message: `Max length allowed: ${maxLength}`,
    },
  };
}

export function makePositiveRule(): ControllerProps<FieldValues>["rules"] {
  return {
    min: {
      value: 1,
      message: `Value has to be positive number (greater than 0)`,
    },
  };
}
