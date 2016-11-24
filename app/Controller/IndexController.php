<?php

namespace Controller;

use Model\CommentModel;
use Psr\Http\Message\ServerRequestInterface;
use Service\CommentEvent\CommentEvent;
use Service\DataProvider\DataProvider;
use Service\ModelBuilder\ModelBuilder;
use Service\ObserverBuilder\ObserverBuilder;
use View\View;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class IndexController
 */
class IndexController
{

    /** @var View */
    protected $view;

    /**
     * IndexController constructor.
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function indexAction()
    {
        $params['commentList'] = DataProvider::getInstance()->getCommentList();

        return $this->view->render('index/index', $params);
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return RedirectResponse
     */
    public function handlerAction(ServerRequestInterface $request)
    {
        $rawData = $request->getParsedBody();
        $commentModel = ModelBuilder::getCommentModel($rawData);

        if (!empty($commentModel->getText())) {
            $eventComment = $this->observerInit();
            $eventComment->onSubmit($commentModel);

            DataProvider::getInstance()->addComment($commentModel);
        }

        return new RedirectResponse('/');
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return RedirectResponse
     */
    public function deleteAction(ServerRequestInterface $request)
    {
        $rawData = $request->getQueryParams();
        if (isset($rawData['id'])) {
            $id = (int)$rawData['id'];
            $commentModel = DataProvider::getInstance()->getCommentById($id);

            if ($commentModel instanceof CommentModel) {
                $eventComment = $this->observerInit();
                $eventComment->onDelete($commentModel);

                DataProvider::getInstance()->deleteComment($commentModel->getId());
            }
        }

        return new RedirectResponse('/');
    }

    /**
     * @return string
     */
    public function logAction()
    {
        $params['logList'] = DataProvider::getInstance()->getLogList();

        return $this->view->render('index/log', $params);
    }

    /**
     * @return string
     */
    public function installAction()
    {
        $this->createDB();

        return $this->view->render('index/install');
    }

    /**
     * @return null|CommentEvent
     */
    protected function observerInit()
    {
        $observerList = DataProvider::getInstance()->getObserverList();
        $eventComment = CommentEvent::getInstance();
        foreach ($observerList as $observer) {
            $newObserver = ObserverBuilder::getObserver($observer->getName());
            $eventComment->attach($newObserver, $observer->getEvent());

            //Detach observer
            //$eventComment->detach($newObserver, $observer->getEvent());
        }

        return $eventComment;
    }

    private function createDB()
    {
        $config = \App::getConfigDB();
        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        // Create connection
        $conn = new \mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        }

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS ed_task";
        $conn->query($sql);

        $conn->close();

        $conn = new \mysqli($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE IF NOT EXISTS `comment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255), 
  `text` VARCHAR(255), 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `log` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255), 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `observer` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255), 
  `event` INT(11), 
  `order_num` INT(11), 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $conn->query($sql);

        $sql = "INSERT INTO observer (name, event, order_num) VALUES ('CommentEditor', 1, 1), ('CommentLogger', 1, 2), ('CommentLogger', 2, 2);";
        $conn->query($sql);

        $conn->close();
    }
}