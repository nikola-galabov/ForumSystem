<div class="col-md-3">
    <button type="button" class="btn btn-default btn-block" id="expandButton">Show categories/tags</button>
    <div class="categories-container expandable">
        <h2>Categories:</h2>
        <ul class="list-group list-unstyled">
            <?php foreach($this->categories as $category): ?>

                <li> <a class="list-group-item" href="/questions/categories/<?php $this->escapeAndPrint($category['category_id']); ?>"><?php $this->escapeAndPrint($category['name']); ?> </a></li>

            <?php endforeach; ?>
        </ul>
    </div>

    <div class="tags-container expandable">
        <h2>Most popular tags:</h2>
        <ul class="list-group list-unstyled list-inline">
            <?php foreach($this->tags as $tag): ?>
                <li class="list-group-item"><a href="/questions/tags/<?php $this->escapeAndPrint($tag['tag_id']); ?>"><?php $this->escapeAndPrint($tag['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>