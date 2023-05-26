<?php

namespace App\Service;

use App\Model\Entity\Comment;
use App\Model\Entity\UserAccount;
use App\Model\UserAccountModel;
use Exception;
use Nette\Mail\Mailer;
use Nette\Mail\Message;

class EmailService
{

    private Mailer $mailer;

    private UserAccountModel $userAccountModel;

    public function __construct(Mailer $mailer, UserAccountModel $userAccountModel)
    {
        $this->mailer = $mailer;
        $this->userAccountModel = $userAccountModel;
    }

    //////////////////////////////////////////////////////// Public

    public function sendCommentAddedEmail(Comment $comment): void
    {
        $adminUserAccount = $this->userAccountModel->findOneBy(['role' => UserAccount::ROLE_ADMIN]);

        $mail = new Message;
        $mail->setFrom('OndryFans <ondryfans@incolorstudio.cz>')
            ->addTo($adminUserAccount->email)
            ->setSubject("Nový komentář u příspěvku #{$comment->post->getId()}")
            ->setBody("U příspěvku #{$comment->post->getId()} byl přidán {$comment->dateCreated->format('d.m.Y G:i')} nový komentář uživatelem {$comment->userAccount->username}. Znění komentáře: \"{$comment->text}\"");

        try {
            $this->mailer->send($mail);
        } catch (Exception $e) {

        }
    }

}
