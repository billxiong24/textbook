<?php                   
session_start();                   
session_destroy(); // ends sessions and logs a user out

header("Location: https://shib.oit.duke.edu/cgi-bin/logout.pl");
                    
?> 