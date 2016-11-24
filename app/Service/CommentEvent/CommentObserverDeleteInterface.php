<?php

namespace Service\CommentEvent;

/**
 * Interface CommentObserverDeleteInterface
 *
 * @package Service\CommentEvent
 */
interface CommentObserverDeleteInterface extends CommentObserverInterface
{
    /**
     * @param CommentEventInterface $eventComment
     */
    public function onDelete(CommentEventInterface $eventComment);
}