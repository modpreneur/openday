<?php

namespace App\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public function startup()
    {
        parent::startup();

        if (!$this->getHttpRequest()->getCookie('been-here')) {
            $this->template->showCritical = true;
            $this->getHttpResponse()->setCookie('been-here', true, time() + 3600 * 24 * 7);
        } else {
            $this->template->showCritical = false;
        }
    }


    /** @persistent */
    public $locale;

    /** @var \Kdyby\Translation\Translator @inject */
    public $translator;


    /**
     * @return \App\Components\Breadcrumb\Control
     */
    protected function createComponentBreadcrumb()
    {
        return new \App\Components\Breadcrumb\Control;
    }


    /**
     * @param string $name
     * @param string $destination
     * @param array $args
     *
     * @return \App\Components\Breadcrumb\Item
     */
    protected function nav($name, $destination = 'this', array $args = [])
    {
        $name = $this->translator->translate($name);
        return $this['breadcrumb']->add($name, $destination, $args);
    }
}
