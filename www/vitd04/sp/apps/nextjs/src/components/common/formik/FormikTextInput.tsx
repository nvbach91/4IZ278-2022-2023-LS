import { TextInput } from "../TextInput";
import classNames from "clsx";
import { FieldHookConfig, useField } from "formik";
import React from "react";

type Props = { className?: string } & FieldHookConfig<string>;

export function FormikTextInput(props: Props) {
  const [field, meta] = useField(props);
  return (
    <div className="w-full">
      <TextInput
        {...field}
        className={props.className}
        isError={meta.touched && !!meta.error}
        placeholder={props.placeholder}
        type={props.type}
      />
      {meta.touched && meta.error ? (
        <div className="text-xs mt-1 text-rose-500">{meta.error}</div>
      ) : null}
    </div>
  );
}
