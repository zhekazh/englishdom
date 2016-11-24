<?php

namespace Service\CommentEvent;

use Service\DataProvider\DataProvider;
use Service\ModelBuilder\ModelBuilder;

/**
 * Class CommentEditor
 */
class CommentLogger implements CommentObserverSubmitInterface, CommentObserverDeleteInterface
{
    /**
     * @param CommentEventInterface $eventComment
     */
    public function onSubmit(CommentEventInterface $eventComment)
    {
        $commentModel = $eventComment->getCommentModel();

        $log = date('Y-m-d H:i:s').' New comment';
        if (!empty($commentModel->getName())) {
            $log .= ' author - '.$commentModel->getName();
        }

        $logModel = ModelBuilder::getLogModel(['text' => $log]);
        DataProvider::getInstance()->addLog($logModel);
    }

    /**
     * @param CommentEventInterface $eventComment
     */
    public function onDelete(CommentEventInterface $eventComment)
    {
        $commentModel = $eventComment->getCommentModel();

        $log = date('Y-m-d H:i:s').'Comment ['.$commentModel->getId().'] delete';
        $logModel = ModelBuilder::getLogModel(['text' => $log]);
        DataProvider::getInstance()->addLog($logModel);
    }
}