<?php
$questionsCount = QuestionsModel::count();
$pages = ceil($questionsCount/PageSize);
$currentPage = $this->currentPage;
$startPage = 1;
$endPage = 7;

if($pages > $startPage + MaxPages - 1 && $currentPage > ($startPage + MaxPages)/2 && $currentPage + 3 <= $pages) {
    $startPage = $currentPage - 3;
} else if($currentPage + 3 > $pages && $pages > MaxPages) {
    $startPage = $pages - MaxPages + 1;
}

if($pages < MaxPages) {
    $endPage = $pages;
} else {
    $endPage = $startPage + MaxPages - 1;
}

?>

<nav>
    <ul class="pagination">
        <?php for($i = $startPage; $i <= $endPage; $i++){

            if($i == $currentPage) {
                echo('<li class="active"><a href="/questions/index/' . $i . '">' . $i . '</a></li>');
            } else {
                echo('<li><a href="/questions/index/' . $i . '">' . $i . '</a></li>');
            }

        }?>
    </ul>
</nav>