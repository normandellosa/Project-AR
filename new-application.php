<?php 
require_once('dao/carouselDao.php');
require_once('dao/rewardsNewsDao.php');
date_default_timezone_set('Asia/Manila');
$now = date('Y-m-d');

$carousels = carouselDao::carouselList();
$promos = rewardsNewsDao::rno_ListForHomePage('News & Events',$now);

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Home Page</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	

	<!-- IMAGESLOADED -->
	<script type="text/javascript" src="lib/imagesloaded/imagesloaded.pkgd.min.js"></script>

	<!-- FLEXSLIDER -->
	<script src="lib/flexslider/jquery.flexslider-min.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/flexslider/flexslider.css">

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	   <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-new.css">
	<script type="text/javascript" src="js/user-global.js"></script>
	<script type="text/javascript" src="js/user-main.js"></script>
</head>
<body>
	<div class="container">
		<!-- HEADER AND MENU -->
		<?php include("inc/sticky-header.php"); ?>

</div>

			<div class="container inner-page">
				<div class="row">
					<div class="col-sm-9">
				
						<h2><span class="allvalue-red">All</span>Rewards Online Membership Application Form</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				
						<h3>My Personal Information</h3>
				
				
				
				
			 			<form>
			 
			  
			  
					  <div class="row">
		  			    <div class="col-sm-2">
		  					<label><br></label>
			 						 <div class="form-group-select">
					 
			 					    <select class="form-control">
	 				
			 			<option>Mr.</option>
			 			<option>Ms.</option>
						<option>Mrs.</option>
			
			 					    </select>
			 					</div>
		  			    </div>
					    <div class="col-sm-4">
							<label>Last Name</label>
					      <input type="text" class="form-control" required>
					    </div>
					    <div class="col-sm-4">
							<label>First Name</label>
					      <input type="text" class="form-control" required>
					    </div>
					    <div class="col-sm-1">
							<label>M.I.</label>
					      <input type="text" class="form-control" >
					    </div>
				
					    <div class="col-sm-1">
							<label>Suffix</label>
					      <input type="text" class="form-control" >
					    </div>
					  </div>
			  
		   
					  <div class="row">
					    <div class="col-sm-6">
							<label>Landline No.</label>
					      <input type="text" class="form-control" placeholder="Area Code + Phone Number" required>
					    </div>
					    <div class="col-sm-6">
							<label>Mobile No.</label>
					      <input type="text" class="form-control" placeholder="09xx" required>
					    </div>
		   
					  </div>
			  
			  
			  
			  
					  <div class="row">
				    <div class="col-sm-6 no-margin-padding">
		  				<label class="bdaylabel">Date of Birth</label>	
		  					  <div class="form-group ">
			
					
		     						 <div class="form-group-select birth-year-select col-sm-4">
						   
		     					    <select class="form-control col-sm-4" id="birthmonth">
		  						<option>January</option>
		  					<option>February</option>
		  					<option>March</option>
		  					<option>April</option>
		  					<option>May</option>
		  					<option>June</option>
		  					<option>July</option>
		  					<option>August</option>
		  					<option>September</option>
		  					<option>October</option>
		  					<option>November</option>
		  					<option>December</option>
		     					    </select>
		     					</div>
					   
		  	   						 <div class="form-group-select birth-year-select col-sm-4">
							 
		  	   					    <select class="form-control col-sm-4 date-day" >
					
				
		  	   					    </select>
		  	   					</div>
						  
		  						 <div class="form-group-select birth-year-select col-sm-4">
						
		  					    <select class="form-control col-sm-4 date-year">
					
				
		  					    </select>
		  					</div>
		  					  </div>
				    </div>
			   
					    <div class="col-sm-6">
							<label>Citizenship</label>
					      <input type="text" class="form-control" required>
					    </div>
			   
			   
					  </div>
			  
			  
			  
			  
			  
			  
					  <div class="row">
				  
			  		    <div class="col-sm-6">
			  				<label>Email address</label>
			  		      <input type="email" class="form-control" placeholder="name@email.com" required>
			  		    </div>
				  
					    <div class="col-sm-6">
							<label>Gender</label>
								 <div class="form-group-select">
					   
							    <select class="form-control">
				
					<option>Male</option>
					<option>Female</option>
			
							    </select>
							</div>
					    </div>
			    
			   
					  </div>
			  
			  
			  
			
	 			
		  
		   
		   
		 
		  
		  
		   
		   
				  <div class="row">
		   
			
				    <div class="col-sm-6">
						<label>Civil Status</label>
		  						 <div class="form-group-select">
				   
		  					    <select class="form-control">
  				
		  			<option>Single</option>
		  			<option>Married</option>
					<option>Widowed</option>
					<option>Separated</option>
					
				
		
		  					    </select>
		  					</div>
				    </div>
			
			    <div class="col-sm-6">
			
			    </div>
				  </div>
		   
		   	
				   <div class="row">
				   	<div class="col-sm-12"><label>Residential Address</label></div>
				   </div>
		   
		 		  <div class="row">
			 
		   		    <div class="col-sm-2">
   				
		   		      <input type="text" class="form-control" placeholder="No." required>
		   		    </div>
		 		    <div class="col-sm-5">
 				
		 		      <input type="text" class="form-control"placeholder="Street" required>
		 		    </div>
		 		    <div class="col-sm-5">
 			
		 		      <input type="text" class="form-control"placeholder="Subdivision">
		 		    </div>
		   
		 		  </div>
		   
		   
		  		  <div class="row">
			 
		    		    <div class="col-sm-4">
   				
		    		      <input type="text" class="form-control" placeholder="Barangay" required>
		    		    </div>
		  		    <div class="col-sm-4">
 				
		  		      <input type="text" class="form-control"placeholder="City" required>
		  		    </div>
		  		    <div class="col-sm-4">
			 <div class="form-group-select">

		    <select class="form-control">
					 <option selected="true" disabled="disabled">Province</option>

									  			

									  				
					 									  				<option data-province="Abra" value="Abra">Abra</option>



									  			

									  				
					 									  				<option data-province="Agusan Del Norte" value="Agusan Del Norte">Agusan Del Norte</option>



									  			

									  				
					 									  				<option data-province="Agusan Del Sur" value="Agusan Del Sur">Agusan Del Sur</option>



									  			

									  				
					 									  				<option data-province="Aklan" value="Aklan">Aklan</option>



									  			

									  				
					 									  				<option data-province="Albay" value="Albay">Albay</option>



									  			

									  				
					 									  				<option data-province="Antique" value="Antique">Antique</option>



									  			

									  				
					 									  				<option data-province="Aurora" value="Aurora">Aurora</option>



									  			

									  				
					 									  				<option data-province="Basilan" value="Basilan">Basilan</option>



									  			

									  				
					 									  				<option data-province="Bataan" value="Bataan">Bataan</option>



									  			

									  				
					 									  				<option data-province="Batanes" value="Batanes">Batanes</option>



									  			

									  				
					 									  				<option data-province="Batangas" value="Batangas">Batangas</option>



									
									  				
					 									  				<option data-province="Benguet" value="Benguet">Benguet</option>



									  			

									  				
					 									  				<option data-province="Biliran" value="Biliran">Biliran</option>



									  			

									  				
					 									  				<option data-province="Bohol" value="Bohol">Bohol</option>



									  			

									  				
					 									  				<option data-province="Bukidnon" value="Bukidnon">Bukidnon</option>



									  			

									  				
					 									  				<option data-province="Bulacan" value="Bulacan">Bulacan</option>



									  			

									  				
					 									  				<option data-province="Cagayan" value="Cagayan">Cagayan</option>



									  			

									  				
					 									  				<option data-province="Camarines Norte" value="Camarines Norte">Camarines Norte</option>



									  			

									  				
					 									  				<option data-province="Camarines Sur" value="Camarines Sur">Camarines Sur</option>



									  			

									  				
					 									  				<option data-province="Camiguin" value="Camiguin">Camiguin</option>



									  			

									  				
					 									  				<option data-province="Capiz" value="Capiz">Capiz</option>



									  			

									  				
					 									  				<option data-province="Catanduanes" value="Catanduanes">Catanduanes</option>



									  			

									  				
					 									  				<option data-province="Cavite" value="Cavite">Cavite</option>



									  			

									  				
					 									  				<option data-province="Cebu" value="Cebu">Cebu</option>



									  			

									  				
					 									  				<option data-province="Compostela Valley" value="Compostela Valley">Compostela Valley</option>



									  			

									  				
					 									  				<option data-province="Davao" value="Davao">Davao</option>



									  			

									  				
					 									  				<option data-province="Davao del Sur" value="Davao del Sur">Davao del Sur</option>



									  			

									  				
					 									  				<option data-province="Davao Oriental" value="Davao Oriental">Davao Oriental</option>



									  			

									  				
					 									  				<option data-province="Eastern Samar" value="Eastern Samar">Eastern Samar</option>



									  			

									  				
					 									  				<option data-province="Guimaras" value="Guimaras">Guimaras</option>



									  			

									  				
					 									  				<option data-province="Ifugao" value="Ifugao">Ifugao</option>



									  			

									  				
					 									  				<option data-province="Ilocos Norte" value="Ilocos Norte">Ilocos Norte</option>



									  			

									  				
					 									  				<option data-province="Ilocos Sur" value="Ilocos Sur">Ilocos Sur</option>



									  			

									  				
					 									  				<option data-province="Iloilo" value="Iloilo">Iloilo</option>



									  			

									  				
					 									  				<option data-province="Isabela" value="Isabela">Isabela</option>



									  			

									  				
					 									  				<option data-province="Kalinga" value="Kalinga">Kalinga</option>



									  			

									  				
					 									  				<option data-province="La Union" value="La Union">La Union</option>



									  			

									  				
					 									  				<option data-province="Laguna" value="Laguna">Laguna</option>



									  			

									  				
					 									  				<option data-province="Lanao del Norte" value="Lanao del Norte">Lanao del Norte</option>



									  			

									  				
					 									  				<option data-province="Lanao del Sur" value="Lanao del Sur">Lanao del Sur</option>



									  			

									  				
					 									  				<option data-province="Leyte" value="Leyte">Leyte</option>



									  			

									  				
					 									  				<option data-province="Maguindanao" value="Maguindanao">Maguindanao</option>



									  			

									  				
					 									  				<option data-province="Marinduque" value="Marinduque">Marinduque</option>



									  			

									  				
					 									  				<option data-province="Masbate" value="Masbate">Masbate</option>



									  			

									  				
					 									  				<option data-province="Metro Manila" value="Metro Manila">Metro Manila</option>



									  			

									  				
					 									  				<option data-province="Misamis Occidental" value="Misamis Occidental">Misamis Occidental</option>



									  			

									  				
					 									  				<option data-province="Misamis Oriental" value="Misamis Oriental">Misamis Oriental</option>



									  			

									  				
					 									  				<option data-province="Mountain Province" value="Mountain Province">Mountain Province</option>



									  			

									  				
					 									  				<option data-province="Negros Occidental" value="Negros Occidental">Negros Occidental</option>



									  			

									  				
					 									  				<option data-province="Negros Oriental" value="Negros Oriental">Negros Oriental</option>



									  			

									  				
					 									  				<option data-province="North Cotabato" value="North Cotabato">North Cotabato</option>



									  			

									  				
					 									  				<option data-province="Nothern Samar" value="Nothern Samar">Nothern Samar</option>



									  			

									  				
					 									  				<option data-province="Nueva Ecija" value="Nueva Ecija">Nueva Ecija</option>



									  			

									  				
					 									  				<option data-province="Nueva Vizcaya" value="Nueva Vizcaya">Nueva Vizcaya</option>



									  			

									  				
					 									  				<option data-province="Occidental Mindoro" value="Occidental Mindoro">Occidental Mindoro</option>



									  			

									  				
					 									  				<option data-province="Oriental Mindoro" value="Oriental Mindoro">Oriental Mindoro</option>



									  			

									  				
					 									  				<option data-province="Palawan" value="Palawan">Palawan</option>



									  			

									  				
					 									  				<option data-province="Pampanga" value="Pampanga">Pampanga</option>



									  			

									  				
					 									  				<option data-province="Pangasinan" value="Pangasinan">Pangasinan</option>



									  			

									  				
					 									  				<option data-province="Quezon" value="Quezon">Quezon</option>



									  			

									  				
					 									  				<option data-province="Quirino" value="Quirino">Quirino</option>



									  			

									  				
					 									  				<option data-province="Rizal" value="Rizal">Rizal</option>



									  			

									  				
					 									  				<option data-province="Romblon" value="Romblon">Romblon</option>



									  			

									  				
					 									  				<option data-province="Samar (Western Samar)" value="Samar (Western Samar)">Samar (Western Samar)</option>



									  			

									  				
					 									  				<option data-province="Sarangani" value="Sarangani">Sarangani</option>



									  			

									  				
					 									  				<option data-province="Siquijor" value="Siquijor">Siquijor</option>



									  			

									  				
					 									  				<option data-province="Sorsogon" value="Sorsogon">Sorsogon</option>



									  			

									  				
					 									  				<option data-province="South Cotabato" value="South Cotabato">South Cotabato</option>



									  			

									  				
					 									  				<option data-province="Southern Leyte" value="Southern Leyte">Southern Leyte</option>



									  			

									  				
					 									  				<option data-province="Sultan Kudarat" value="Sultan Kudarat">Sultan Kudarat</option>



									  			

									  				
					 									  				<option data-province="Sulu" value="Sulu">Sulu</option>



									  			

									  				
					 									  				<option data-province="Surigao del Norte" value="Surigao del Norte">Surigao del Norte</option>



									  			

									  				
					 									  				<option data-province="Surigao del Sur" value="Surigao del Sur">Surigao del Sur</option>



									  			

									  				
					 									  				<option data-province="Tarlac" value="Tarlac">Tarlac</option>



									  			

									  				
					 									  				<option data-province="Tawi- Tawi" value="Tawi- Tawi">Tawi- Tawi</option>



									  			

									  				
					 									  				<option data-province="Zambales" value="Zambales">Zambales</option>



									  			

									  				
					 									  				<option data-province="Zamboanga del Norte" value="Zamboanga del Norte">Zamboanga del Norte</option>



									  			

									  				
					 									  				<option data-province="Zamboanga del Sur" value="Zamboanga del Sur">Zamboanga del Sur</option>



									  			

									  				
					 									  				<option data-province="Zamboanga Sibugay" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
		  		     
					 </select>
		  		    </div>
					</div>
		   
		  		  </div>
		   
		   
		   		  <div class="row">
		   
			
		   		    <div class="col-sm-6">
		   				<label>Home Ownership</label>
		     						 <div class="form-group-select">
				   
		     					    <select class="form-control">
		     				<option>Rented</option>
		     			<option>Owned</option>
		     			<option>Living With Relatives</option>
   			
		
		     					    </select>
		     					</div>
		   		    </div>
			
		   	    <div class="col-sm-6">
					<label>Occupation</label>
		 						 <div class="form-group-select">
			   
		 					    <select class="form-control">
		 				<option>Company Employee</option>
		 			<option>Self-Employed</option>
		 			<option>Not Employed</option>
					<option>Retired</option>
		
	
		 					    </select>
		 					</div>
		   	    </div>
		   		  </div>
		   
		   
		   
				   <div class="row">
		      	    <div class="col-sm-6">
		   			<label>Do you know anyone who works at any AllValue store?</label>
		    						 <div class="form-group-select">
			   
		    					    <select class="form-control">
    				
		    			<option>Yes</option>
		    			<option>No</option>
		
	
		    					    </select>
		    					</div>
		      	    </div>
      		
			
			
		      	    <div class="col-sm-6">
		   			<label>Total household monthly income</label>
		    						 <div class="form-group-select">
			   
		    					    <select class="form-control">
		    				<option>Below Php 15,000</option>
		    			<option>Php 15,001 - Php 30,000</option>
						<option>Php 30,001 - Php 50,000</option>
						<option>Php 50,001 - Php 100,000</option>
						<option>Php 100,001 - Php 250,000</option>
						<option>Php 250,001 - Php 500,000</option>
		
				<option>Php 500,000 and above</option>
		    					    </select>
		    					</div>
		      	    </div>
      		  
		   
		   
		   
		   
				   </div>
		   
		   
		   
		   		   <div class="row">
		         	    <div class="col-sm-6">
		      			<label>OFW Family Member</label>
		       						 <div class="form-group-select">
			   
		       					    <select class="form-control">
		    			<option>Yes</option>
		    			<option>No</option>
		
	
		       					    </select>
		       					</div>
		         	    </div>
      		
			
			
		     	    <div class="col-sm-6">
		  			<label>Do you own a car?</label>
		   						 <div class="form-group-select">
		   
		   					    <select class="form-control">
					<option>Yes</option>
					<option>No</option>
	

		   					    </select>
		   					</div>
		     	    </div>
         	
		   
		   
		   
		   		   </div>
		   
		   
		   
		   
		   
		   		   <div class="row">
		         	    <div class="col-sm-6">
		      			<label>How should we communicate with you?</label>
		       						 <div class="form-group-select">
			   
		       					    <select class="form-control">
		    			<option>Email</option>
		    			<option>Mobile</option>
		    			<option>Mail</option>
		    			<option>Home Phone</option>
		
	
		       					    </select>
		       					</div>
		         	    </div>
      		
			
			
		     	    <div class="col-sm-6">
		  			<label>No. of Household Members</label>
		   						 <div class="form-group-select">
		   
		   					    <select class="form-control">
					<option>1-3</option>
					<option>4-6</option>
					<option>7 or more</option>
	

		   					    </select>
		   					</div>
		     	    </div>
         	
		   
		   
		   
		   		   </div>
		   
		   
		   
		   
				
		  
		 
		
	 			 
			  
					  <div class="terms-and-conditions">
			 
			  
					  <div class="terms-conditions-scroll">
				  
						  <h3 class="no-margin-top">TERMS AND CONDITIONS</h3>
				
						  					<p>Please read the terms and conditions before using this site. By continuing to access or use this site, or any service on this site, you signify YOUR ACCEPTANCE OF THE TERMS AND CONDITIONS.</p>

						  					<h3>QUALIFICATIONS FOR MEMBERSHIP</h3>

						  					<ol>
						  					<li>Must be at least 18 years old.</li>
						  					<li>A resident of the Philippines.</li>
						  					<li>With valid identification cards.</li>
						  					</ol>

						  					<h3>PROCEDURE FOR APPLICATION</h3>

						  					<ol>
						  					<li>Apply at the Customer Service Counter of any AllValue Store (AllDay [Mart and Supermarket], AllHome, AllShoppe and Coffee Project).</li>
						  					<li>Fill in the membership application form and submit the necessary requirements. Photocopy of any one of the following valid IDs:
						  					<ul>
						  					<li>Passport</li>
						  					<li>Driver’s License</li>
						  					<li>SSS/GSIS/Unified ID</li>
						  					<li>NBI Clearance</li>
						  					<li>Vote’s ID</li>
						  					<li>TIN ID</li>
						  					<li>Postal ID</li>
						  					<li>Company ID</li>
						  					<li>PRC ID</li>
						  					</ul>
						  					</li>
						  					<li>Upon completion of the membership application form, submission of the necessary requirements and the payment of P150.00 Sign-up Fee, proceed to the Customer Service Counter to claim temporary AllRewards card and vouchers.</li>

						  					</ol>

						  					<h3>CHECKING OF POINTS</h3>

						  					<p>Customers with purchase can ask the cashiers to check available points at the checkout counter. Otherwise, customers may check their balance at the customer service counters of any AllValue Store or call customer service hotline: 0918.991.5555.</p>
					
						  					<h3>EARNING OF POINTS</h3>
					
						  					<ol>
						  					<li>Card must be presented to the cashier at the start of every transaction. No card, no points earned shall be strictly enforced.</li>
						  					<li>Every P400 purchase at any AllValue Store entitles the member to 1 point which is equivalent to P1. Points earned are based on the total amount paid (VAT included or Net of Discount).</li>
						  					</ol>
					
						  					<h3>CLAIMING/REDEMPTION OF REWARDS</h3>
					
						  					<ol>
						  					<li>Shopper must present his/her AllRewards Card and a valid ID.</li>
						  					<li>Card must have a minimum of P30 points to qualify for the FIRST redemption.</li>
						  					<li>Redemptions of points are considered final. Points redeemed cannot be cancelled or returned.</li>
						  					<li>A member will receive notifications via email or text for reward entitlements.</li>
						  					</ol>
					
						  					<h3>GENERAL CONDITIONS</h3>
					
						  					<ol type="1">
						  					 <li>The terms and conditions stated in this form shall serve as the basis and guidelines of the issuance and use of the AllRewards Card and shall also define the rights and obligations of the AllRewards Card member. Members are subject to these guidelines and are deemed to have accepted the terms and conditions upon signing of the membership application form.</li>
						  					 <li>The AllRewards Card is not a discount card.</li>
						  					 <li>The AllRewards Card is not transferable and is valid for the use by the member whose name appears on the card. </li>
						  					 <li>A member is only allowed to have one (1) AllRewards Card. If a member applies for a second card, the old AllRewards Card shall be deactivated. Points, if any, shall be carried over to the newly issued AllRewards Card.</li>
						  					 <li>Membership is for the duration of the life of the member and will be terminated automatically with all rights and privileges void upon the death of the member.</li>
						  					 <li>The remaining points of member shall be forfeited after two years of no transactions with any AllValue store.</li>
						  					 <li>For card membership update, one valid ID shall be submitted along with card update form. No new card will be issued.</li>
						  					 <li>For the lost card replacement, the member shall submit an affidavit of loss and pay the P100.00 lost card replacement fee.</li>
						  					 <li>For damaged card, member must fill up the card replacement form and pay the P100.00 card replacement fee. </li>
						  					 <li>By redeeming the rewards points, the member releases AllValue or any of its stores from any and all liability regarding the use and privileges of the AllRewards Card.</li>
						  					 <li>The information supplied by the member during application may be used for by AllValue or any of its stores for administrative and/or marketing purposes. AllValue stores shall endeavor to provide members with accurate and timely information regarding AllValue stores and promotions and shall not be liable in any way for failure to do so.</li>
						  					 <li>AllValue stores reserves the right all the times, without notice and in its sole discretion:
						  					 	<ol type="a">
						  					 	<li>To make any changes or whatsoever to these Terms and Condition including the rules and 	guidelines in the AllRewards Program.</li>
						  					 	<li>To withdraw, cancel, withhold, substitute, deny access to or use of, or in any way change any of the 	rewards or privileges previously advertised or offered to any member, at any time, without prior notice, 	in this regard, AllValue stores shall not be liable to any loss or damaged suffered by the member 	resulting from said withdrawal, cancellation, withholding, substitution, denial of access or use or 	change in the rewards or privileges previously advertised.</li>
						  					 	<li>To terminate or materially alter AllRewards program and/ or revoke the loyalty card.</li>
						  					 	<li>To make adjustments on accumulated transactions as it sees fit, including, but not limited to, 	deduction of amount of accumulated transaction arising from returned goods or service/s purchased.</li>
						  					 	<li>The Terms, Conditions, and Guidelines cannot be superseded or changed except by AllValue.</li>
						  					 	</ol>
						  					 </li>
						  					 <li>The following acts are considered Breach of Terms and Conditions by a member:
						  					 	<ol type="a">
						  					 	<li>Any fraudulent act which is likely to be detrimental to the interest of AllValue and its stores.</li>
						  					 	<li>Any misinformation or misrepresentation made to AllValue and its stores.</li>
						  					 	<li>Any act, in the careful and reasonable opinion of AllValue and its stores, tantamount to breach of 	these Terms and Conditions.</li>
						  					 	<li>Breach of any of the terms and Conditions whether intentional or otherwise may result in the 	termination of membership and cancellation of rewards or privileges, and shall affect its eligibility for 	future or further participation in any rewards program of AllValue and its stores. AllValue and its stores shall not be liable in any way for any earned or accrued rewards of a terminated card member.</li>
						  					 	</ol>
						  					 </li>
						  					 <li>AllValue will resolve all questions or disputes regarding eligibility for membership in the AllRewards Card Program or eligibility for redemption of rewards or privileges at its sole discretion.</li>
						  					 <li>Failure of AllValue to enforce a particular term, condition or guideline shall not constitute as waiver of AllValue of that term, condition or guideline.</li>
						  					 <li>The member shall be personally liable for any and all costs, charges, claims or liabilities including duties, taxes and fees from third parties, government and non-government entities of whatever nature arising from the use of any privilege, as provided by AllValue Card and the redemption or use of any rewards or privilege.</li>
						  					 <li>Any loss, damage, injury and/or liability of whatever nature or cause that may be suffered upon by third parties or the member arising out of, or in connection with, maintenance and use of the AllRewards Card shall be the sole responsibility of the member. In this connection, the member shall be solely liable and shall hold the AllValue or any of its stores, or its affiliates free and harmless from any liability of whatever kind and nature arising from and occasioned by maintenance and use of the AllRewards Card.</li>
						  					</ol>
					
						  					<p>Terms and Conditions are subject to change without prior notice.</p>
					  </div>
			  
			  <hr>
		  			  <div class="form-group accept-check">
		  			     <div class="form-check">
		  			       <input class="form-check-input" type="checkbox" id="gridCheck1" required>
		  			       <label class="form-check-label" for="gridCheck1">
		  	  		     I certify that all the information above are true and correct.
			        
		  			       </label><br>
  				 
		  			     </div>
		  			   </div>
			  
			  
		  			  <div class="form-group ">
		  			     <div class="form-check">
		  			       <input class="form-check-input" type="checkbox" id="gridCheck" required>
		  			       <label class="form-check-label" for="gridCheck">
		  	  		      Accept Terms of Service*
			        
		  			       </label><br>
		  				   <small> By clicking on ‘Continue’ below you are agreeing to the Terms of Service and both the Program Policy and the Privacy Policy of AllRewards.</small>
		  			     </div>
		  			   </div>
					  </div>
			  
			  
	 			 
			  
			  
			 
		   
			 		   <input type="submit" class="submit-but" value="Continue">
			  
			 			</form>
				
				
				
				
				
				
				
					</div>
		
			
			
		
					<div class="col-sm-3 rewards-right"><img src="images/all-reward-card-front.png" class="img-responsive"></div>
		
		
			</div>

		</div>
		

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript">
	$(".menu-home").addClass("active");
</script>
</html>