<?php require_once "../database/db_connection.php"?>
<?php require_once "session.php";?>
<?php require_once "functions.php"?>
<?php
if(isset($_GET['content'])){
    $content_id = $_GET['content'];
    global $connection;
    $query = "UPDATE content SET visibility = 0, content_status='pending' WHERE content_id = {$content_id}";
    $result = mysqli_query($connection,$query);

    if(!$result){
        die("failed ". mysqli_error($connection));
    }else{
        redirect_to("../../public/create_course_landing.php");
    }


}else if(isset($_GET['approve'])){
    $content_id = $_GET['approve'];
    global $connection;
    $query = "UPDATE content SET visibility = 1, content_status='accepted' WHERE content_id = {$content_id}";
    $result = mysqli_query($connection,$query);

    if(!$result){
        die("failed ". mysqli_error($connection));
    }else{
        redirect_to("../../admin/pending_courses.php");
    }
}

?>