<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/connection.php';

/**
 * class Db
 * Класс для работы с бд, реализующий подключение по синглтону
 */
class Db
{
  private $connection;
  static private $instance = null;

    /**
     * Метод-конструктор для создания подключения к бд
     */
  private function __construct()
  {
      $this->connection = new Mysqli(HOST, USER, PASS, DATABASE);
  }

  private function __clone() {}

    /**
     * Метод, обеспечивающий единственное создание экземпляра класса Db
     * @return self::$instance (экемпляр класса)
     */

  static function getInstance() 
  {
   if(self::$instance == null) {
    self::$instance = new self();
   }
   return self::$instance;
  }
  /**
     * Метод, для запросов
     * @param string $sql
     */

    public function query($sql){
        return $this->connection->query($sql);
    }

    /**
     * Метод, для получинея всех записей из таблицы
     * @param string $table_name
     */

  public function getAllRecords($table_name){
      $sql_query = "SELECT * FROM $table_name";
      $result =  $this->connection->query($sql_query);
      return $result;
  }

}


