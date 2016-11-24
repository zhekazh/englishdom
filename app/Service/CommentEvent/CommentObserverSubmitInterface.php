<?php

namespace Service\CommentEvent;

/**
 * Interface CommentObserverSubmitInterface
 *
 * @package Service\CommentEvent
 */
interface CommentObserverSubmitInterface extends CommentObserverInterface
{
    /**
     * @param CommentEventInterface $eventComment
     */
    public function onSubmit(CommentEventInterface $eventComment);
}