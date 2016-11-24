<?php

namespace Service\CommentEvent;

/**
 * Class CommentEditor
 */
class CommentEditor implements CommentObserverSubmitInterface
{
    /**
     * @param CommentEventInterface $eventComment
     */
    public function onSubmit(CommentEventInterface $eventComment)
    {
        $smiles = $this->getSmiles();

        $text = $eventComment->getCommentModel()->getText();
        foreach ($smiles as $smile => $image) {
            $text = str_replace($smile, $image, $text);
        }

        $eventComment->getCommentModel()->setText($text);
    }

    /**
     * @return array
     */
    public function getSmiles()
    {
        $smiles = [
            ':)' => '<img src="/img/smile/smile1.jpg" />',
            ';)' => '<img src="/img/smile/smile2.jpg" />',
            ':p' => '<img src="/img/smile/smile3.jpg" />',
            ':(' => '<img src="/img/smile/smile4.jpg" />',
        ];

        return $smiles;
    }
}