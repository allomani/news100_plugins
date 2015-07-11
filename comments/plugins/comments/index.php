<?php

if($action=="news"){
$enable_sec_img = true;

    $name=htmlspecialchars($name);
       $email = htmlspecialchars($email);
       $content = htmlspecialchars($content);
       $id = intval($id);
       $comment_op = htmlspecialchars($comment_op);
                                         
         if($comment_op=="send_comment"){
      
    if($enable_sec_img){
     $valid_sec = $sec_img->verify_string($sec_string);  
    }else{
         $valid_sec = true;      
    }
   
   if($valid_sec){
  db_query( "insert into comments_data (name,email,content,news_id,active,date) values('".$name."','$email','$content','$id','".iif($auto_activate_comments,1,0)."',now())" );                                                                                                              
            open_table();
            if($auto_activate_comments){
            print "<center>‘ﬂ—« ·ﬂ , ·ﬁœ  „ «—”«·  ⁄·Ìﬁﬂ .</center>";
            }else{
                 print "<center>‘ﬂ—« ·ﬂ , ·ﬁœ  „ «—”«·  ⁄·Ìﬁﬂ , ”Ê›  ﬁÊ„ «·«œ«—… »„—«Ã⁄ Â Ê «·„Ê«›ﬁ… ⁄·Ï ›Ì «ﬁ—» Ê ﬁ  „„ﬂ‰ .</center>";
            }
            close_table();
  $name="";
       $email = "";
       $content = "";
            }else{
            open_table();
            print "<center> Œÿ√ ›Ì ﬂÊœ «· Õﬁﬁ </center>" ;
            close_table();
                }
            }
            
     //-------------- Comments --------------------
$qr = db_query("select * from comments_data where news_id ='".$id."' and active=1");
  if(db_num($qr)){
          open_table("«· ⁄·Ìﬁ« ");
          print "<hr size=1 class=separate_line>";
          
          if(check_login_cookies() && if_admin("comments")){
          $comments_admin = true;
          }else{
              $comments_admin = false;
          }
          
          
          while($data = db_fetch($qr)){
          
          print "<table width=100% border=0><tr><td width=50%><b><a href='mailto:$data[email]'>$data[name]</a></b><td align=left>$data[date]</td></tr>";
        
          print "<tr><td colspan=2>$data[content]";
          if($comments_admin){
          print " &nbsp;[<a href='".iif($admin_folder,$admin_folder,"admin")."/index.php?action=comment_edit&id=$data[id]&news_id=$id'> ⁄œÌ·</a> - <a href='".iif($admin_folder,$admin_folder,"admin")."/index.php?action=comment_del&id=$data[id]&news_id=$id'>Õ–›</a>]";
              }
          print "<br><hr size=1 class=separate_line></td></tr></table>";
                  }
          close_table();
          }

   //------------ send comment ---------------

   open_table("«—”«·  ⁄·Ìﬁ");
  
   print "<form action='index.php' method=post>
   <table width=100% border=0>
   <input type=hidden name=id value='$id'>
   <input type=hidden name=action value='news'>
    <input type=hidden name=comment_op value='send_comment'>
    <tr><td><b> «·«”„ </b> </td><td><input type=text name=name size=20 value=\"$name\"></td></tr>
    <tr><td><b> «·»—Ìœ «·«·ﬂ —Ê‰Ì </b> </td><td><input type=text name=email size=20 value=\"$email\"></td></tr>   
 <tr><td><b> «· ⁄·Ìﬁ</b></td><td><textarea cols=30 rows=5 name=content>$content</textarea></td></tr> ";

 if($enable_sec_img){
        print " <tr>
        <td><b>$phrases[security_code]</b></td>
        <td>".$sec_img->output_input_box('sec_string','size=7')."&nbsp;<img src=\"sec_image.php\" alt=\"Verification Image\" /></td></tr> ";
 }    
    
   print "<tr><td colspan=2 align=center><input type=submit value=' «—”«· '></td></tr>
</table></form>";

   close_table();       
}
?>
