<?php
require_once "functions.php";

if (isset($_GET['file']) && !empty($_GET['file'])) {
    unlink('tests/' . $_GET['file']. '.json');
    redirect('list');
}