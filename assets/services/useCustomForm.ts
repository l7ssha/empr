import { SubmitHandler, useForm, UseFormReturn } from "react-hook-form";
import { ValidationError } from "./ApiService";
import { FilmTypeEnum } from "./dataTypes";
import { DefaultValues } from "react-hook-form/dist/types/form";

export interface UseCustomFormReturn<T> {
  submitHandler: SubmitHandler<T>;
  context: UseFormReturn<T>;
}

export function useCustomForm<T>(submitHandler: SubmitHandler<T>, defaultValues: any = null): UseCustomFormReturn<T> {
  const context = useForm<T>({
    defaultValues: defaultValues,
  } as any);

  const onSubmit = async (data: T) => {
    try {
      await submitHandler(data);
    } catch (e: unknown) {
      if (e instanceof ValidationError) {
        for (const { propertyPath, message } of e.validationResponse.violations) {
          context.setError(propertyPath as any, {
            message: message,
            type: "custom",
          });
        }
      }
    }
  };

  return {
    submitHandler: onSubmit,
    context: context,
  };
}
