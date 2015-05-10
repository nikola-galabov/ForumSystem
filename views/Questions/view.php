<div class="question col-md-9 container">
    <div class="question-header col-md-12">
        <div class="question-title-details">
            <h2>
                <a href="/questions/view/<?php $this->escapeAndPrint($this->question['question_id']) ?>">
                    <?php $this->escapeAndPrint($this->question['title']); ?>
                </a>
            </h2>
            <p class="question-details">
            <span class="detail-group">
                <span class="glyphicon glyphicon-user" data-aria-hidden="true"></span>
                <span>
                    <?php $this->escapeAndPrint($this->question['username']); ?>
                </span>
            </span>
            <span class="detail-group">
                <span class="glyphicon glyphicon-pencil" data-aria-hidden="true"></span>
                <span>
                    <?php $this->escapeAndPrint($this->question['category']); ?>
                </span>
            </span>
            <span class="detail-group">
                <span class="glyphicon glyphicon-calendar" data-aria-hidden="true"></span>
                <span>
                    <?php
                    $date = date_create($this->question['published']);
                    $this->escapeAndPrint(date_format($date,"d F Y (H:m:s)"));
                    ?>
                </span>
            </span>
            </p>
        </div>
        <?php if($this->question['isRedacted']) : ?>
            <div class="question-updated">
                <p>Redacted at:
                    <?php
                    $date = date_create($this->question['redacted']);
                    $this->escapeAndPrint(date_format($date,"d F Y (H:m:s)"));
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-12 question-pic-content">
        <div class="col-md-2 col-xs-2 question-user-pic">
            <?php
                if($this->question['avatar'] == null) {
                    $avatar = '/public/avatars/default.png';
                }  else {
                    $avatar = $this->question['avatar'];
                }

            ?>
            <img class="img-responsive" src="<?php $this->escapeAndPrint($avatar) ?>" alt="avatar"/>
        </div>
        <div class="col-md-10 col-xs-10 question-content">
            <p><?php $this->escapeAndPrint($this->question['content']) ?></p>
        </div>
    </div>

    <div class="col-md-12 col-xs-12">
        <hr/>

        <div class="tags-container">
            <p>Tags:</p>
                <ul class="list-group list-inline">
                <?php
                    foreach($this->questionTags as $tag) {
                        echo('<a href="/questions/tags/' . $tag['tag_id'] . '"><li class="list-group-item">' . $tag['name'] . '</li></a>');
                    }
                ?>
                </ul>
        </div>

        <hr/>
        <button type="button" id="make-comment" class="btn btn-default">Make a comment</button>
        <div id="comment-form">
            <form action="/comments/add" method="post">
                <input name="question_id" type="hidden" value="<?php $this->escapeAndPrint($this->question['question_id']); ?>"/>
                <input name="user_id" type="hidden" value="<?php $this->escapeAndPrint($this->userId); ?>"/>
                <div class="form-group">
                    <label for="text">Text:</label>
                    <textarea class="form-control" name="content" id="text" rows="20" required="required"></textarea>
                </div>
                <input class="btn btn-default" type="submit"/>
            </form>
        </div>
    </div>


</div>

<?php

if($this->comments != null){
    echo('<div class="col-md-offset-3 comments-container col-md-9 container">');
    foreach($this->comments as $comment) {
        ?>
        <div class="comment container col-md-12">
            <div class="question-header col-md-12">
                <div class="question-title-details">
                    <p class="question-details">
                        <span class="detail-group">
                            <span class="glyphicon glyphicon-user" data-aria-hidden="true"></span>
                            <span>
                                <?php $this->escapeAndPrint($comment['username']); ?>
                            </span>
                        </span>
                        <span class="detail-group">
                            <span class="glyphicon glyphicon-calendar" data-aria-hidden="true"></span>
                            <span>
                                <?php
                                $date = date_create($comment['published']);
                                $this->escapeAndPrint(date_format($date,"d F Y (H:m:s)"));
                                ?>
                            </span>
                        </span>
                    </p>
                </div>
                <?php if($comment['isRedacted']) : ?>
                    <div class="question-updated">
                        <p>Redacted at:
                            <?php
                            $date = date_create($comment['redacted']);
                            $this->escapeAndPrint(date_format($date,"d F Y (H:m:s)"));
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-12 question-pic-content">
                <div class="col-md-2 col-xs-2 question-user-pic">
                    <?php
                    if($comment['avatar'] == null) {
                        $avatar = '/public/avatars/default.png';
                    }  else {
                        $avatar = $comment['avatar'];
                    }

                    ?>
                    <img class="img-responsive" src="<?php $this->escapeAndPrint($avatar) ?>" alt="avatar"/>
                </div>
                <div class="col-md-10 col-xs-10 question-content">
                    <p><?php $this->escapeAndPrint($comment['text']) ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    echo('</div>');
}
?>


