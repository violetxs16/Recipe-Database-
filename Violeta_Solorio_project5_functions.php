<?php
function is_admistrator($name = 'Violet', $value = 'Solorio'){//Checks if user is an administrator, returns boolean true or false
    if(isset($_COOKIE['$name']) && ($_COOKIE[$name]==$value)){//If a match is found returns true
        return true;
    }else{//Returns false if not adminstrator
        return false;
    }
    
}

