<?php

//phpinfo();
//var_dump(mail("fazlina@moh.gov.my","Subject","Email message","From: ude@moh.gov.my"));
if (mail("fazlina@moh.gov.my","Subject","Email message","From: ude@moh.gov.my"))
	echo "Email sent";
else
    echo "Email sending failed!";
?>