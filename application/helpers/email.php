<?php defined('SYSPATH') OR die('No direct access allowed.');
class Email{
	
	public function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
	}

	/** SEND EMAIL **/

	public function send($to = "", $from = "", $subject = "", $message = "")
	{
		if(!$from){
			$from = CONTACT_EMAIL;
		}
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$from.'' . "\r\n";
		email::send_email($to, $subject, $message, $headers);
		return;
	}

	public function send_email($to_email = "", $subject = "", $html = "")
	{

		ini_set('memory_limit', '256M');
			if(!ini_get('safe_mode') ){
				set_time_limit(7200);
			}
			include APPPATH."/vendor/swift/SmtpApiHeader.php";
			include APPPATH."/vendor/swift/lib/swift_required.php";


				if(valid::email($to_email)){
					//$subject = 'Offer - Ndot Deal Aggregator Script';
					$from = array('Uniecommerce@ndot.in' => 'Uniecommerce');
					$to = array( $to_email => $to_email);
					//$html = new View("yipit_email");

					$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
					$transport ->setUsername("ndot");
					$transport ->setPassword("whiter34");

					$swift = Swift_Mailer::newInstance($transport);
					$message = new Swift_Message($subject);
					$message->setFrom($from);
					$message->setTo($to);
					$message->setBody($html, 'text/html');

					if($recipients = $swift->send($message, $failures)){
					  echo 'Message sent out to '.$recipients.' users';
					}
					else{
					 echo "Something went wrong";
					}
				}
		return;

	}

	/** SEND EMAIL USING SMTP MAILER **/

    public function smtp($from = "",$receiver = array(), $subject = "", $message = "",$file = "")
    {
		
		
		

        $sitename = SITENAME;
        if(!$sitename){
            $sitename = $_SERVER['HTTP_HOST'];
        }
        $fromEmail = NOREPLY_EMAIL;
        if(!$fromEmail){
            $fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
        }
        require_once(APPPATH.'vendor/mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
		/*
			TODO
			Mail testing parameters.
			Google Mail may have blacklisted my IP,
			so I have turned a different smtp server. Will revert
			to Google Mail on whitelisting( which takes some days :-()
			On stability, need to turn to default settings as per the db.
			@Live
		*/
		
		$receiver = "livetest172@gmail.com";
		
        try {
            //$mail->Host       = "smtp.gmail.com";          //SMTP server
            $mail->SMTPDebug  = 2;                           //enables SMTP debug information (for testing)
            $mail->SMTPAuth   = TRUE;                        //enable SMTP authentication
            $mail->SMTPSecure = "ssl";                       //sets the prefix to the servier
            $mail->Host       = "dime193.dizinc.com";		 //HOST; // sets GMAIL as the SMTP server
            $mail->Port       = 465;						 //PORT;// set the SMTP port for the GMAIL server
            $mail->Username   = "paulkigozi@cyberdynamics.co.ug";//USERNAME;
            $mail->Password   = "cyber@123";//PASSWORD;

            $mail->AddReplyTo($from) ;
            $mail->AddAddress($receiver);
            $mail->SetFrom($from);
            $mail->Subject = $subject;
            $mail->MsgHTML($message);

            if($file != "")
			{
					foreach($file as $f){
						$mail->AddAttachment($f);

					}
			}
			//$mail->AddAttachment("images/pdf/Voucher0.pdf");
			
			if(!$status = $mail->send()){
				error_log("Mail Sending FAILED");
				 common::message(-1,  "Operation was complete but sending email failed. Please contact administrator");
				return FALSE;
			}
			

        }
        catch(phpmailerException $e) {
			error_log($e->getMessage());
			  common::message(-1,  $e->errorMessage());
			return FALSE;

        }
        catch (Exception $e) {
			error_log($e->getMessage());
            common::message(-1,  $e->getMessage());
			return FALSE;
        }
        return TRUE;
    }

		/** SEND EMAIL USING SMTP MAILER **/

    public function smtp1($from = "",$receiver = array(), $subject = "", $message = "")
    {

		

        $sitename = SITENAME;
        if(!$sitename){
            $sitename = $_SERVER['HTTP_HOST'];
        }
        $fromEmail = NOREPLY_EMAIL;
        if(!$fromEmail){
            $fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
        }
        require_once(APPPATH.'vendor/mail/class.phpmailer.php');
        $mail = new PHPMailer(TRUE);
        $mail->IsSMTP();
		$receiver = array("livetest172@gmail.com");
        try {
             $mail->Host      = "dime193.dizinc.com";         // SMTP server
            $mail->SMTPDebug  = 2;                             // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = TRUE;                          // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                         // sets the prefix to the servier
            //$mail->Host       = HOST;                  // sets GMAIL as the SMTP server
            $mail->Port       = PORT;                  // set the SMTP port for the GMAIL server
            $mail->Username   = "paulkigozi@cyberdynamics.co.ug";
            $mail->Password   = "cyber@123";

			var_dump("Hello");
			

	    foreach($receiver as $rec)  {

            $mail->AddAddress($rec);
            $mail->SetFrom($from);
            $mail->Subject = $subject;
            $mail->MsgHTML($message);
            $mail->Send();
		}
        }
        catch(phpmailerException $e) {
            common::message(-1,  $e->errorMessage());
            url::redirect(PATH."admin/send-daily-deals.html");
        }
        catch (Exception $e) {
            common::message(-1,  $e->getMessage());
        }
        return;
    }

	/** SEND GRID FUNCTION **/

	public function sendgrid($from = "", $receiver = array(), $subject = "", $message = "")
	{


		include APPPATH."/vendor/swift/lib/swift_required.php";
	        include_once APPPATH."/vendor/swift/SmtpApiHeader.php";
		$hdr = new SmtpApiHeader();
		$times = array();
		$names = array();

		$hdr->addFilterSetting('subscriptiontrack', 'enable', 1);
		$hdr->addFilterSetting('twitter', 'enable', 1);

		$hdr->addTo($receiver);


		$hdr->addSubVal('-time-', $times);
		$hdr->addSubVal('-name-', $names);
		$hdr->setUniqueArgs(array());

		$sitename = SITENAME;
		if(!$sitename){
			$sitename = $_SERVER['HTTP_HOST'];
		}
		$fromEmail = $from;
		if(!$fromEmail){
			$fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
		}

		$from = array($fromEmail => $sitename );

		$to = array('defaultdestination@example.com' => 'Personal Name Of Recipient');
		$text = "test text..";
		$html = $message;


		$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);

		$transport ->setUsername(SMTP_USERNAME);

		$transport ->setPassword(SMTP_PASSWORD);
		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$headers = $message->getHeaders();

		$headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());

		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);
		$message->addPart($text, 'text/plain');

		if ($recipients = $swift->send($message, $failures)){
		  //common::message(1, "Message sent out to ".$recipients." users");
		}
		else{
		  //common::message(-1, "Something went wrong - Try Later");
		}
		return;
	}

	/** SEND GRID ATTACHED FILE FUNCTION **/

	public function sendgrid_attach($receiver= "", $subject = "", $message = "", $file = "")
	{

		        $strSid = md5(uniqid(time()));

                $strHeader = "";
                $strHeader .= "From:".CONTACT_EMAIL."\r\n";

                $strHeader .= "MIME-Version: 1.0\n";
                $strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
                $strHeader .= "This is a multi-part message in MIME format.\n";

                $strHeader .= "--".$strSid."\n";
                $strHeader .= "Content-type: text/html; charset=utf-8\n";
                $strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
                $strHeader .= $message."\n\n\n\n\n\n\n\n\n\n";

                //*** Attachment ***//
                if($file != "")
                {
                        $j=1;
                        foreach ($file as $f){
                        $strFilesName = $f;
                        $strContent = chunk_split(base64_encode(file_get_contents($f)));
                        $strHeader .= "--".$strSid."\n";
                        $strHeader .= "Content-Type: application/octet-stream; name=\"".str_replace("$strFilesName","$j".' Voucher.pdf',"$strFilesName")."\"\n";
                        $strHeader .= "Content-Transfer-Encoding: base64\n";
                        $strHeader .= "Content-Disposition: attachment; filename=\"".str_replace("$strFilesName","$j".' Voucher.pdf',"$strFilesName")."\"\n\n";
                        $strHeader .= $strContent."\n\n";
                        $j++;
                        }
                }

                $flgSend = mail($receiver,$subject,null,$strHeader);

	}


public function sendgrid_attach1($receiver= "", $subject = "", $message = "", $file = "")
	{


		include APPPATH."/vendor/swift/lib/swift_required.php";
		include_once APPPATH."/vendor/swift/SmtpApiHeader.php";
		$hdr = new SmtpApiHeader();
		$times = array();
		$names = array();

		$hdr->addFilterSetting('subscriptiontrack', 'enable', 1);
		$hdr->addFilterSetting('twitter', 'enable', 1);
		$hdr->addTo($receiver);

		$hdr->addSubVal('-time-', $times);
		$hdr->addSubVal('-name-', $names);
		$hdr->setUniqueArgs(array());

		$sitename = SITENAME;
		if(!$sitename){
			$sitename = $_SERVER['HTTP_HOST'];
		}
		$fromEmail = CONTACT_EMAIL;
		if(!$fromEmail){
			$fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
		}

		$from = array($fromEmail => $sitename );

		$to = array('defaultdestination@example.com' => 'Personal Name Of Recipient');
		$text = "test text..";
		$html = $message;


		$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);

		$transport ->setUsername(SMTP_USERNAME);

		$transport ->setPassword(SMTP_PASSWORD);
		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$headers = $message->getHeaders();

		$headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());

		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($receiver);
		if($file != "")
		{

		$message->addPart($text, 'text/plain');
		foreach($file as $f){
			$message->attach(Swift_Attachment::fromPath($f));

		}
		}
		if ($swift->send($message)){
		  //common::message(1, "Message sent out to ".$recipients." users");
		}
		else{
		  //common::message(-1, "Something went wrong - Try Later");
		}
		return;

          }
      /** SEND GRID ( FROM TO TO ) FUNCTION **/

      public function sendgrid1($receiver = array(),$from = "", $subject = "", $message = "")
	  {
		include APPPATH."/vendor/swift/lib/swift_required.php";
		include APPPATH."/vendor/swift/SmtpApiHeader.php";
		$hdr = new SmtpApiHeader();
		$times = array();
		$names = array();

		$hdr->addFilterSetting('subscriptiontrack', 'enable', 1);
		$hdr->addFilterSetting('twitter', 'enable', 1);
		$hdr->addTo($receiver);

		$hdr->addSubVal('-time-', $times);
		$hdr->addSubVal('-name-', $names);
		$hdr->setUniqueArgs(array());

		$sitename = SITENAME;
		if(!$sitename){
			$sitename = $_SERVER['HTTP_HOST'];
		}
		$fromEmail = $from;
		if(!$fromEmail){
			$fromEmail = "noreply@".$_SERVER['HTTP_HOST'];
		}

		$from = array($fromEmail => $from );
		$to = array('defaultdestination@example.com' => 'Personal Name Of Recipient');
		$text = "test text..";
		$html = $message;

		$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
		$transport ->setUsername(SMTP_USERNAME);
		$transport ->setPassword(SMTP_PASSWORD);
		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);

		$headers = $message->getHeaders();
		$headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());

		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);
		$message->addPart($text, 'text/plain');

		if ($recipients = $swift->send($message)){
		  //common::message(1, "Message sent out to ".$recipients." users");
		}
		else{
		  //common::message(-1, "Something went wrong - Try Later");
		}
		return;
	}



      /** SEND MAIL CHIMP FUNCTION **/

        public function mailchimp($from = "",$receiver = array(), $subject = "", $message = "")
	 {
	//send newsletter using mailchimp
		require_once(APPPATH.'vendor/mail_chimp/MCAPI.class.php');

	$api = new MCAPI(API);
	$retval = $api->listInterestGroupings(LISTID);

	if ($api->errorCode)
	{

		echo "Unable to list groupings!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	}
	else
	{


		$gid = $retval[0];
		$grid = $gid['id'];
	}


	$conditions = array();
	$conditions[] = array('field'=>'interests-'.$grid , 'op'=>'all','value'=>'testuniecommerce');
	$segment_opts = array('match'=>'all', 'conditions'=>$conditions);
	$retval = $api->campaignSegmentTest(LISTID, $segment_opts );


	if ($api->errorCode)
	{

		echo "Unable to Segment Campaign!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	}
	else
	{
		//echo "Your Segement matched [".$retval."] subscriber.\n";
	}

	//hash of the following
	$opts['list_id'] = LISTID;
	$opts['subject'] = $subject;
	$opts['from_email'] = $from;
	$opts['from_name'] = FROM;
	//foreach($receiver as $re) {
	$opts['to_name'] = $receiver;

	//}
	//end of hash array


	$content = array('html'=> $message, 'text' => $message);

	$cid = $api->campaignCreate('plaintext',$opts,$content,$segment_opts);

	if ($api->errorCode)
	{


		$err = "Unable to Create New Campaign!".$api->errorCode.$api->errorMessage;
		//set_response_mes(-1,$err);
		common::message(-1, $err);
		 url::redirect(PATH);

	}
	else
	{

		$output =  "New Campaign ID:" . $cid . "\n";
	}
	$return = $api->campaignSendNow($cid);

	if ($api->errorCode)
	{

		$err = "Unable to Send Campaign!".$api->errorCode.$api->errorMessage;
		set_response_mes(-1,$err);
		url::redirect(PATH);
	}
	else
	{

		common::message(1, "success");
		url::redirect(PATH);
	}

}

	/** SEND MAIL CHIMP FUNCTION **/

        public function mailchimp2($from = "",$receiver = array(), $subject = "", $message = "")
	 {
	//send newsletter using mailchimp

		require_once(APPPATH.'vendor/mail_chimp/MCAPI.class.php');

	$api = new MCAPI(API);
	$retval = $api->listInterestGroupings(LISTID);

	if ($api->errorCode)
	{

		echo "Unable to list groupings!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	}
	else
	{


		$gid = $retval[0];
		$grid = $gid['id'];
	}


	$conditions = array();
	$conditions[] = array('field'=>'interests-'.$grid , 'op'=>'all','value'=>'testuniecommerce');
	$segment_opts = array('match'=>'all', 'conditions'=>$conditions);
	$retval = $api->campaignSegmentTest(LISTID, $segment_opts );


	if ($api->errorCode)
	{

		echo "Unable to Segment Campaign!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	}
	else
	{
		//echo "Your Segement matched [".$retval."] subscriber.\n";
	}

	//hash of the following
	$opts['list_id'] = LISTID;
	$opts['subject'] = $subject;
	$opts['from_email'] = $from;
	$opts['from_name'] = FROM;
	foreach($receiver as $re) {
	$opts['to_name'] = $receiver;

	}
	//end of hash array




	$content1=stripslashes($message) ;
	$content = array('html'=> $content1, 'text' => $content1);

	$cid = $api->campaignCreate('plaintext',$opts,$content,$segment_opts);

	if ($api->errorCode)
	{



		$err = "Unable to Create New Campaign!".$api->errorCode.$api->errorMessage;
		//set_response_mes(-1,$err);
		common::message(-1, $err);
		 url::redirect(PATH);

	}
	else
	{

		$output =  "New Campaign ID:" . $cid . "\n";
	}
	$return = $api->campaignSendNow($cid);

	if ($api->errorCode)
	{

		$err = "Unable to Send Campaign!".$api->errorCode.$api->errorMessage;
		set_response_mes(-1,$err);
		url::redirect(PATH);
	}
	else
	{

		common::message(1, "success");
		url::redirect(PATH);
	}

}

/*
 *Send mail using SendInBlue API
 * @Live
*/

public function smtpx($from = "",$receiver = array(), $subject = "", $message = "",$file = ""){
	echo APPPATH."mailin-api-php-master/V2.0/Mailin.php";
	
	//require_once(APPPATH."vendor/mailin/Mailin.php");
	require_once(APPPATH."vendor/mailin-api-php-master/V2.0/Mailin.php");
	$mailin = new Mailin("https://api.sendinblue.com/v2.0", "QxKf6XDyrJZAT9da");
	$html = "";
	$subject = "Test Mail";
	$to = array("pwndz172@gmail.com" => "Swifta Developer");
	$from = array("pkigozi@swifta.com");
	$cc = array(); 
	$bcc = array();
	$replyto = array("pkigozi@swifta.com","reply to!"); 
	$attachment = array();
	$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");
    var_dump($mailin->send_email($to,$subject,$from,$html,$message,$cc,$bcc,$replyto,$attachment,$headers));
	
/*$mailin = new Mailin('pwndz172@gmail.com', '15QtHTx0bDrWB6hP');
$mailin->
addTo('pwndz172@gmail.com', ' ')->
setFrom('pwndz172@gmail.com', ' ')->
setReplyTo('pwndz172@gmail.com',' ')->
setSubject('Enter the subject here')->
setText('Hello')->
setHtml('<strong>Hello</strong>');
$res = $mailin->send();
var_dump($res);*/
exit;

	
}


}
?>
