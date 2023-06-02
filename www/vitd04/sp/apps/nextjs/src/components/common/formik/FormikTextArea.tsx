import { FieldHookConfig, useField } from "formik";
import React from "react";
import { TextArea } from "../TextArea";

type Props = { className?: string } & FieldHookConfig<string>;

export function FormikTextArea(props: Props) {
  const [field, meta] = useField(props);
  return (
    <div className="w-full">
      <TextArea
        {...field}
        className={props.className}
        isError={meta.touched && !!meta.error}
        placeholder={props.placeholder}
      />
      {meta.touched && meta.error ? (
        <div className="text-xs mt-1 text-rose-500">{meta.error}</div>
      ) : null}
    </div>
  );
}
