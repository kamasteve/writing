<?php
//academic level
$levels=$data['academic_level'];
			 if($levels==1)	 {
			 $acdmcLevel='High School';
			 }
			 if($levels==2)	 {
			 $acdmcLevel='College';
			 }
			  if($levels==3)	 {
			 $acdmcLevel='Undegraduate';
			 }
			  if($levels==4)	 {
			 $acdmcLevel='Master';
			 }
			  if($levels==5)	 {
			 $acdmcLevel='Ph.D';
			 }
//document type
$document_Type=$data['doctype_x'];
			  if($document_Type==1) {
			 $documentType='Essay';
			 }
			  if($document_Type==2) {
			 $documentType='Term Paper';
			 }
			  if($document_Type==3) {
			 $documentType='Research Paper';
			 }
			  if($document_Type==4) {
			 $documentType='Coursework';
			 }
			  if($document_Type==5)	{
			 $documentType='Book Report';
			 }
			  if($document_Type==6)	{
			 $documentType='Book Review';
			 }
			  if($document_Type==7) {
			 $documentType='Movie Review';
			 }
			   if($document_Type==8) {
			 $documentType='Dissertation';
			 }
			  if($document_Type==9)  {
			 $documentType='Thesis';
			 }
			  if($document_Type==10) {
			 $documentType='Thesis Proposal';
			 }
			  if($document_Type==11) {
			 $documentType='Research Proposal';
			 }
			  if($document_Type==12) {
			 $documentType='Dissertation Chapter - Abstract';
			 }
			  if($document_Type==13) {
			 $documentType='Dissertation Chapter - Introduction Chapter';
			 }
			  if($document_Type==14) {
			 $documentType='Dissertation Chapter - Literature Review';
			 }
			  if($document_Type==15) {
			 $documentType='Dissertation Chapter - Methodology';
			 }
		      if($document_Type==16) {
			 $documentType='Dissertation Chapter - Results';
			 }
			  if($document_Type==17) {
			 $documentType='Dissertation Chapter - Discussion';
			 }
			  if($document_Type==18) {
			 $documentType='Dissertation Chapter - Editing';
			 }
			  if($document_Type==19){
			 $documentType='Dissertation Chapter - Proofreading';
			 }
			  if($document_Type==20) {
			 $documentType='Formatting';
			 }
			  if($document_Type==21) {
			 $documentType='Admission - Application Essay';
			 }
			  if($document_Type==22) {
			 $documentType='Admission - Scholarship Essay';
			 }
			  if($document_Type==23) {
			 $documentType='Admission - ersonal Statement';
			 }
			  if($document_Type==24) {
			 $documentType='Admission - Editing';
			 }
			  if($document_Type==25) {
			 $documentType='Editing';
			 }
			  if($document_Type==26) {
			 $documentType='Proofreading';
			 }
			  if($document_Type==27) {
			 $documentType='Case Study';
			 }
			  if($document_Type==28) {
			 $documentType='Lab Report';
			 }
			  if($document_Type==29) {
			 $documentType='Speech Presentation';
			 }
			  if($document_Type==30) {
			 $documentType='Math Problem';
			 }
			  if($document_Type==31) {
			 $documentType='Article';
			 }
			  if($document_Type==32) {
			 $documentType='Article Critique';
			 }
			   if($document_Type==33) {
			 $documentType='Annotated Bibliography';
			 }
			   if($document_Type==34) {
			 $documentType='Reaction Paper';
			 }
			   if($document_Type==35) {
			 $documentType='Powerpoint Presentation';
			 }
			   if($document_Type==36) {
			 $documentType='Statistics Project';
			 }
		       if($document_Type==37) {
			 $documentType='Multiple Choice Questions (None-Time-Framed)';
			 }
			  if($document_Type==38) {
			 $documentType='Other (Not listed)';
			 }

//Subject area
$subjectArea = $data['order_category'];
               if($subjectArea==10) {
			 $subject_area='Art';
			 }
			  if($subjectArea==11) {
			 $subject_area='Paintings';
			 }
			  if($subjectArea==12) {
			 $subject_area='Architecture';
			 }
			   if($subjectArea==13) {
			 $subject_area='Drama';
			 }
			   if($subjectArea==14) {
			 $subject_area='Theatre';
			 }
			   if($subjectArea==15) {
			 $subject_area='Dance';
			 }
			   if($subjectArea==16) {
			 $subject_area='Movies';
			 }
			   if($subjectArea==17) {
			 $subject_area='Design Analysis';
			 } 	
			   if($subjectArea==18) {
			 $subject_area='Music';
			 }
			  if($subjectArea==112) {
			 $subject_area='Biology';
			 }
			   if($subjectArea==52) {
			 $subject_area='Business';
			 }
			   if($subjectArea==111) {
			 $subject_area='Chemistry';
			 }
			   if($subjectArea==102) {
			 $subject_area='Communications and Media';
			 }
			   if($subjectArea==105) {
			 $subject_area='Advertising';
			 } 		
			   if($subjectArea==107) {
			 $subject_area='Communication Strategies';
			 }
			 if($subjectArea==103) {
			 $subject_area='Journalism';
			 }
			   if($subjectArea==104) {
			 $subject_area='Public Relations';
			 }
			   if($subjectArea==115) {
			 $subject_area='Creative writing';
			 }
			   if($subjectArea==53) {
			 $subject_area='Economics';
			 }
			   if($subjectArea==60) {
			 $subject_area='Accounting';
			 } 		
			   if($subjectArea==61) {
			 $subject_area='Case Study';
			 }
			 if($subjectArea==58) {
			 $subject_area='Company Analysis';
			 }
			   if($subjectArea==62) {
			 $subject_area='E-Commerce';
			 }
			   if($subjectArea==59) {
			 $subject_area='Finance';
			 }
			   if($subjectArea==57) {
			 $subject_area='Investment';
			 }
			   if($subjectArea==63) {
			 $subject_area='Logistics';
			 } 	
			  if($subjectArea==64) {
			 $subject_area='Trade';
			 }
			   if($subjectArea==87) {
			 $subject_area='Education';
			 }
			   if($subjectArea==93) {
			 $subject_area='Application Essay';
			 }
			   if($subjectArea==89) {
			 $subject_area='Education Theories';
			 }
			   if($subjectArea==88) {
			 $subject_area='Pedagogy';
			 } 				
			  if($subjectArea==90) {
			 $subject_area='Teacher\'s Career';
			 }
			   if($subjectArea==67) {
			 $subject_area='Engineering';
			 }
			   if($subjectArea==9) {
			 $subject_area='English';
			 }
			   if($subjectArea==24) {
			 $subject_area='Ethics';
			 }
			   if($subjectArea==36) {
			 $subject_area='History';
			 } 		
			   if($subjectArea==38) {
			 $subject_area='African-American Studies';
			 }
			   if($subjectArea==37) {
			 $subject_area='American History';
			 }
			   if($subjectArea==42) {
			 $subject_area='Asian Studies';
			 }
			   if($subjectArea==41) {
			 $subject_area='Canadian Studies';
			 } 	
			   if($subjectArea==37) {
			 $subject_area='American History';
			 }
			   if($subjectArea==44) {
			 $subject_area='East European Studies';
			 }
			   if($subjectArea==45) {
			 $subject_area='Holocaust';
			 } 				
			   if($subjectArea==40) {
			 $subject_area='Latin-American Studies';
			 }
			   if($subjectArea==39) {
			 $subject_area='Native-American Studies';
			 }
			   if($subjectArea==43) {
			 $subject_area='West European Studies';
			 } 				
			   if($subjectArea==47) {
			 $subject_area='Law';
			 }
			   if($subjectArea==49) {
			 $subject_area='Criminology';
			 }
			   if($subjectArea==48) {
			 $subject_area='Legal Issues';
			 } 				
			   if($subjectArea==7) {
			 $subject_area='Linguistics';
			 }
			   if($subjectArea==2) {
			 $subject_area='Literature';
			 }
			   if($subjectArea==4) {
			 $subject_area='American Literature';
			 } 				
			   if($subjectArea==5) {
			 $subject_area='Antique Literature';
			 }
			   if($subjectArea==6) {
			 $subject_area='Asian Literature';
			 }
			   if($subjectArea==3) {
			 $subject_area='English Literature';
			 } 				
			   if($subjectArea==116) {
			 $subject_area='hakespeare Studies';
			 }
			   if($subjectArea==54) {
			 $subject_area='Management';
			 }
			   if($subjectArea==56) {
			 $subject_area='Marketing';
			 } 				
			   if($subjectArea==51) {
			 $subject_area='Mathematics';
			 }
			   if($subjectArea==94) {
			 $subject_area='Medicine and Health';
			 }
			   if($subjectArea==99) {
			 $subject_area='Alternative Medicine';
			 } 	
			   if($subjectArea==101) {
			 $subject_area='Nursing';
			 }
			   if($subjectArea==95) {
			 $subject_area='Nutrition';
			 } 				
			   if($subjectArea==100) {
			 $subject_area='Pharmacology';
			 }
			   if($subjectArea==96) {
			 $subject_area='Sport';
			 }
			   if($subjectArea==78) {
			 $subject_area='Nature';
			 } 					
			   if($subjectArea==85) {
			 $subject_area='Agricultural Studies';
			 }
			   if($subjectArea==113) {
			 $subject_area='Anthropology';
			 } 				
			   if($subjectArea==86) {
			 $subject_area='Astronomy';
			 }
			   if($subjectArea==83) {
			 $subject_area='Environmental Issues';
			 }
			   if($subjectArea==79) {
			 $subject_area='Geography';
			 } 					
			   if($subjectArea==80) {
			 $subject_area='Geology';
			 }
			   if($subjectArea==28) {
			 $subject_area='Philosophy';
			 } 				
			   if($subjectArea==110) {
			 $subject_area='Physics';
			 }
			   if($subjectArea==29) {
			 $subject_area='Political Science';
			 }
			   if($subjectArea==21) {
			 $subject_area='Psychology';
			 } 					
			   if($subjectArea==108) {
			 $subject_area='Religion and Theology';
			 }
			   if($subjectArea==22) {
			 $subject_area='Sociology';
			 } 				
			   if($subjectArea==65) {
			 $subject_area='Technology';
			 }
			   if($subjectArea==71) {
			 $subject_area='Aeronautics';
			 }
			   if($subjectArea==70) {
			 $subject_area='Aviation';
			 } 					
			   if($subjectArea==72) {
			 $subject_area='Computer Scienc';
			 }
			   if($subjectArea==73) {
			 $subject_area='Internet';
			 } 				
			   if($subjectArea==75) {
			 $subject_area='IT Management';
			 }
			   if($subjectArea==77) {
			 $subject_area='Web Desig';
			 }
			   if($subjectArea==114) {
			 $subject_area='Tourism';
			 } 														
//citation			 
$cite_style = $data['writing_style'];
               if($cite_style==1) {
			 $citation_style='APA';
			 }
			  if($cite_style==2) {
			 $citation_style='MLA';
			 }
			  if($cite_style==3) {
			 $citation_style='Turabian';
			 }
			  if($cite_style==4) {
			 $citation_style='Chicago';
			 }
			  if($cite_style==5) {
			 $citation_style='Harvard';
			 }
			  if($cite_style==6) {
			 $citation_style='Oxford';
			 }
			  if($cite_style==8) {
			 $citation_style='Vancouver';
			 }
			  if($cite_style==9) {
			 $citation_style='CBE';
			 }
			  if($cite_style==7) {
			 $citation_style='Other';
			 }
//Language style
$language = $data['langstyle'];
               if($language==1) {
			 $language_style='English (U.S.)';
			 }
			   if($language==2) {
			 $language_style='English (U.K.)';
			 }
//Currency
$currency = $data['curr'];
               if($currency==1) {
			 $the_currency='USD';
			 }
			 else if($currency==2) {
			 $the_currency='GBP';
			 }
			 else if($currency==3) {
			 $the_currency='CAD';
			 }
			 else if($currency==4) {
			 $the_currency='AUD';
			 }
			 else if($currency==5) {
			 $the_currency='EUR';
			 }
//urgency	

//Africa/Nairobi
$date_now = new DateTime(null, new DateTimeZone('Africa/Nairobi'));
//echo 'Africa/Nairobi: '.$date_now->getTimestamp().'<br />'."\r\n";
	  
$tstampNow = $_SERVER['REQUEST_TIME'];
//$tstampNow = $date_now->getTimestamp();
$times= $data['urgency'];
			  if($times==6) {
			 $urgency= $tstampNow + 21600; // 6 hrs
			 }
			  if($times==12) {
			 $urgency= $tstampNow + 43200; // 12 hrs
			 }
			  if($times==24) {
			 $urgency= $tstampNow + 86400; // 24 hrs
			 }
			 if($times==36) {
			 $urgency= $tstampNow + 129600; // 36 hrs
			 }
			  if($times==48) {
			 $urgency= $tstampNow + 172800; // 48 hrs
			 }
			  if($times==3) {
			 $urgency= $tstampNow + 259200; // 3 days
			 }
			  if($times==5) {
			 $urgency= $tstampNow + 432000; // 5 days
			 }
			  if($times==7) {
			 $urgency= $tstampNow + 604800; // 7 days
			 }
			 if($times==9) {
			 $urgency= $tstampNow + 777600; // 9 days
			 }
			  if($times==10) {
			 $urgency= $tstampNow + 864000; // 10 days
			 }
			  if($times==14) {
			 $urgency= $tstampNow + 1209600; // 14 days
			 }
			  if($times==21) {
			 $urgency= $tstampNow + 1814400; // 21 days
			 }
			  if($times==30) {
			 $urgency= $tstampNow + 2592000; // 1 month
			 }
			 if($times==60) {
			 $urgency= $tstampNow + 5184000; // 2 months
			 }

//Spacing
$spacing_style = $data['spacing'];
               if($spacing_style==1) {
			 $word_spacing='Single Spacing';
			 }	
			 if($spacing_style=='') {
			 $word_spacing='Double Spacing';
			 }	
			 
//Topwriter
$top_w = $data['topwriter'];
               if($top_w==3) {
			 $top_writers='Yes';
			 }	
			 if($top_w=='') {
			 $top_writers='no';
			 }	  

//Vip support
$vip_s = $data['vip_support'];
               if($vip_s==6) {
			 $vip_support='Yes';
			 }	
			 if($vip_s=='') {
			 $vip_support='no';
			 }	  			 			    
  ?>