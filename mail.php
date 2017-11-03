
<?php
# Mailing in PHP

  $from = "laraconnelly@hotmail.com";

  #$to = "laraconnelly@hotmail.com, ilapayton@gmail.com";
  #$to = "Lara Connelly <laraconnelly@hotmail.com>";
  $to = "ilapayton@gmail.com";
  #$to = "ryanNaccarato@yahoo.com";

  $subject = "Mail Test at: " . strftime("%T", time() );

  $message = "String of junk to test time again and again!";
  $message= wordwrap($message, 70);

  $headers = "From: " . $from;

  $result = mail($to, $subject, $message, $headers);

  echo $result ? 'Sent2' : 'Error';
?>