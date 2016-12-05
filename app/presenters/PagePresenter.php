<?php

namespace App\Presenters;

use Nette\Database\Table\IRow;
use Nette\Application\UI;
use Nette\Utils\DateTime;

/**
 * Class PagePresenter
 * @package App\Presenters
 */
class PagePresenter extends BasePresenter
{
    /**
     * @var string
     *
     * @persistent
     */
    public $pageName;

    /**
     * @var  IRow
     */
    protected $page;

    /**
     * @var \App\Model\PageManager @inject
     */
    public $pageManager;


    /**
     * Prepare page
     * @throws \Nette\Application\BadRequestException
     */
    public function actionPage()
    {
        $this->page = $page = $this
            ->pageManager
            ->getPageByName($this->pageName, $this->locale);

        if (!$page) {
            $this->error('Omlouváme se, ale tato stránka neexistuje.');
        }
    }


    /**
     * Render page
     * Set data to view
     */
    public function renderPage()
    {
        $this->template->page = $this->page;
    }


    public function renderList()
    {
        $this->template->pages = $this->pageManager->findAll();
    }



    public function actionEdit($id = null)
    {
        $this->page = $page = $this
            ->pageManager->get($id);

        if (!$page && $id !== null) {
            $this->error('Omlouváme se, ale tato stránka neexistuje.');
        }
    }


    public function renderEdit($id = null)
    {
        if ($this->page) {
            $this['editForm']->setValues($this->page);
        }

        $this->template->page = $this->page;
    }


    public function actionRemove($id = null)
    {
        $this->pageManager->remove($id);
        $this->redirect('Page:list');
    }


    public function createComponentEditForm()
    {
        $form = new UI\Form;

        $form->addText('page_name', 'Url')
            ->setAttribute('placeholder', 'URL');

        $form->addText('title', 'Title')
            ->setAttribute('placeholder', 'Title');

        $form->addSelect('lang', 'Jazyk', [
            'cz' => 'Czech',
            'en' => 'English',
        ]);

        $form->addTextArea('jumbotron', 'Jumbotron:')
            ->setAttribute('placeholder', 'Popis stránky');

        $form->addTextArea('content', 'Obsah')
            ->setAttribute('placeholder', 'Obsah stránky');

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = [$this, 'savePage'];

        return $form;
    }


    /**
     * Save or create new page.
     *
     * @param UI\Form $form
     *
     * @throws \Nette\Application\AbortException
     */
    public function savePage(UI\Form $form, $values)
    {
        $values->updatedAt = new DateTime();
        $page = $this->page;

        if ($page) {
            $this->pageManager->update($values, $page);
            $this->flashMessage('Stránka byla uložena.');
            $this->redirect('this');
        } else {
            $values->createdAt = new DateTime();
            $id = $this->pageManager->insert($values);
            $this->flashMessage('Stránka byla vytvořena.');
            $this->redirect('this', ['id' => $id]);
        }
    }
}
