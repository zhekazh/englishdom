<?php

use Controller\IndexController;
use PHPUnit\Framework\TestCase;
use View\View;

class IndexControllerTest extends TestCase
{
    public function testIndexAction()
    {
        $indexController = new IndexController(new View());
        $result = $indexController->indexAction();
        $this->assertContains('Write message with a smileys', $result);
    }

    public function testLogAction()
    {
        $indexController = new IndexController(new View());
        $result = $indexController->indexAction();
        $this->assertContains('Log', $result);
    }

    public function testHandlerAction()
    {
        $indexController = new IndexController(new View());
        $request = new \Zend\Diactoros\ServerRequest();
        $result = $indexController->handlerAction($request);
        $this->assertInstanceOf('\Zend\Diactoros\Response\RedirectResponse', $result);
    }
}