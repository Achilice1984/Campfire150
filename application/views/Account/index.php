
<div class="container">
    <h1>Title</h1>

    <?php 
        //Add error message block to the page
        include(APP_DIR . 'views/shared/displayErrors.php'); 
    ?>

    <form action="<?php echo BASE_URL; ?>Account/index" method="post">

        <div class="form-group">
            <label for="name">Label</label>
            <input type="text" class="form-control" name="name" placeholder="placeholder">
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="crud"> Add CRUD Actions and Views? (insert, edit, delete, get)
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>

    </form>
</div>
