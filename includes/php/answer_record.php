<?php
/**
 * Created by PhpStorm.
 * User: MD AZIZUL HAKIM
 * Date: 14/02/2018
 * Time: 11:32 PM
 */

require_once "../database/db_connection.php";
require_once "functions.php";
require_once "session.php";

if (isset($_POST['submit_ans'])) {
    $exam_ans = mysqli_prep($_POST['answer']);

    $fileTmp = $_FILES['code']['tmp_name'];
    $exam_file = time() . $_FILES['code']['name'];
    $fileType = $_FILES['code']['type'];
    $filePath = "../../answers/" . $exam_file;
    $fileurl = "answers/" . $exam_file;


    move_uploaded_file($fileTmp, $filePath);


    $exam_id = $_SESSION['current_exam_id'];
    $exaninee_id = $_SESSION['user_id'];
    $courese_id = $_SESSION['current_content_id_exam'];


    $query = "INSERT INTO exam_ans(ques_id,examinee_id, answer, answer_url) ";
    $query .= "VALUES('$exam_id','$exaninee_id','$exam_ans','$fileurl')";

    $result = mysqli_query($connection, $query);


    if (!$result) {
        die("Failed!!!" . mysqli_error($connection));
    } else {
        header("location: ../../public/course_view.php?content=$courese_id");

    }

}