<?php

class Card
{
    public static function render(Person $person)
    {
        ?>
        <div class="flex space-x-4 justify-center py-8">
            <div class="bg-black w-[600px] h-[300px] text-white flex space-x-12 p-12 items-center rounded-md shadow-xl">
                <div>
                    <img src="<?php echo $person->avatarUrl; ?>" alt="" class="w-36" />
                </div>
                <div class="flex-1">
                    <h1 class="font-bold text-3xl">
                        <?php echo $person->getFullName() . " (" . $person->getAge() . ")"; ?>
                    </h1>
                    <span class="text-xs text-gray-400">
                        <?php echo $person->role; ?> @
                        <?php echo $person->company->name; ?>
                    </span>
                    <a href="<?php echo $person->company->web; ?>" class="text-xs text-indigo-400 block">
                        <?php echo $person->company->web; ?>
                    </a>

                    <div class="mt-3">
                        <?php
                        if ($person->lookingForWork) {
                            echo "Looking for opportunities";
                        } else {
                            echo "Not looking for opportunities";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="bg-black w-[600px] h-[300px] p-12 text-white space-y-4 rounded-md shadow-xl">
                <div>
                    <h1>
                        <?php echo $person->company->name; ?>
                    </h1>
                    <p>
                        <?php echo $person->company->getAddress(); ?>
                    </p>
                    <p>
                        <?php echo $person->company->zip; ?>
                        <?php echo $person->company->city; ?>
                    </p>
                </div>
                <div>
                    <h1 class="uppercase text-xs text-gray-400 font-bold">Kontakt</h1>
                    <p class="text-sm">Phone:
                        <?php echo $person->phone; ?>
                    </p>
                    <p class="text-sm">Email:
                        <?php echo $person->email; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php
    }
}
?>