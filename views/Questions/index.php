<div class="container">
    <div class="col-md-10 questions-container">
        <?php
        if(count($this->questions)==0) {
        ?>

            <div class="question-container">
                <p>There are no questions for the moment!</p>
            </div>

        <?php
        } else {
            //var_dump($this->questions);
            foreach($this->questions as $question) {
        ?>

            <div class="question-container">
                <div class="row">
                    <h2><a href="/questions/view/<?php $this->escapeAndPrint($question[3])?>"><?php $this->escapeAndPrint($question[0]); ?></a></h2>
                </div>
                <div class="row">
                    <div class="meta-data-container">
                        <div class="meta-data">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <span>
                                <?php $this->escapeAndPrint($question[2]); ?>
                            </span>
                        </div>
                        <div class="meta-data">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <span>
                                <?php
                                    $date = date_create($question[1]);
                                    $this->escapeAndPrint(date_format($date,"d F Y"));
                                ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        <?php
            }
        }
        include('/views/layouts/pagination.php');
        ?>


    </div>
</div>
