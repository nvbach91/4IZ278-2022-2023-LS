<?php
session_start();
require realpath(__DIR__ . '/..') . '/includes/header.php';
require realpath(__DIR__ . '/..') . '/messages.php';
require_once realpath(__DIR__ . '/..') . '/utils/Utils.php';
require realpath(__DIR__ . '/..') . '/utils/Form.php';
require_once ('../utils/Database.php');
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';

$utils = Utils::getInstance();
$db = $utils -> getDB();
$form = null;
$errors = null;
if (!empty($_POST)) {
    $form = new Form();
    $errors = $form -> validate($messages, $language);
}
if (!is_null($errors) && !count($errors)) {
    $status = $utils -> saveUser($form);
    var_dump($status);
    if ($status) {
        $user = $db -> getUserByEmail($form -> getEmail());
        setcookie('userID', $user[0]['user_id'], time() + 3600);
        header('Location: ../utils/setSession.php?page=home');
    } else {
        $errors['user'] = 'exists';
    }
}
?>

<body id=<?php echo $theme; ?>>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <form class='registration<?php echo $theme ?>' method='POST' action="registration.php">
            <h4 class='register_title'><?php echo $messages['registration'][$language]; ?></h4>
            <div class='line'>
                <div class='field' style='padding-right: 55px'>
                    <p class='field_p'>E-mail*:</p>
                    <input 
                        type='text' 
                        id='login_field' 
                        placeholder="<?php echo $messages['inputEmail'][$language]; ?>" 
                        name='e-mail'
                        value = '<?php echo $form ? $form -> getEmail() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['email'])): ?>
                    <div class = 'reg_error'>
                        <p class = 'reg_p'><?php echo $errors['email']; ?></p>
                    </div>
                <?php endif; ?>
                <div class='field'>
                    <p class='field_p'><?php echo $messages['phoneNumber'][$language]; ?></p>
                    <input 
                        type='text'
                        inputmode='numeric'
                        id='login_field' 
                        placeholder="<?php echo $messages['inputPhone'][$language]; ?>" 
                        name='phoneNumber'
                        value = '<?php echo $form ? $form -> getPhoneNumber() : '' ?>'
                    />
                </div>
                <?php if($errors && isset($errors['phoneNumber'])): ?>
                    <div class = 'reg_error_right'>
                        <p class = 'reg_p'><?php echo $errors['phoneNumber']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='line'>
                <div class='field' style='padding-right: 55px'>
                    <p class='field_p'><?php echo $messages['firstName'][$language]; ?></p>
                    <input 
                        type='text' 
                        id='login_field' 
                        placeholder="<?php echo $messages['inputFirstName'][$language]; ?>" 
                        name='firstName'
                        value = '<?php echo $form ? $form -> getFirstName() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['firstName'])): ?>
                    <div class = 'reg_error'>
                        <p class = 'reg_p'><?php echo $errors['firstName']; ?></p>
                    </div>
                <?php endif; ?>
                <div class='field'>
                    <p class='field_p'><?php echo $messages['lastName'][$language]; ?></p>
                    <input 
                        type='text' 
                        id='login_field' 
                        placeholder="<?php echo $messages['inputLastName'][$language]; ?>" 
                        name='lastName'
                        value = '<?php echo $form ? $form -> getLastName() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['lastName'])): ?>
                    <div class = 'reg_error_right'>
                        <p class = 'reg_p'><?php echo $errors['lastName']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='line'>
                <div class='field'>
                    <p class='field_p'><?php echo $messages['dateOfBirth'][$language]; ?></p>
                    <input 
                        type='date' 
                        id='login_field' 
                        name='dateOfBirth'
                        value = '<?php echo $form ? $form -> getDateOfBirth() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['dateOfBirth'])): ?>
                    <div class = 'reg_error'>
                        <p class = 'reg_p'><?php echo $errors['dateOfBirth']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='line'>
                <div class='field' style='padding-right: 55px'>
                    <p class='field_p'><?php echo $messages['password'][$language]; ?></p>
                    <input 
                        type='password' 
                        id='login_field' 
                        placeholder="<?php echo $messages['inputPassword'][$language]; ?>" 
                        name='password'
                        value = '<?php echo $form ? $form -> getPassword() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['password'])): ?>
                    <div class = 'reg_error'>
                        <p class = 'reg_p'><?php echo $errors['password']; ?></p>
                    </div>
                <?php endif; ?>
                <div class='field'>
                    <p class='field_p'><?php echo $messages['passwordConfirmation'][$language]; ?></p>
                    <input 
                        type='password' 
                        id='login_field' 
                        placeholder="<?php echo $messages['inputPasswordConfirmation'][$language]; ?>" 
                        name='passwordConfirmation'
                        value = '<?php echo $form ? $form -> getPasswordConfirmation() : '' ?>'
                    >
                </div>
                <?php if($errors && isset($errors['passwordConfirmation'])): ?>
                    <div class = 'reg_error_right'>
                        <p class = 'reg_p'><?php echo $errors['passwordConfirmation']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='line'>

                <?php if ($errors && isset($errors['user'])): ?>
                    <div class = 'exists_error'>
                        <p class = 'exists_error_p'><?php echo $messages['alreadyExists'][$language]; ?>
                            <a class = 'blue' href = '../utils/setSession.php?page=main'><?php echo $messages['goToLoginPage'][$language]; ?> 
                            </a>
                        </p>
                    </div>
                <?php endif; ?>

                <div class='field' id='agreement'>
                    <p class='agreement_p'>I agree with <a style = 'color: aqua'>
                        <a class = 'blue' href = '../utils/setSession.php?page=terms'>terms of use</a>
                    </a></p>
                    <input 
                        type='checkbox' 
                        name='terms' 
                        class='agreement_input'
                        <?php echo ($form && $form -> getAccept()) ? 'checked' : '' ?>
                    >
                </div>
            </div>
            <?php if($errors && isset($errors['terms'])): ?>
                    <div class = 'reg_error_terms'>
                        <p class = 'reg_p'><?php echo $errors['terms']; ?></p>
                    </div>
                <?php endif; ?>
            <input 
                type='submit' 
                class = 'registration_button'
                style = 'padding-left: <?php echo $language === 'CZ' ? '105px' : '135px';?>'
                value = <?php echo $messages['register'][$language]; ?>
            >
            </input>

        </form>
    </main>
</body>