<?php 
if (checkClient()) { 
 include 'clientLinks.php';  } 
if (checkWriter()) { 
 include 'links.php';  } 
if (checkAdmin()) { 
include 'admin-links.php'; 
 } ?>	