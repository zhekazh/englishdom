<div class="b-form">
    <div class="wrapper-contact-form">
        <p class="subtitle-info">Write message with a smileys [ <i>:), ;), :p, :(</i> ]</p>
        <form action="" method="POST" novalidate="" class="form js-form gtm_form__contacts">
            <div class="wrap-input">
                <label for="name" class="label-form name-label icon-after">
                    <input type="text" id="name" name="name" placeholder="Name" autofocus="" class="input-form">
                </label>
            </div>
            <div class="wrap-input wrap-textarea js-input-wrap">
                <label for="textarea" class="label-form textarea-label icon-after">
                    <textarea name="text" id="textarea" placeholder="Comment*" required="required" class="textarea-form input-form"></textarea>
                </label>
            </div>
            <button type="submit" class="form-btn ed-btn -green-btn js-button">отправить&nbsp;сообщение</button>
        </form>
    </div>
</div>

<?php if (!empty($commentList)): ?>
    <div class="list-comment">
        <?php /** @var $commentList \Model\CommentModel[] */ ?>
        <?php foreach ($commentList as $comment): ?>
            <div class="comment-item">
                <div class="comment-name">
                    <?php echo $comment->getName() ?>
                </div>
                <div class="comment-text">
                    <?php echo $comment->getText() ?>
                    <p><a href="/delete?id=<?php echo $comment->getId() ?>">Delete</a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>