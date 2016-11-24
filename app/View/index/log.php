<?php if (!empty($logList)): ?>
    <div class="list-comment">
        <?php /** @var $logList \Model\LogModel[] */ ?>
        <?php foreach ($logList as $log): ?>
            <div class="comment-item">
                <div class="comment-name">
                    <?php echo $log->getId().'. '.$log->getText() ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>