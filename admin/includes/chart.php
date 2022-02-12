<!--
Warning: include(includes/charts.php): Failed to open stream: No such file or directory in D:\Documents\cms\admin\index.php on line 23

Warning: include(): Failed opening 'includes/charts.php' for inclusion (include_path='C:\xampp\php\PEAR') in D:\Documents\cms\admin\index.php on line 23                
-->
                
<?php
$query              = "SELECT * FROM posts ";
$query             .= "WHERE post_status = 'published' ";
if(!Is_Admin($_SESSION['username']))
    $query         .= "AND post_user_id = {$_SESSION['id']} ";

$records            = QueryDB($query);
$active_posts_count = mysqli_num_rows($records);

$query             = "SELECT * FROM posts ";
$query            .= "WHERE post_status = 'draft' ";
if(!Is_Admin($_SESSION['username']))
    $query        .= "AND post_user_id = {$_SESSION['id']} ";

$records           = QueryDB($query);
$draft_posts_count = mysqli_num_rows($records);

if(Is_Admin($_SESSION['username'])) {
    $query           = "SELECT * FROM users ";
    $query          .= "WHERE user_role = 'subscriber' ";
    $records         = QueryDB($query);
    $sub_users_count = mysqli_num_rows($records);
} else
    $sub_users_count = 1;
    

$query                   = "SELECT * FROM comments ";
if(!Is_Admin($_SESSION['username'])) {
    $query              .= "INNER JOIN posts ON posts.post_id = comments.comment_post_id ";
    $query              .= "WHERE post_user_id = {$_SESSION['id']} AND comment_status = 'approved' ";
} else
    $query              .= "WHERE comment_status = 'approved' ";

$records                 = QueryDB($query);
$approved_comments_count = mysqli_num_rows($records);

$query   = "SELECT * FROM comments ";
if(!Is_Admin($_SESSION['username'])) {
    $query       .= "INNER JOIN posts ON posts.post_id = comments.comment_post_id ";
    $query       .= "WHERE post_user_id = {$_SESSION['id']} AND comment_status = 'unapproved' ";
} else
    $query  .= "WHERE comment_status = 'unapproved' ";
$records = QueryDB($query);
$waiting_comments_count = mysqli_num_rows($records);
?>

                <div class="row">
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['', ''],
<?php
$data_name  = ['Active Posts', 'Draft Posts', 'Approved Comments', 'Waiting Comments', 'Subscriber', 'Categories'];
$data_value = [$active_posts_count, $draft_posts_count, $approved_comments_count, $waiting_comments_count, $sub_users_count, $categories_count];
        
for($i = 0; $i < sizeof($data_name); $i++) {
    if($i === sizeof($data_name) - 1)
        echo "['{$data_name[$i]}', {$data_value[$i]}]";
    else
        echo "['{$data_name[$i]}', {$data_value[$i]}],";
}
?>
        
    ]);

    var options = {
//      width: 800,
      chart: {
        title: '',
        subtitle: '',
      },
      bars: 'horizontal' // Required for Material Bar Charts.
    };

    var chart = new google.charts.Bar(document.getElementById('barchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
                   <div id="barchart_material" style="width: auto; height: 500px;"></div>
                </div>