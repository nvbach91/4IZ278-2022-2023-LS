<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\CommentLikeModel;
use App\Model\CommentModel;
use App\Model\Entity\Comment;
use App\Model\Entity\CommentLike;
use App\Model\Entity\Post;
use App\Model\Entity\PostLike;
use App\Model\Entity\PostTopic;
use App\Model\Entity\UserAccount;
use App\Model\PostLikeModel;
use App\Model\PostModel;
use App\Model\PostTopicModel;
use App\Model\UserAccountModel;
use App\Service\EmailService;
use App\Service\FacebookOauthService;
use Doctrine\Common\Collections\ArrayCollection;
use Nette;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;
use Nette\DI\Attributes\Inject;
use Nette\Http\FileUpload;
use Nette\Http\SessionSection;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;
use Nette\Utils\ArrayHash;
use Nette\Utils\DateTime;
use Nette\Utils\Image;
use Nette\Utils\Random;


final class HomePresenter extends Nette\Application\UI\Presenter
{

    #[Inject]
    public UserAccountModel $userAccountModel;

    #[Inject]
    public PostModel $postModel;

    #[Inject]
    public PostTopicModel $postTopicModel;

    #[Inject]
    public PostLikeModel $postLikeModel;

    #[Inject]
    public CommentModel $commentModel;

    #[Inject]
    public CommentLikeModel $commentLikeModel;

    #[Inject]
    public EmailService $emailService;

    #[Inject]
    public FacebookOauthService $facebookOauthService;

    private ?int $loadedPostsCount = 1;
    private ?array $loadedComments;

    private ?Post $editedPost = null;

    private ?PostTopic $editedTopic = null;

    #[Persistent]
    public $topic = null;

    //////////////////////////////////////////////////////// Startup

    public function startup()
    {
        parent::startup();

        $this->loadedPostsCount = &$this->session->getSection('loadedPosts')->count;

        if (!$this->isAjax() || !$this->loadedPostsCount) {
            $this->loadedPostsCount = 1;
        }

        $this->loadedComments = &$this->session->getSection('loadedComments')->comments;

        if (!$this->loadedComments) {
            $this->loadedComments = [
                'comments' => [],
                'replies' => []
            ];
        }
    }

    //////////////////////////////////////////////////////// Actions

    public function actionDefault(): void
    {
        $this->template->allTopics = $this->postTopicModel->findAll();
        $this->template->loadedComments = $this->loadedComments;

        if (!isset($this->template->updatedPost)) {
            $firstPost = $this->postModel->findForHomepage($this->topic, 1);
            $firstPost = reset($firstPost);

            $this->template->firstPost = $firstPost;
        }

        $this->template->postsCount = $this->postModel->findAllCount();
        $this->template->postLikesCount = $this->postLikeModel->findAllCount();
        $this->template->postCommentsCount = $this->commentModel->findAllPostCommentsCount();

        $this->template->allUserAccounts = $this->userAccountModel->findBy([], [], 10);
    }

    public function actionLogIn(string $code = null, string $state = null): void
    {
        $loginResult = $this->facebookOauthService->processLogin($code, $state);

        if (!$loginResult) {
            $this->flashMessage('Při přihlašování došlo k chybě.');
        }

        $this->redirect('default');
    }

    public function actionLogOut(): void
    {
        $this->user->logout(true);
        $this->redirect('default');
    }

    //////////////////////////////////////////////////////// Handles

    public function handleLoadNextPost(): void
    {
        $this->loadedPostsCount++;

        $nextPost = $this->postModel->findForHomepage(
            $this->topic,
            $this->loadedPostsCount,
            $this->loadedPostsCount - 1
        );
        $nextPost = reset($nextPost);

        if (!$nextPost) {
            $this->sendJson(['loadedAll' => true]);
        }

        $this->template->updatedPost = $nextPost;

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$nextPost->getId()}");
    }

    public function handleEditPost(int $id): void
    {
        if (!$this->isAllowed()) {
            $this->redirect('default');
        }

        $this->template->editedPost = $this->editedPost = $this->postModel->find($id);
    }

    public function handleDeletePost(int $id): void
    {
        if (!$this->isAllowed()) {
            $this->redirect('default');
        }

        $this->postModel->delete(
            $this->postModel->find($id)
        );

        $this->redirect('this');
    }

    public function handleEditTopic(int $id): void
    {
        if (!$this->isAllowed()) {
            $this->redirect('default');
        }

        $this->template->editedTopic = $this->editedTopic = $this->postTopicModel->find($id);
    }

    public function handleDeleteTopic(int $id): void
    {
        if (!$this->isAllowed()) {
            $this->redirect('default');
        }

        $this->postTopicModel->delete(
            $this->postTopicModel->find($id)
        );

        $this->redirect('this');
    }

    public function handleTogglePostLike(int $id): void
    {
        if (!$this->checkLogin()) {
            return;
        }

        $like = $this->postLikeModel->findOneBy([
            'post' => $id,
            'userAccount' => $this->user->getId()
        ]);

        if ($like) {
            $this->postModel->delete($like);
        } else {
            $like = new PostLike;
            $like->dateCreated = new DateTime;
            $like->post = $this->postModel->find($id);
            $like->userAccount = $this->userAccountModel->find($this->user->getId());

            $this->postLikeModel->save($like);
        }

        $this->template->updatedPost = $this->postModel->find($id);

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$id}");
    }

    public function handleToggleCommentLike(int $id): void
    {
        if (!$this->checkLogin()) {
            return;
        }

        $like = $this->commentLikeModel->findOneBy([
            'comment' => $id,
            'userAccount' => $this->user->getId()
        ]);

        if ($like) {
            $this->commentLikeModel->delete($like);
        } else {
            $like = new CommentLike;
            $like->dateCreated = new DateTime;
            $like->comment = $this->commentModel->find($id);
            $like->userAccount = $this->userAccountModel->find($this->user->getId());

            $this->commentLikeModel->save($like);
        }

        $comment = $this->commentModel->find($id);

        $this->template->updatedPost = $comment->post;

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$id}");
    }

    public function handleAddComment(int $id, int $parentId = null): void
    {
        if (!$this->checkLogin()) {
            return;
        }

        $text = $this->getHttpRequest()->getPost('text');

        $comment = new Comment;
        $comment->post = $this->postModel->find($id);
        $comment->userAccount = $this->userAccountModel->find($this->user->getId());
        $comment->parentComment = $parentId
            ? $this->commentModel->find($parentId)
            : null;
        $comment->dateCreated = new DateTime;
        $comment->text = $text;

        $this->commentModel->save($comment);

        $this->emailService->sendCommentAddedEmail($comment);

        $this->template->updatedPost = $this->postModel->find($id);

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$id}");
    }

    public function handleDeleteComment(int $id): void
    {
        if (!$this->isAllowed('deleteComment', $id)) {
            $this->redirect('default');
        }

        $comment = $this->commentModel->find($id);
        $post = $comment->post;

        $this->commentModel->delete(
            $comment
        );

        $this->template->updatedPost = $post;

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$id}");
    }

    public function handleToggleLoadedComments(int $id): void
    {
        if (isset($this->loadedComments['comments'][$id])) {
            unset($this->loadedComments['comments'][$id]);
        } else {
            $this->loadedComments['comments'][$id] = true;
        }

        $this->template->loadedComments = $this->loadedComments;
        $this->template->updatedPost = $this->postModel->find($id);

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$id}");
    }

    public function handleToggleLoadedReplies(int $id): void
    {
        if (isset($this->loadedComments['replies'][$id])) {
            unset($this->loadedComments['replies'][$id]);
        } else {
            $this->loadedComments['replies'][$id] = true;
        }

        $comment = $this->commentModel->find($id);

        $this->template->loadedComments = $this->loadedComments;
        $this->template->updatedPost = $comment->post;

        $this->redrawControl('postsArea');
        $this->redrawControl("post-{$comment->post->getId()}");
    }

    //////////////////////////////////////////////////////// Public

    public function isAllowed(string $action = null, int $id = null): bool
    {
        $isAdmin = $this->user->isInRole(UserAccount::ROLE_ADMIN);

        if ($isAdmin) {
            return true;
        }

        if (!$action) {
            return $isAdmin;
        }

        if ($action === 'deleteComment') {
            $comment = $this->commentModel->find($id);

            return $comment->userAccount->getId() === $this->user->getId();
        }

        return false;
    }

    public function checkLogin(): bool
    {
        if (!$this->user->isLoggedIn()) {
            $this->flashMessage("Pro tuto akci se musíš přihlásit.");
            $this->redrawControl('flashes');

            return false;
        }

        return true;
    }

    //////////////////////////////////////////////////////// Components

    protected function createComponentPostForm(): Form
    {
        $form = new Form;
        $form->setAction($this->getHttpRequest()->getUrl());

        $form->addUpload('image', 'Obrázek')
            ->addRule($form::MIME_TYPE, 'Soubor musí být obrázek (.png nebo .jpg).', ['image/jpeg', 'image/png'])
            ->setRequired(
                !$this->getParameter('id')
                    ? 'Pole "Obrázek" je povinné.'
                    : false
            );

        $form->addTextArea('text', 'Text')
            ->setRequired('Pole "Text" je povinné.');

        $form->addMultiSelect('topics', 'Štítky', $this->postTopicModel->findPairs())
            ->setRequired('Pole "Štítky" je povinné.');

        $form->addSubmit('submit', 'Uložit');

        if ($post = $this->editedPost) {
            $form->addHidden('id', $post->getId());

            $defaults = [];
            $defaults['text'] = $post->text;
            $defaults['topics'] = array_map(fn(PostTopic $topic) => $topic->getId(), $post->topics->toArray());

            $form->setDefaults($defaults);
        }

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $id = $form->getHttpData()['id'] ?? null; //override nette validation

            if ($id) {
                $post = $this->postModel->find($id);
            } else {
                $post = new Post;
                $post->dateCreated = new DateTime;
                $post->user = $this->userAccountModel->find(
                    $this->user->getId()
                );
            }

            $topics = new ArrayCollection;
            foreach ($values->topics as $topicId) {
                $topics->add(
                    $this->postTopicModel->find($topicId)
                );
            }

            /** @var FileUpload $image */
            $image = $values->image;
            if ($image->isOk()) {
                $imageName = Random::generate(20) . '.jpg';

                Image::fromFile($image->getTemporaryFile())
                    ->save(__DIR__ . '/../../www/img/post/' . $imageName, null, Image::JPEG);

                $post->postPhoto = $imageName;
            }

            $post->text = $values->text;
            $post->topics = $topics;

            if ($post->getId()) {
                $post->dateUpdated = new DateTime;
            }

            $this->postModel->save($post);

            $this->redirect('this');
        };

        return $form;
    }

    protected function createComponentPostLabelForm(): Form
    {
        $form = new Form;
        $form->setAction($this->getHttpRequest()->getUrl());

        $form->addText('title', 'Název')
            ->setRequired('Pole "Název" je povinné.');

        $form->addText('color', 'Barva')
            ->setHtmlAttribute('type', 'color')
            ->setRequired('Pole "Barva" je povinné.');

        $form->addSubmit('submit', 'Uložit');

        if ($topic = $this->editedTopic) {
            $form->addHidden('id', $topic->getId());

            $defaults = [];
            $defaults['title'] = $topic->title;
            $defaults['color'] = $topic->color;

            $form->setDefaults($defaults);
        }

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $id = $form->getHttpData()['id'] ?? null; //override nette validation

            if ($id) {
                $postTopic = $this->postTopicModel->find($id);
            } else {
                $postTopic = new PostTopic();
            }

            $postTopic->title = $values->title;
            $postTopic->color = $values->color;

            $this->postTopicModel->save($postTopic);

            $this->redirect('this');
        };

        return $form;
    }

    protected function createComponentAdminLoginForm(): Form
    {
        $form = new Form;

        $form->addText('login', 'Login')
            ->setRequired('Pole "Login" je povinné.');

        $form->addPassword('password', 'Heslo')
            ->setRequired('Pole "Heslo" je povinné.');

        $form->addSubmit('submit', 'Přihlásit se');

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $userAccount = $this->userAccountModel->findOneBy(['email' => $values->login]);

            if (!$userAccount) {
                $form->addError('Nesprávný login nebo heslo.');

                return;
            }

            $passwords = new Passwords();

            if (!$passwords->verify($values->password, $userAccount->password)) {
                $form->addError('Nesprávný login nebo heslo.');

                return;
            }

            $identity = new SimpleIdentity(
                $userAccount->getId(),
                $userAccount->role
            );

            $this->user->login($identity);

            $this->redirect('this');
        };

        return $form;
    }

}
