<?php
//kiem tra gia tri tra ve co dung hay ko
function confirm_query($result, $query){
    global $dbc;
 if(!$result){
    die ("Query {$query} \n<br/> My SQL Error:" .mysqli_error($dbc));
 }}
?>