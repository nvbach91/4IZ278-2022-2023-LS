<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

    /**
     * Function which adds some needed properties as template variables to all subpages.
     *
     * @return void     Function has no return value.
     */
    protected function startup() {

        parent::startup();

        $httpRequest = $this->getHttpRequest();
        $url = $httpRequest->getUrl();

        $this->template->cookies = $httpRequest->getCookies();
        $this->template->protocol = $httpRequest->getUrl()->scheme;
        $this->template->urlParams = explode('/', trim(strtok($url->getPath(), '?'), "/"));

    }

}