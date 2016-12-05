<?php

namespace App\Model;

use Nette;
use Nette\Database\Table\IRow;

/**
 * Class PageManager
 * @package app\model
 */
class PageManager
{
    use Nette\SmartObject;

    const
        TABLE_NAME = 'page',
        COLUMN_ID = 'id',
        COLUMN_NAME = 'page_name',
        COLUMN_TITLE = 'title',
        COLUMN_JUMBOTRON = 'jumbotron',
        COLUMN_CONTENT = 'content',
        COLUMN_LANG = 'lang';



    /** @var Nette\Database\Context */
    private $database;


    /**
     * PageManager constructor.
     *
     * @param Nette\Database\Context $database
     */
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }


    /**
     *
     *
     * @param string $name
     * @param string $lang
     *
     * @return IRow|null
     */
    public function getPageByName(string $name, string $lang = 'cz')
    {
        return $this
            ->database
            ->table(self::TABLE_NAME)
            ->where(self::COLUMN_NAME, $name)
            ->where(self::COLUMN_LANG, $lang)
            ->fetch();
    }


    /**
     * @param $values
     *
     * @return bool|int|IRow
     */
    public function insert($values)
    {
        return $this->database->table(self::TABLE_NAME)->insert($values);
    }


    /**
     * @param $values
     * @param IRow $row
     *
     * @return int
     */
    public function update($values, IRow $row)
    {
        $row->update($values);
        return $this->database->table(self::TABLE_NAME)->update($row);
    }


    /**
     * @return array|IRow[]|Nette\Database\Table\Selection
     */
    public function findAll()
    {
        return $this->database->table(self::TABLE_NAME)->fetchAll();
    }


    /**
     * @param int $id
     *
     * @return IRow
     */
    public function get($id)
    {
        return $this->database->table(self::TABLE_NAME)->get($id);
    }


    /**
     * @param int $id
     */
    public function remove($id)
    {
        $this->database->table(self::TABLE_NAME)->get($id)->delete();
    }
}
