"use client";
import { Button } from "@/components/common/Button";
import { Link } from "@/components/common/Link";
import { Logo } from "@/components/common/Logo";
import { TextInput } from "@/components/common/TextInput";
import { FormikTextInput } from "@/components/common/formik/FormikTextInput";
import { useAuth } from "@/hooks/auth";
import { Form, Formik, FormikHandlers } from "formik";
import { useRouter } from "next/navigation";
import { toast } from "react-toastify";
import { z } from "zod";
import { toFormikValidationSchema } from "zod-formik-adapter";

const Schema = z
  .object({
    email: z
      .string({ required_error: "Email je povinný." })
      .email("Neplatný email."),
    password: z
      .string({ required_error: "Heslo je povinné." })
      .min(5, "Heslo musí mít alespoň 5 znaků."),
    confirmPassword: z
      .string({ required_error: "Heslo je povinné." })
      .min(5, "Heslo musí mít alespoň 5 znaků."),
  })
  .superRefine(({ confirmPassword, password }, ctx) => {
    if (confirmPassword !== password) {
      ctx.addIssue({
        code: "custom",
        message: "Hesla se neshodují.",
        path: ["confirmPassword"],
      });
    }
  });

const registerInitialValues = {
  email: "",
  password: "",
  confirmPassword: "",
};

export default function Register() {
  const router = useRouter();

  const { register } = useAuth({
    middleware: "guest",
    redirectIfAuthenticated: "/",
  });

  const handleOnRegister = async (values: typeof registerInitialValues) => {
    try {
      let res = await register({
        email: values.email,
        password: values.password,
        password_confirmation: values.confirmPassword,
        setErrors: (errors: string[]) => {
          toast.error(errors[0]);
        },
      });
      console.log(res);
      router.push("/login");
    } catch (error: any) {
      toast.error(error?.response?.data?.message || "An error occured.");
    }
  };

  return (
    <div className="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">
      <div className="sm:mx-auto sm:w-full sm:max-w-md">
        <Link href="/">
          <Logo className="mx-auto h-4 w-auto lg:block" alt="Kam za jídlem" />
        </Link>
        <h2 className="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
          Vytvořte si nový účet
        </h2>
      </div>

      <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div className="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
          <Formik
            validationSchema={toFormikValidationSchema(Schema)}
            initialValues={registerInitialValues}
            onSubmit={handleOnRegister}
          >
            {({ isSubmitting }) => (
              <Form className="space-y-6" action="#" method="POST">
                <div>
                  <label
                    htmlFor="email"
                    className="block text-sm font-medium leading-6 text-gray-900"
                  >
                    Emailová adresa
                  </label>
                  <div className="mt-2">
                    <FormikTextInput
                      id="email"
                      name="email"
                      type="email"
                      autoComplete="email"
                    />
                  </div>
                </div>

                <div>
                  <label
                    htmlFor="password"
                    className="block text-sm font-medium leading-6 text-gray-900"
                  >
                    Heslo
                  </label>
                  <div className="mt-2">
                    <FormikTextInput
                      id="password"
                      name="password"
                      type="password"
                      autoComplete="current-password"
                    />
                  </div>
                </div>

                <div>
                  <label
                    htmlFor="confirmPassword"
                    className="block text-sm font-medium leading-6 text-gray-900"
                  >
                    Heslo znovu
                  </label>
                  <div className="mt-2">
                    <FormikTextInput
                      id="confirmPassword"
                      name="confirmPassword"
                      type="password"
                      autoComplete="current-password"
                    />
                  </div>
                </div>

                <div className="w-full">
                  <Button
                    type="submit"
                    title="Zaregistrovat se"
                    className="flex-1 w-full"
                    loading={!!isSubmitting}
                  />
                </div>
              </Form>
            )}
          </Formik>

          <div>
            <div className="relative mt-10">
              <div
                className="absolute inset-0 flex items-center"
                aria-hidden="true"
              >
                <div className="w-full border-t border-gray-200" />
              </div>
              <div className="relative flex justify-center text-sm font-medium leading-6">
                <span className="bg-white px-6 text-gray-900">Nebo</span>
              </div>
            </div>

            <div className="w-full mt-6 flex flex-col space-y-4">
              <Button
                type="submit"
                title="Zaregistrujte se přes Google"
                look="secondary"
                className="flex-1 w-full"
              />
            </div>
          </div>
        </div>

        <p className="mt-10 text-center text-sm text-gray-500">
          Máte již účet? <Link href="/login">Přihlaste se</Link>
        </p>
      </div>
    </div>
  );
}
