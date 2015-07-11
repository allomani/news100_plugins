<?
//---------------//
$siteurl = "http://$_SERVER[HTTP_HOST]" ;
$scripturl = $siteurl . iif(trim($script_path),"/".$script_path,"");
//-----------------//
if(!$action){
    $data=db_qr_fetch("select count(id) as count from comments_data where active=0 order by id desc" );   
    print "<br><table with=50% class=grid><tr><td><b>  ⁄·Ìﬁ«   ‰ Ÿ— «·„Ê«›ﬁ… : </b> $data[count] </td></tr></table>";
}
if ($action == "comments" || $action == "comment_activate" || $action == "comment_edit_ok"){
    if_admin( "comments" );

  
  if ($action == "comment_edit_ok"){
   db_query("update comments_data set content='$content' where id='$id'");
  
   if ($news_id){
     print "<SCRIPT>window.location=\"$scripturl/index.php?action=news&id=$news_id\";</script>";      
    }else{
        print "<SCRIPT>window.location=\"index.php?action=comments\";</script>"; 
    }  
  }
    if ($action == "comment_activate"){
        $id = intval( $id );
        db_query( "update comments_data set active=1 where id='".$id."'" );
    }
    
    
$qr = db_query( "select * from comments_data where active=0 order by id desc" );
print "<p align=center class=title>  ⁄·Ìﬁ«   ‰ Ÿ— «·„Ê«›ﬁ… </p>";
if (db_num($qr)){
    print "<center><table width=100% class=grid>";
    while($data = db_fetch($qr)){
        $data_news = db_qr_fetch("select title from news_news where id='$data[news_id]'");
        print "<tr><td><a href='$scripturl/index.php?action=news&id=$data[news_id]' target=_blank>$data_news[title]</a></td>
        <td>$data[name]</td><td>$data[email]</td><td>$data[content]</td><td>$data[date]</td><td><a href='index.php?action=comment_activate&id=$data[id]'>  ›⁄Ì· </a> - <a href='index.php?action=comment_edit&id=$data[id]'> ⁄œÌ·</a> - <a href='index.php?action=comment_del&id=$data[id]' onClick=\"return confirm('Are You Sure ?');\">Õ–›</a></td></tr>";
        
    }
    print "</table></center>";
}else{
    print "<center> ·«  ÊÃœ  ⁄·ﬁÌ«  </center>";
}
}


//--------- comments del ----
 
if ($action == "comment_del"){
    if_admin( "comments" );
    $id = intval( $id );
    $news_id = intval( $news_id );
    db_query( "delete from comments_data where id='".$id."'" );
    if ($news_id){
     print "<SCRIPT>window.location=\"$scripturl/index.php?action=news&id=$news_id\";</script>";      
    }else{
        print "<SCRIPT>window.location=\"index.php?action=comments\";</script>"; 
    }
}

//--------- edit --------------
if ($action == "comment_edit"){
    if_admin( "comments" );
    $id = intval( $id );
    $news_id = intval( $news_id );
    $qr = db_query( "select * from comments_data where id='".$id."'" );
   if(db_num($qr)){
       $data=db_fetch($qr);
       print "<form action='index.php' method=post>
       <input type=hidden name='action' value='comment_edit_ok'> 
       <input type=hidden name='id' value='$id'>
       <input type=hidden name='news_id' value='$news_id'> 
         <center>
       <table width=50% class=grid>
       <tr><td align=center><textarea name='content' cols=30 rows=5>$data[content]</textarea></td></tr>
       <tr><td align=center><input type=submit value='  ⁄œÌ· '></td></tr>
       </table>
       </form>";
   }else{
    print_admin_table("<center> $phrases[err_wrong_url]</center>");   
   }
}

?>
