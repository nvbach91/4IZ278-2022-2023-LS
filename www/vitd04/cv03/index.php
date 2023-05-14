<?php

require_once("partials/header.php");

$errors = [];

$name = null;
$sex = null;
$email = null;
$phone = null;
$profilePicture = null;

$allowed_sexes = ['male', 'female', 'neutral'];

if (!empty($_POST)) {
    $name = $_POST["name"] ?? null;
    $sex = $_POST["sex"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $profilePicture = $_POST["profile-picture"] ?: null;

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($sex)) {
        $errors[] = "Sex is required";
    } else if (!in_array($sex, $allowed_sexes)) {
        $errors[] = "Sex is invalid";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }

    if (empty($phone)) {
        $errors[] = "Phone is required";
    }

    if (empty($profilePicture)) {
        $errors[] = "Profile picture is required";
    }

    if (empty($errors)) {
        $name = null;
        $sex = null;
        $email = null;
        $phone = null;
        $profilePicture = null;
    }
}
?>

<form class="space-y-8 divide-y divide-gray-200 mx-auto max-w-xl py-12" method="POST"
    action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
        <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
            <div>
                <h3 class="text-base font-semibold leading-6 text-gray-900">Registrace hráče</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Vyplňte prosím všechny následující údaje.</p>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were
                                <?php echo count($errors) ?> errors with your submission
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc space-y-1 pl-5">
                                    <?php foreach ($errors as $error): ?>
                                        <li>
                                            <?php echo $error ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif (empty($errors) && !empty($_POST)): ?>
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Registrace byla úspěšná</h3>
                            <div class="mt-2 text-sm text-green-700">
                                <p>Byl jste úspěšně zaregistrován do turnaje!</p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif ?>

            <div class="space-y-6 sm:space-y-5">
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Celé
                        jméno <span class="text-red-400">*</span></label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input type="text" name="name" id="name" autocomplete="name" value="<?php echo $name ?? "" ?>"
                            class="block w-full max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div role="group" aria-labelledby="label-sex">
                    <div
                        class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                        <div>
                            <div class="text-sm font-semibold leading-6 text-gray-900" id="label-sex">
                                Pohlaví <span class="text-red-400">*</span></div>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="max-w-lg">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="neutral" name="sex" type="radio" value="neutral" <?php if ($sex == "neutral")
                                            echo "checked" ?>
                                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            <label for="neutral"
                                                class="ml-3 block text-sm font-medium leading-6 text-gray-900">Neutrální</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="male" name="sex" type="radio" value="male" <?php if ($sex == "male")
                                            echo "checked" ?>
                                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            <label for="male"
                                                class="ml-3 block text-sm font-medium leading-6 text-gray-900">Muž</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="female" name="sex" type="radio" value="female" <?php if ($sex == "female") {
                                            echo "checked";
                                        } ?>
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="female"
                                            class="ml-3 block text-sm font-medium leading-6 text-gray-900">Žena</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Email
                        <span class="text-red-400">*</span></label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input id="email" name="email" type="text" autocomplete="email" placeholder="example@vse.cz"
                            value="<?php echo $email ?? "" ?>"
                            class="block w-full max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Telefonní
                        číslo <span class="text-red-400">*</span></label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input type="tel" name="phone" id="phone" autocomplete="tel" placeholder="+420 735 123 456"
                            value="<?php echo $phone ?? "" ?>"
                            class="block w-full max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                    <label for="profile-picture"
                        class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Profilový
                        obrázek <span class="text-red-400">*</span></label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input id="profile-picture" name="profile-picture" type="text"
                            value="<?php echo $profilePicture ?? "" ?>"
                            class="block w-full max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <spna class="text-xs text-gray-500">Example: https://eso.vse.cz/~nguv03/cv03/img/homer.jpg
                        </spna>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-5">
        <div class="flex justify-end gap-x-3">
            <button type="submit"
                class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </div>
</form>

<?php require_once("partials/footer.php") ?>