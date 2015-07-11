<?

if(!defined("CUR_FILENAME")){
        die("You can't access file directly ... ");
}


//--------------------------- Video Browse ---------------------------------------
  if($action=="videos"){
  if($cat){
    $qr = db_query("select * from videos_data where cat='$cat' order by id DESC");
    $data_title = db_qr_fetch("select name from videos_cats where id='$cat'");

        open_table($data_title['name']);
    if(db_num($qr)){
    print "<center><table width=100%>" ;
    $c=0;
        while($data = db_fetch($qr)){



if ($c==$settings['news_cells']) {
print "  </tr><TR>" ;
$c = 0 ;
}
    ++$c ;


print " <td><center><a href='index.php?action=video_preview&id=$data[id]'>
            <img border=0 alt='$phrases[the_name] : $data[name] \n$phrases[add_date] : ".substr($data['date'],0,10)."'
            src='".get_image($data['img'])."'>
            <br>$data[name] </a><br>
<a href='index.php?action=video_preview&id=$data[id]'><img src='images/watch.gif' border=0 alt='$phrases[watch]'></a>
<a href='download.php?action=video&id=$data[id]'><img src='images/download.gif' border=0 alt='$phrases[download]'></a>
";


 print "</center>    </td>";



           }
           print "</tr></table></center>";
            }else{

                    print "<center> ·«  ÊÃœ ›ÌœÌÊÂ«   Õ  Â–« «·ﬁ”„ </center>";
                    }
          close_table();

          }else{
                  open_table();
                  $qr = db_query("select * from videos_cats order by binary name asc");
                  if(db_num($qr)){
                  	$c= 0;
                  	print "<table width=100%><tr>";
                  	while($data = db_fetch($qr)){
                  	if ($c==$settings['news_cells']) {
print "  </tr><TR>" ;
$c = 0 ;
}
    ++$c ;

    print "<td align=center><a href='index.php?action=videos&cat=$data[id]'><img src='images/folder.gif' border=0><br>$data[name]</a></td>";

                  		}
                  		print "</tr></table>";
                  		}else{
                  print "<center>  ·«  ÊÃœ «ﬁ”«„ </center>";
                  }
                  close_table();
                  }
  }
  
  
if($action=="video_preview"){
    $id=(int) $id;

     $qr = db_query("select * from videos_data where id='$id'");
   if(db_num($qr)){
       $data=db_fetch($qr);
    $players_include = "plugins/videos/" ;   
 
     open_table($data['name']);      
  if(strpos($data['url'],"video.google.com")){

$url = "http://video.google.com/googleplayer.swf?docid=".substr($data['url'],strpos($data['url'],"docid=")+6,strlen($data['url']))."&fs=true";

$cn = file_get_contents($players_include."preview_google.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;
 }elseif(strpos($data['url'],".flv") || strpos($data['url'],"youtube.com")){

   if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview_flv.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

 }elseif(strpos($data['url'],".wmv")){

   if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview_mediaplayer.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

}else{
  if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

 }      
      close_table();    
   }else{
       open_table();
   print "<center> Wrong URL </center>";
    close_table();  
   }  
     
   
}


  ?>