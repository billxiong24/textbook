<?php                   
session_start();                   
session_destroy(); // ends sessions and logs a user out
header("Location: ../index.php");
                    
?> 