import { FieldHookConfig, useField } from "formik";
import React from "react";
import { Toggle } from "../Toggle";

type Props = {
  children?: React.ReactNode;
  label: string;
} & FieldHookConfig<boolean>;

function FormikToggle(props: Props) {
  const [field, meta] = useField({ ...props, type: "checkbox" });
  const handleOnChange = (value: typeof props.value) => {
    const event = {
      target: {
        type: "change",
        id: props.id,
        name: props.name,
        value: value,
      },
    };

    field.onChange(event);
  };
  return (
    <div>
      <Toggle
        {...field}
        label={props.label}
        onChange={(value: any) => handleOnChange(value)}
        value={field.value as typeof props.value}
      >
        {props.children}
      </Toggle>
      {meta.touched && meta.error ? (
        <div className="text-xs mt-1 text-rose-500">{meta.error}</div>
      ) : null}
    </div>
  );
}

export default FormikToggle;
