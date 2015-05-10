<?php
$pages = ceil($this->count/PAGE_SIZE);
$currentPage = $this->currentPage;
$startPage = 1;
$endPage = 7;

if($pages > $startPage + MAX_PAGES - 1 && $currentPage > ($startPage + MAX_PAGES)/2 && $currentPage + 3 <= $pages) {
    $startPage = $currentPage - 3;
} else if($currentPage + 3 > $pages && $pages > MAX_PAGES) {
    $startPage = $pages - MAX_PAGES + 1;
}

if($pages < MAX_PAGES) {
    $endPage = $pages;
} else {
    $endPage = $startPage + MAX_PAGES - 1;
}

?>

<nav>
    <ul class="pagination">
        <?php for($i = $startPage; $i <= $endPage; $i++){

            if($i == $currentPage) {
                echo('<li class="active"><a href="' . $this->url . $i . '">' . $i . '</a></li>');
            } else {
                echo('<li><a href="' . $this->url . $i . '">' . $i . '</a></li>');
            }

        }?>
    </ul>
</nav>