<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php // SHOW UPDATE INPUT
        if (isset($_GET['edit'])) {
            $cat_id = Escape($_GET['edit']);
            $query  = "SELECT * FROM categories ";
            $query .= "WHERE cat_id = '{$cat_id}' ";
            $record = QueryDB($query);

            while ($row = mysqli_fetch_assoc($record)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

        ?>

        <input type="text" class="form-control" name="cat_title" id="cat_title" value="<?php if ($cat_title) echo $cat_title; ?>">

        <?php } }?>

        <?php // UPDATE CATEGORY
        if (isset($_POST['update_submit'])) {
            $up_cat_title = $_POST['cat_title'];
            
            $query  = "UPDATE categories ";
            $query .= "SET cat_title = '{$up_cat_title}' ";
            $query .= "WHERE cat_id = '{$cat_id}'";
            $record = QueryDB($query);

            header('Location: categories.php');
        }

        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_submit" value="Update Category">
    </div>
</form>