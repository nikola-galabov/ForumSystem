

    <div class="col-md-9 questions-container">
        <?php
        if(count($this->questions)==0) {
        ?>

            <div class="question-container">
                <p>There are no questions for the moment!</p>
            </div>

        <?php
        } else {
            foreach($this->questions as $question) {
        ?>

            <div class="question-container">
                <div class="col-md-12">
                    <h3><a href="/questions/view/<?php $this->escapeAndPrint($question['question_id'])?>"><?php $this->escapeAndPrint($question['title']); ?></a></h3>
                </div>

                <div class="meta-data-container">
                    <div class="meta-data">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <span>
                            <?php $this->escapeAndPrint($question['username']); ?>
                        </span>
                    </div>
                    <div class="meta-data">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <span>
                            <?php
                                $date = date_create($question['published']);
                                $this->escapeAndPrint(date_format($date,"d F Y"));
                            ?>
                        </span>
                    </div>
                    <div class="meta-data">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <span>
                            <?php $this->escapeAndPrint($question['category']); ?>
                        </span>
                    </div>
                </div>

                <hr/>

                <div class="question-views-comments">
                    <p>Views: <span><?php $this->escapeAndPrint($question['views']); ?></span></p>
                    <p>Comments: <span><?php $this->escapeAndPrint($question['comments']); ?></span></p>
                    <p>Last comment: <span>asd</span></p>
                </div>
            </div>

        <?php
            }
        }

        if(isset($this->count)) {
            $count = $this->count;
        } else {
            $count = count($this->questions);
        }
        $this->makePagination(array('count'=> $count, 'questions' => $this->questions,'url' => $this->url));

        ?>

        <a href="/questions/create" type="button" class="btn btn-default">Add new question</a>

    </div>


