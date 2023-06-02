import { Button } from "@/components/common/Button";
import { Link } from "@/components/common/Link";
import { Logo } from "@/components/common/Logo";

export default function Login() {
  return (
    <div className="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">
      <div className="sm:mx-auto sm:w-full sm:max-w-md">
        <Link href="/">
          <Logo className="mx-auto h-4 w-auto lg:block" alt="Kam za jídlem" />
        </Link>
        <h2 className="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
          Nastala chyba při přihlašování přes externí službu
        </h2>
      </div>

      <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div className="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
          Nastala chyba při přihlašování přes externí službu. Zkuste to prosím
          znovu. Pokud potíže přetrvávají, kontaktujte nás na email
          info@kamzajidlem.cz
        </div>
        <Button as={Link} title="Zkusit znovu" look="primary" />
      </div>
    </div>
  );
}
