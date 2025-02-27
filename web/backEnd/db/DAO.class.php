<?php

abstract class DAO
{
  protected $dbAdapter;

  public function  __construct($dbAdapter)
  {
    if (is_null($dbAdapter) ){
      throw new Exception("Database adapter is null");
    }
    $this->dbAdapter = $dbAdapter;
  }

  // The select statement for the table
  abstract protected function getSelectStatement();

  abstract protected function getSpecificSelectStatement($id);

  // The insert statement for the table
  abstract protected function getInsertStatement($object);
  
  
  public function findAll() {
    $sql = $this->getSelectStatement();
    $resultArr = $this->dbAdapter->fetchAsArray($sql);
    return $resultArr;
  }

  public function findByID($id) {
    $sql = $this->getSpecificSelectStatement($id);
    $resultArr = $this->dbAdapter->fetchAsArray($sql);
    return $resultArr;
  }

  public function insert($object) {
    $sql = $this->getInsertStatement($object);
    $this->dbAdapter->runQuery($sql);
  }
}