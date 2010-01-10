<?php 

class App_Model_File extends Fz_Db_Table_Row_Abstract {

    protected $_tableClass = 'App_Model_DbTable_File';

    public function getHash () {
        return $this->getTable ()->idToHash ($this->id);
    }

    public function __toString () {
        return $this->file_name;
    }

    public function __construct ($exists = false) {
        parent::__construct ($exists);
        if (! $exists)
            $this->id = $this->getTable ()->getFreeId ();
    }

    public function getAvailableUntil () {
        return new Zend_Date ($this->available_until, Zend_Date::ISO_8601);
    }

    public function getAvailableFrom () {
        return new Zend_Date ($this->available_from, Zend_Date::ISO_8601);
    }

    public function getCreatedAt () {
        return new Zend_Date ($this->created_at, Zend_Date::ISO_8601);
    }

    protected function setAvailableUntil ($date) {
        $this->available_until = $date instanceof Zend_Date ?
            $date->get (Zend_Date::ISO_8601) : $date;
    }

    protected function setAvailableFrom ($date) {
        $this->available_from = $date instanceof Zend_Date ?
            $date->get (Zend_Date::ISO_8601) : $date;
    }

    protected function setCreatedAt ($date) {
        $this->created_at = $date instanceof Zend_Date ?
            $date->get (Zend_Date::ISO_8601) : $date;
    }

    public function getDownloadUrl () {
        return 'http://'.$_SERVER["SERVER_NAME"].url_for ('/').$this->getHash ();
    }

}
