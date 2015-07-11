<?
//---------------------------------- Videos Cats -----------------------------
if($action=="videos_cats" ||  $action=="videos_cat_del" || $action=="edit_videos_cat_ok" || $action=="videos_cat_add_ok"){

if_admin("videos");

  print "<center><p class=title>«·√ﬁ”«„ </p>
   <form method=\"POST\" action=\"index.php\">

   <table width=45% class=grid><tr>
   <td> «·≈”„ :
    <input type=hidden name='action' value='videos_cat_add_ok'>
   <input type=text name=name size=30>
    </td>
    <td><input type=submit value='«÷«›…'></td>
    </tr></table>



   </center><br>";
//---------------------------------------------------------
if($action =="videos_cat_add_ok"){
  db_query("insert into videos_cats (name) values('$name')");
        }
//----------------------------------------------------------
 if($action=="videos_cat_del"){
 if($id){
      db_query("delete from videos_cats where id=$id");
       db_query("delete from videos_data where cat=$id");
         }
 }
//-----------------------------------------------------------
 if($action=="edit_videos_cat_ok"){

 db_query("update videos_cats set name='$name' where id=$id");
         }
//-----------------------------------------------------------

 $qr = db_query("select * from  videos_cats");
 print "<center><table width=80% class=grid>";
 while($data = db_fetch($qr)){
      print "<tr><td>$data[name]</td>
      <td><a href='index.php?action=videos_cat_edit&id=$data[id]'> ⁄œÌ· </a></td>
      <td><a href=\"index.php?action=videos_cat_del&id=$data[id]\" onClick=\"return confirm('Õ–› Â–« «·ﬁ”„ ”Ê› ÌƒœÌ «·Ï Õ–› Ã„Ì⁄ «·ﬂ·Ì»«  «· Ì ÌÕ ÊÌÂ« , Â·  —Ìœ «·„ «»⁄… ?');\">Õ–› </a></td>
      ";
         }
       print "</table>";
        }

 //-------------------------------------------------------------
        if($action == "videos_cat_edit"){
            if_admin("videos");
               $data = mysql_fetch_array(mysql_query("select * from videos_cats where id=$id"));

               print "<center>

                <table border=0 width=\"40%\"  style=\"border-collapse: collapse\" class=grid><tr>

                <form method=\"POST\" action=\"index.php\">

                      <input type=hidden name=\"id\" value='$id'>

                      <input type=hidden name=\"action\" value='edit_videos_cat_ok'> ";


                  print "  <tr>
                                <td width=\"50\">
                <b>&#1575;&#1604;&#1575;&#1587;&#1605;</b></td><td width=\"223\">
                <input type=\"text\" name=\"name\" value=\"$data[name]\" size=\"29\"></td>
                        </tr>

                        ";

                              print " <tr>
                                <td colspan=2>
                <center><input type=\"submit\" value=\" ⁄œÌ·\">
                        </td>
                        </tr>





                </table>

</form>    </center>\n";

                      }
//---------------------------------- Videos -----------------------------------
if($action=="videos" || $action=="video_add_ok" || $action=="video_edit_ok" || $action=="video_del" ){

if_admin("videos");

//-----------------------------------------------------------
if($action=="video_add_ok"){
db_query("insert into videos_data (name,url,img,cat,date) values('$name','$url','$img','$cat',now())");
}
//----------------------------------------------------------
if($action=="video_del"){
db_query("delete from videos_data where id=$id");
 }
//-----------------------------------------------------
if($action=="video_edit_ok"){
db_query("update videos_data set name='$name',img='$img',url='$url' where id=$id");
        }
//------------------------------------------------------
if(!$cat){



       $qr = db_query("select * from videos_cats");


if(db_num($qr)){
        print "<center><table width=70% class=grid>" ;

       $c=0 ;

        while($data = db_fetch($qr)){

               ++$c ;

if ($c=='5') {
print "  </tr><TR>" ;
$c = 1 ;
}

   print "<td align=center><a href='index.php?action=videos&cat=$data[id]'>$data[name]</a></td>";
                }
                print "</tr></table>" ;
    }else{
            print "<center> ·«  ÊÃœ √ﬁ”«„ </center>";
            }

        }else{





       $data_title = db_qr_fetch("select * from videos_cats where id=$cat");

       print "<center><span class=title>$data_title[name]</span><br><br>" ;
       print "<form name=sender action=index.php method=post>
       <input type=hidden name=action value='video_add_ok'>
       <input type=hidden name=cat value='$cat'>
       <table class=grid width=40% >
       <tr><td colspan=2><center><span class=title>«÷«›… ﬂ·Ì» </span></td></tr>
       <tr><td> «·«”„ : </td><td><input type=text name=name size=30></td></tr>
       <tr><td> —«»ÿ «· Õ„Ì· : </td><td>

       <table><tr><td><input type=text  dir=ltr size=30 name=url></td><td><a href=\"javascript:uploader('videos','url');\"><img src='images/file_up.gif' border=0 alt='—›⁄ „·› „‰ «·ÃÂ«“'></a></td></tr></table>
       </td></tr>
       <tr><td>
  «·’Ê—… :</td>
  <td> <table><tr><td><input type=text  dir=ltr size=30 name=img></td><td><a href=\"javascript:uploader('videos','img');\"><img src='images/file_up.gif' border=0 alt='—›⁄ ’Ê—… „‰ «·ÃÂ«“'></a></td></tr></table>

   </td></tr>
       <tr><td colspan=2 align=center><input type=submit value='«÷«›…'></td></tr>
       </table></form><br>";





      $qr=db_query("select * from videos_data where cat=$cat");
       print "<table class=grid width=70%>" ;
      if(db_num($qr)){
           while($data = db_fetch($qr)){
                print "<tr><td>$data[name]</td>
                <td><a href='index.php?action=video_edit&id=$data[id]&cat=$cat'> ⁄œÌ· </a></td>
                <td>
                <a href='index.php?action=video_del&id=$data[id]&cat=$cat' onClick=\"return confirm('Â· √‰  „ √ﬂœ ?');\"> Õ–› </a></td></tr>";

                   }


              }else{
                      print "<tr><td align=center> ·« ÊÃœ ﬂ·Ì»«  </td></tr>";
                      }


       print "</table>";

                }

        }
//-----------------------------------------------------------------------------
if($action == "video_edit"){
$id = intval($id);

     $data=db_qr_fetch("select * from videos_data where id=$id");

         print "<center>" ;
       print "<form name=sender action=index.php method=post>
       <input type=hidden name=action value='video_edit_ok'>
       <input type=hidden name=cat value='$cat'>
       <input type=hidden name=id value='$id'>
       <table class=grid width=40% >

       <tr><td> «·«”„ : </td><td><input type=text name=name size=30 value=\"$data[name]\"></td></tr>
       <tr><td> —«»ÿ «· Õ„Ì· : </td><td><input type=text name=url size=30 value='$data[url]'></td></tr>
       <tr><td>
  «·’Ê—… :</td>
  <td> <table><tr><td><input type=text  dir=ltr size=30 name=img value=\"$data[img]\"></td><td><a href=\"javascript:uploader('videos','img');\"><img src='images/file_up.gif' border=0 alt='—›⁄ ’Ê—… „‰ «·ÃÂ«“'></a></td></tr></table>

   </td></tr>
       <tr><td colspan=2 align=center><input type=submit value=' ⁄œÌ·'></td></tr>
       </table></form><br>";
        }?>
