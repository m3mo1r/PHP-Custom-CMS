<?php
function InsertCategories() {    
    if (isset($_POST['create_submit'])) {
        $cat_title = Escape($_POST['cat_title']);

        if (!empty($cat_title)) {
            $query  = "INSERT INTO categories (cat_title)";
            $query .= "VALUE ('{$cat_title}')";
            $record = QueryDB($query);
        }
        else
            echo "This field should not be empty.";
    }
}

function FindAllCategories() {
    $query   = "SELECT * FROM categories ";
    $records = QueryDB($query);
    
    while ($row = mysqli_fetch_assoc($records)) {
        $cat_id    = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function DeleteCategories() {
    if (isset($_GET['delete'])) {
        $del_cat_id = Escape($_GET['delete']);
        
        $query  = "DELETE FROM categories ";
        $query .= "WHERE cat_id = '{$del_cat_id}'";
        $record = QueryDB($query);

        header('Location: categories.php');
    }
}

function Is_Admin($username) {    
    $query  = "SELECT user_role FROM users ";
    $query .= "WHERE user_name = '{$username}' ";
    $record = QueryDB($query);
    
    if(mysqli_fetch_assoc($record)['user_role'] === 'admin')
        return true;
    else
        return false;
}

function Post_UserId($post_user) {
    $query  = "SELECT user_id FROM users ";
    $query .= "WHERE user_name = '{$post_user}' ";
    $record = QueryDB($query);
    
    return mysqli_fetch_assoc($record)['user_id'];
}
?>