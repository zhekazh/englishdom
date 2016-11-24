<?php


namespace Service\CommentEvent;


use Model\CommentModel;

/**
 * Interface CommentEventInterface
 */
interface CommentEventInterface
{
    /**
     * @param CommentModel $commentModel
     */
    public function onSubmit(CommentModel &$commentModel);

    /**
     * @param CommentModel $commentModel
     */
    public function onDelete(CommentModel $commentModel);

    /**
     * @return CommentModel
     */
    public function getCommentModel();
}