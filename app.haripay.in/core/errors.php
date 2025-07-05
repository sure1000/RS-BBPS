<?php

if (isset($_GET['msgid'])) {
    $msgID = $_GET['msgid'];
}

function getERRORS($msgID) {

    if ($msgID > 0) {
        switch ($msgID) {
            case 1:
                $msg = "Information Saved Successfully";
                break;
            case 2:
                $msg = "Username / Password mismatch";
                break;
            case 3:
                $msg = "Please login inorder to continue";
                break;
            case 4:
                $msg = "Email / Mobile already Taken. Please try another";
                break;
            default:
                $msg = "Something went wrong. Please try again";
                break;
        }
    }

    if ($msgID > 0) {
        //return "<div class='alert alert-danger'>" . $msg . "</div>";
        return $msg;
    }
}

?>