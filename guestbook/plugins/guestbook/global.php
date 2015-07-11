<?
$actions_checks["ÓÌá ÇáÒæÇÑ"] = 'guestbook' ;
$permissions_checks["ÓÌá ÇáÒæÇÑ"]  = "guestbook" ;

if(!class_exists('sec_img_verification')){
require(CWD . '/class_security_img.php');
$sec_img = new sec_img_verification();
}

if(!function_exists('iif')){
   function iif($expression, $returntrue, $returnfalse = '')
{
    return ($expression ? $returntrue : $returnfalse);
}
}


//--------- print admin table -------------
function print_admin_table($content,$width="50%",$align="center"){
    print "<center><table class=grid width='$width'><tr><td align='$align'>$content</td></tr></table></center>";
    }
?>
