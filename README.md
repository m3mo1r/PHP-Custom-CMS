## search.php
-----------------------------------------------------------
#### search function
> mysqli_stmt_store_result -> mysqli_stmt_num_rows
> mysqli_prepare -> mysqli_stmt_close
* LIKE: %keyword% -> '%' . keyword . '%';
> mysqli_real_escape_string -> escape
* href entire path for rewrite mode
> while: endwhile;

## reset.php
-----------------------------------------------------------
#### reset password function
> password_hash($password, PASSWORD_BCRYPT, ['cost' => 12])
> if: elseif: endif;
* bootstrap form

## registration.php
-----------------------------------------------------------
#### add new user function
> location.reload
* add language

## post.php
-----------------------------------------------------------
#### view a post: content, likes, comments
* like function: jquery ajax
* idor: just admin see draft post

## login.php
-----------------------------------------------------------
#### login function and includes/logout.php
> header location
> password_verify
> ob_start
> session_start

## index.php and category.php and author.php
-----------------------------------------------------------
#### show posts
* pagination function
* idor: just see published post with guest and all post with admin

## forgot.php and contact.php
-----------------------------------------------------------
#### forgot password function in dev and prod mode
* vendor: phpmailer and use mailtrap
> mail
> require

## composer.json and composer.lock
-----------------------------------------------------------
* use composer: phpmailer pusher

## .htaccess
-----------------------------------------------------------
* rewrite url
* regular expression [x]

** files .php in root folder use include and just write important codes **

## includes/db.php
-----------------------------------------------------------
> ob_start in start of everycode -> use header location
> SET NAMES utf8

## includes/functions.php
-----------------------------------------------------------
#### all duplicate and complex function
* QueryDB: query and check errors [x]
* UsersOnlineCount: count online users real time
* Redirect: header location
* Escape
* Like
* Login and Register
> $_SERVER['REQUEST_METHOD']
> basename($_SERVER['PHP_SELF']) -> check file name
> 1 === 1 ? true : false
* mysqli_fetch: 1 time
> global $conn

## includes/header.php
-----------------------------------------------------------
#### initialize code
* html5shiv.js and respond.js -> IE 8 - 9
> session_start -> use $_SESSION
> include files

## admin/users.php and admin/posts.php and admin/comments.php and admin/categories.php
-----------------------------------------------------------
#### show all and add function
* use source parameter

## admin/profile.php
-----------------------------------------------------------
#### update info logged user

## admin/post_comments.php
-----------------------------------------------------------
#### view all comments of a post
* bootstrap table
* delete, approve and unapprove comment

## admin/index.php
-----------------------------------------------------------
#### admin dashboard
* chart
* idor

## admin/js/scripts.js
-----------------------------------------------------------
#### addon and jquery
* CKEditor
* Summernote
* ajax loader
* LoadAllOnlineUsers
* bulk option: select all boxes

## admin/includes/add_posts.php and admin/includes/edit_posts.php and admin/includes/form_post.php
-----------------------------------------------------------
#### post functions
> <form action="" method="post" enctype="multipart/form-data">
> $_FILES['image']['name']
> $_FILES['image']['tmp_name']
> move_uploaded_file($post_image_tmp, "../images/{$post_image}")
> now
> mysqli_insert_id -> get latest id
> str_replace('\\', '', $post_title) -> delete \
* trick 1 form for 2 functions: isset(id)
* bootstrap form
* idor
## admin/includes/add_users.php and admin/includes/edit_users.php and admin/includes/form_user.php and admin/includes/update_user.php
-----------------------------------------------------------
#### user functions
* filter value by js
* idor
* check empty image
* no show password value

## admin/includes/chart.php and admin/includes/widgets.php
-----------------------------------------------------------
#### draw google chart and indexing

## admin/includes/functions.php
-----------------------------------------------------------
####
* categories functions
* idor

## admin/includes/header.php
-----------------------------------------------------------
#### initialize code
> ob_start
> session_start
* include files
* check idor admin

## admin/includes/modals.php
-----------------------------------------------------------
#### modals bootstrap

## admin/includes/view_all_posts.php and admin/includes/view_all_users.php and admin/includes/view_all_comments.php
-----------------------------------------------------------
#### view all
* bulk options
* modals event
> href='javascript:void(0)' class='delete_link'
> onclick=\"javascript: return confirm('Are you sure to delete this user?')\"
* idor
* show logged user in profile [x]