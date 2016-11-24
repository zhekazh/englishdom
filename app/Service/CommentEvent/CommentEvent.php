<?php

namespace Service\CommentEvent;

use Model\CommentModel;

/**
 * Class CommentEvent
 */
class CommentEvent implements CommentEventInterface
{
    const EVENT_TYPE_SUBMIT = 1;

    const EVENT_TYPE_DELETE = 2;
    /**
     * @var CommentEvent
     */
    static private $instance = null;

    /**
     * @var CommentObserverInterface[][]|CommentObserverSubmitInterface[][]|CommentObserverDeleteInterface[][]
     */
    private $observers = [];

    /** @var CommentModel */
    private $commentModel;


    /**
     * CommentEvent constructor.
     */
    private function __construct()
    {

    }

    /**
     * @return null|CommentEvent
     */
    static public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CommentEvent();
        }

        return self::$instance;
    }

    /**
     * @param CommentObserverInterface $observer
     * @param int                      $eventType
     */
    public function attach(CommentObserverInterface $observer, $eventType)
    {
        $this->observers[$eventType][] = $observer;
    }

    /**
     * @param CommentObserverInterface $observer
     * @param int                     $eventType
     */
    public function detach(CommentObserverInterface $observer, $eventType)
    {
        $key = array_search($observer, $this->observers[$eventType], true);
        if ($key > -1) {
            unset($this->observers[$eventType][$key]);
        }
    }

    /**
     * @param CommentModel $commentModel
     */
    public function onSubmit(CommentModel &$commentModel)
    {
        $this->commentModel = $commentModel;
        foreach ($this->observers[CommentEvent::EVENT_TYPE_SUBMIT] as $observer) {
            $observer->onSubmit($this);
        }
    }

    /**
     * @param CommentModel $commentModel
     */
    public function onDelete(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
        foreach ($this->observers[CommentEvent::EVENT_TYPE_DELETE] as $observer) {
            $observer->onDelete($this);
        }
    }

    /**
     * @return CommentModel
     */
    public function getCommentModel()
    {
        return $this->commentModel;
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}