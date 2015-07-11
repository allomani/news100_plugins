<?
include "global.php" ;
print "<META http-equiv=Content-Type content=\"text/html; charset=windows-1256\"> \n";
print "<LINK href=\"style.css\" type=text/css rel=StyleSheet>   \n";
$qr = db_query("select title,id from news_news order by id DESC limit 20");

 print "
    <marquee onmouseover=\"this.stop()\"
    onmouseout=\"this.start()\" scrollAmount=\"5\" scrollDelay=\"0\" direction=right   width=\"100%\">"    ;

    while($data = mysql_fetch_array($qr))
    {

            print " &nbsp&nbsp&nbsp <a href='index.php?action=news&id=$data[id]' target='_blank'>$data[title]</a> &nbsp&nbsp&nbsp ** ";
            }

            print "</marquee>";

            ?>