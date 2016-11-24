<?php

namespace Service\DataProvider;

use Model\CommentModel;
use Model\LogModel;
use Model\ObserverModel;

/**
 * Class DataProvider
 */
class DataProvider
{
    /**
     * @var DataProvider
     */
    static private $instance = null;

    /**
     * @var \PDO
     */
    private $conn = null;

    /**
     * DataProvider constructor.
     */
    private function __construct()
    {

    }

    /**
     * @return null|DataProvider
     */
    static public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DataProvider();
        }

        return self::$instance;
    }

    /**
     * @return \PDO
     *
     * @throws \Exception
     */
    public function getConn()
    {
        if (is_null($this->conn)) {
            $config = \App::getConfigDB();
            $servername = $config['servername'];
            $username = $config['username'];
            $password = $config['password'];
            $dbname = $config['dbname'];

            $this->conn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        }

        return $this->conn;
    }

    /**
     * @return CommentModel[]
     */
    public function getCommentList()
    {
        $conn = $this->getConn();

        $sql = 'SELECT id, name, text FROM comment ORDER BY id DESC ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, 'Model\CommentModel');

        return $result;
    }

    /**
     * @param int $id
     *
     * @return CommentModel
     */
    public function getCommentById($id)
    {
        $conn = $this->getConn();

        $sql = 'SELECT id, name, text FROM comment WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchObject('Model\CommentModel');

        return $result;
    }

    /**
     * @param int $id
     */
    public function deleteComment($id)
    {
        $conn = $this->getConn();

        $sql = 'DELETE FROM comment WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * @param CommentModel $commentModel
     */
    public function addComment(CommentModel $commentModel)
    {
        $conn = $this->getConn();
        $sql = "INSERT INTO comment (name, text) VALUES (:name, :text)";
        $stmt = $conn->prepare($sql);

        $name = $commentModel->getName();
        $stmt->bindParam(':name', $name);

        $text = $commentModel->getText();
        $stmt->bindParam(':text', $text);

        $stmt->execute();
    }

    /**
     * @param LogModel $loggerModel
     */
    public function addLog(LogModel $loggerModel)
    {
        $conn = $this->getConn();
        $sql = "INSERT INTO log (text) VALUES (:text)";
        $stmt = $conn->prepare($sql);

        $text = $loggerModel->getText();
        $stmt->bindParam(':text', $text);

        $stmt->execute();
    }

    /**
     * @return array
     */
    public function getLogList()
    {
        $conn = $this->getConn();

        $sql = 'SELECT id, text FROM log ORDER BY id DESC ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, 'Model\LogModel');

        return $result;
    }

    /**
     * @return ObserverModel[]
     */
    public function getObserverList()
    {
        $conn = $this->getConn();

        $sql = 'SELECT name, event FROM observer ORDER BY order_num ASC;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, 'Model\ObserverModel');

        return $result;
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}