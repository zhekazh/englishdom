<?php

use PHPUnit\Framework\TestCase;
use View\View;

class ViewTest extends TestCase
{
    public function testViewInclude()
    {
        $view = new View();
        $result = $view->render('index/index');
        $this->assertContains('Write message with a smileys', $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testFailingInclude()
    {
        $view = new View();
        $view->render('test');
    }
}