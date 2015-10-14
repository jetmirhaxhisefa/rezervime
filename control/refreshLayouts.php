<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$pageLayout = new PageLayout();
// check layout design in themes folder and images of those in images/layout folder. Only if there are both of them insert in database
$pageLayout->refreshLayouts($database);
redirect("../pages.php?pages=3");