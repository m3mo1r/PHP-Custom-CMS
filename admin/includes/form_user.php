<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(isset($user_id)) echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(isset($user_id)) echo $user_lastname; ?>">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="subscriber">Subscriber</option>
            <option value="admin" <?php if(isset($user_role) && $user_role == 'admin') echo "selected"?>>Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Username</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($user_id)) echo $user_name; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($user_id)) echo $user_email; ?>" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
<?php if(isset($user_id) && !empty($user_image)) echo "<br><img src='../images/{$user_image}' alt='user_image' width='100'>"; ?>
        <input type="file" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
    </div>
    <div class="form-group">
<?php
if(isset($user_id) && $_SESSION['username'] === $user_name)
    echo "<input type='submit' class='btn btn-primary' name='update_profile' value='Update Profile'>";
elseif(isset($user_id))
    echo "<input type='submit' class='btn btn-primary' name='update_user' value='Update User'>";
else
    echo "<input type='submit' class='btn btn-primary' name='create_user' value='Add User'>";
?>
    </div> 
</form>