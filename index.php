<?php
	include 'db.php';
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
	header('Content-type: application/json; charset=utf-8');
	header('Content-type: application/json; charset=utf-8'); 

	$ussdRequest = json_decode(@file_get_contents('php://input')); 
	$ussdResponse = new stdclass;

	if($ussdRequest!=NULL)
	{
		switch ($ussdRequest->Type) {
			case "Initiation":

				$ussdResponse->Message = "WELCOME TO KNUST CSS POLL CENTER\n"."1. CSS Presidential \n 2. CSS Organizer\n 3. CSS Secretary\n 4.  CSS Financial";
				;
				$ussdResponse->Type = "Response";
				break;
			case "Response":
				switch ($ussdRequest->Sequence) {
					case 2:
						switch ($ussdRequest->Message) {
							case '1':
							  $row1=implode(" ",$rows[0] );
							       $ussdResponse->Message = "Choose your CSS President \n"."1. $row1 \n2. Aaron \n 3. Mary";
										$ussdResponse->Type="Response";
								break;
							case '2':
									$ussdResponse->Message = "Choose your CSS Organizer \n"."1.  Ike \n 2. bentil \n 3. esther";
										$ussdResponse->Type="Response";						
									break;
							case '3':
									$ussdResponse->Message = "Choose your CSS Organizer \n"."1.  Ike \n 2. bentil \n 3. esther";
										$ussdResponse->Type="Response";	
							case '4':
								  $ussdResponse->Message = "Choose your CSS Organizer \n"."1.  Ike \n 2. bentil \n 3. esther";
										$ussdResponse->Type="Response";	
								break;
							default:
								$ussdResponse->Message="ussd input must be 1 to 4";
							 	$ussdResponse->Type="Release";
								break;
						}

					case 3:
						# code...
						break;
				}
				break;
		}
	}
	else{
		$ussdResponse->Message= "invalid ussd request";
		$ussdResponse->Type = "Release";
	}
	header('Content-type: application/json; charset=utf-8');
     echo json_encode($ussdResponse);