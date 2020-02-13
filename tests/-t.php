<?php 
require_once "check.php";
$t = new ITests(pre, err);
$t->IncludeAll(".pt");
$t->Run();

halt();