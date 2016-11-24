<?php

namespace Service\ObserverBuilder;

use Service\CommentEvent\CommentEditor;
use Service\CommentEvent\CommentLogger;

/**
 * Class ObserverBuilder
 */
class ObserverBuilder
{
    /**
     * @param string $type
     *
     * @return CommentEditor|CommentLogger
     */
    public static function getObserver($type)
    {
        switch ($type) {
            case 'CommentEditor':
                return new CommentEditor();
                break;
            case 'CommentLogger':
                return new CommentLogger();
                break;
            default:
                break;
        }
    }
}