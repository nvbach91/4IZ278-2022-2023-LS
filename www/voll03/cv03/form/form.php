<?php require __DIR__ . '/validation.php'; ?>

<form class="m-8 p-8 w-[400px] bg-[#333333]/10 rounded-xl text-white" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php include __DIR__ . '/error-panel.php' ?>

    <div class="flex items-center mt-2 mb-2">
        <label class="w-[128px]">Name</label>
        <input class="grow m-1 p-1 rounded-md text-black" name="name" value="<?php echo isset($name) ? $name : '' ?>">
    </div>

    <div class="flex items-center mt-2 mb-2">
        <label class="w-[128px]">Gender</label>
        <select name="gender" class="grow m-1 p-1 rounded-md text-black">
            <option value="" disabled selected hidden>Choose your gender</option>
            <option value="M" <?php echo (isset($gender) && $gender === 'M') ? 'selected' : ''; ?>>Male</option>
            <option value="F" <?php echo (isset($gender) && $gender === 'F') ? 'selected' : ''; ?>>Female</option>
            <option value="O" <?php echo (isset($gender) && $gender === 'O') ? 'selected' : ''; ?>>Other</option>
        </select>
    </div>

    <div class="flex items-center mt-2 mb-2">
        <label class="w-[128px]">E-mail</label>
        <input class="grow m-1 p-1 rounded-md text-black" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>

    <div class="flex items-center mt-2 mb-2">
        <label class="w-[128px]">Phone number</label>
        <input class="grow m-1 p-1 rounded-md text-black" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>

    <div class="flex items-center mt-2 mb-2">
        <label class="w-[128px]">Avatar URL</label>
        <input class="grow m-1 p-1 rounded-md text-black" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>

    <div class="flex items-center mb-2">
        <label class="w-1/2">Card deck name</label>
        <input class="w-1/2 m-1 p-1 rounded-md text-black" name="deck" value="<?php echo isset($deck) ? $deck : ''; ?>">
    </div>

    <div class="flex">
        <label class="w-3/4">Number of cards in deck</label>
        <input class="w-1/4 m-1 p-1 rounded-md text-black" name="cardsCount" value="<?php echo isset($cardsCount) ? $cardsCount : ''; ?>">
    </div>

    <button class="block m-auto mt-4 py-2 px-4 rounded-md border-2 border-[#0c1435] bg-[#060918] hover:bg-[#130935] hover:border-[#3a0849]" type="submit">Submit</button>
</form>