<?php
/*This is the logout page. The cookie is destroyed.*/
//The cookie is destroyed only if it exists
if(isset($_COOKIE['Violet'])){
    setcookie('Violet', FALSE, time()-300);
}
//Include the header:

include('Violeta_Solorio_project5_header.html');
//Prints logged out message
echo'<p>You are now logged out.</p>';

?>
</div><!-- container-->
    <div id = "footer">Content; 2022</div>
</body>
</html>