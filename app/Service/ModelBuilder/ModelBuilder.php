<?php

namespace Service\ModelBuilder;

use Model\CommentModel;
use Model\LogModel;

/**
 * Class ModelBuilder
 */
class ModelBuilder
{
    /**
     * @param array $data
     *
     * @return CommentModel
     */
    public static function getCommentModel($data)
    {
        $model = new CommentModel();

        if (isset($data['id'])) {
            $model->setId($data['id']);
        }

        if (isset($data['name'])) {
            $model->setName($data['name']);
        }

        if (isset($data['text'])) {
            $model->setText($data['text']);
        }

        return $model;
    }

    /**
     * @param array $data
     *
     * @return LogModel
     */
    public static function getLogModel($data)
    {
        $model = new LogModel();

        if (isset($data['id'])) {
            $model->setId($data['id']);
        }

        if (isset($data['text'])) {
            $model->setText($data['text']);
        }

        return $model;
    }
}