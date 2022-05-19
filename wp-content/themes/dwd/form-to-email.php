
<?php

  $name = $_POST['name'];

  $visitor_email = $_POST['email'];

  $message = $_POST['body'];

  $email_from = 'hi@dwdwork.com';

	$email_subject = "New Form submission";

	$email_body = "You have received a new message from the user $name.\n".
                            "Here is the message:\n $message".

  $to = "hi@dwdwork.com";

  $headers = "From: $email_from \r\n";

  $headers .= "Reply-To: $visitor_email \r\n";

  if(mail($to,$email_subject,$email_body,$headers)){
    echo 'Your mail has been sent successfully';
  } else {
      echo 'Something went wrong. We were unable to send your message';
    }

?>

<!-- <div id="success_message">

<h3>Thanks for reaching out! I will be in touch soon.</h3>

</div> -->

