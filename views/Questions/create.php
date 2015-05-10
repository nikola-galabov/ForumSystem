<div class="col-md-9">
    <form action="/questions/create" method="post">
        <input name="user_id" type="hidden" value="<?php $this->escapeAndPrint($this->userId); ?>"/>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required="required"/>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="tinymce" name="content" id="content" rows="20" required="required"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" class="form-control" required="required">
                <?php foreach($this->categories as $category): ?>
                    <option value="<?php $this->escapeAndPrint($category['category_id']); ?>">
                        <?php $this->escapeAndPrint($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Create" class="btn btn-default"/>
    </form>
</div>
