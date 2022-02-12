                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
$query   = "SELECT * FROM users ";
$records = QueryDB($query);

while($row = mysqli_fetch_assoc($records)) {
    if($row['user_name'] === $_SESSION['username']) continue; // JUST SHOW LOGGIN USER IN PROFILE
    $user_id        = $row['user_id'];
    $user_name      = $row['user_name'];
    $user_password  = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname  = $row['user_lastname'];
    $user_email     = $row['user_email'];
    $user_image     = $row['user_image'];
    $user_role      = $row['user_role'];
    
    
    echo "<tr>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$user_name}</td>";
    echo "<td>{$user_firstname}</td>";
    echo "<td>{$user_lastname}</td>";
    echo "<td>{$user_email}</td>";
    echo "<td>{$user_role}</td>";
    echo "<td><a href='users.php?source=edit_users&u_id={$user_id}'>Edit</a></td>";
    echo "<td><a onclick=\"javascript: return confirm('Are you sure to delete this user?')\" href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";
}
?>
                            </tbody>
                        </table>
                       
<?php
if(isset($_GET['delete']) && Is_Admin($_SESSION['username'])) {
    $del_user_id = Escape($_GET['delete']);
    
    $query       = "DELETE FROM users ";
    $query      .= "WHERE user_id = {$del_user_id} ";
    $record      = QueryDB($query);
    
    header('Location: users.php');
}
?>