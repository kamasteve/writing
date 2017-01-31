<?php
//expiry		  
$tstampNow = $_SERVER['REQUEST_TIME'];
$times= $data['expiry'];
			  if($times==16) {
			 $expiry= $tstampNow + 21600; // 6 hrs
			 }
			  if($times==6) {
			 $expiry= $tstampNow + 43200; // 12 hrs
			 }
			  if($times==7) {
			 $expiry= $tstampNow + 86400; // 24 hrs
			 }
			  if($times==8) {
			 $expiry= $tstampNow + 172800; // 48 hrs
			 }
			  if($times==9) {
			 $expiry= $tstampNow + 259200; // 3 days
			 }
			  if($times==10) {
			 $expiry= $tstampNow + 345600; // 4 days
			 }
			  if($times==11) {
			 $expiry= $tstampNow + 432000; // 5 days
			 }
			  if($times==12) {
			 $expiry= $tstampNow + 604800; // 7 days
			 }
			  if($times==13) {
			 $expiry= $tstampNow + 864000; // 10 days
			 }
			  if($times==14) {
			 $expiry= $tstampNow + 1728000; // 20 days
			 }
			  if($times==15) {
			 $expiry= $tstampNow + 2592000; // 30 days
			 }
//status
$status_active = $data['status'];
               if($status_active==1) {
			 $status='1';
			 }	
			   if($status_active=='') {
			 $status='0';
			 }	
			 //status
$status_update = $data['status_e'];
               if($status_update==1) {
			 $status_e='1';
			 }	
			   if($status_update=='') {
			 $status_e='0';
			 }	  	  			 
?>