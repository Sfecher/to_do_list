<?php

include "DatabaseAdapterInterface.php";


class DatabaseAdapterMySQLI implements DatabaseAdapterInterface
{
  private $mysqli;

  public function  __construct($values) {
    $this->setConnectionInfo($values);
  }

  function setConnectionInfo($values=array()) {
    $host = $values[0];
    $user = $values[1];
    $password = $values[2];
    $name = $values[3];
    $mysqli = new mysqli($host,$user,$password, $name);
    $this->mysqli = $mysqli;
  }
  

  public function runQuery($sql) {
    $result = $this->mysqli->query($sql); //run query
    return $result;
  }

  public function fetchAsArray($sql) {
    $result = $this->mysqli->query($sql);
    $resultArr = array();
    while ($row = $result->fetch_assoc()){
      array_push($resultArr, $row);
    }
    return $resultArr;
  }

}
