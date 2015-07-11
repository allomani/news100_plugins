<?
include "global.php";

$id=intval($id);

       $qr=db_query("select id,url from videos_data where id='$id' and url !=''");



          if (db_num($qr)){
          $data=db_fetch($qr);

if($action=="video"){
        if($typ=="lsn"){
     mysql_query("update videos_data set views=views+1 where id='$id'");
       header("Content-type: audio/x-pn-realaudio");
 //header("Content-length: $size");
  header("Content-Disposition:  filename=watch.ram");
  header("Content-Description: PHP Generated Data");

   if (strchr($data['url'],"http://")) {
           print "$data[url]";
           }else{
  echo "http://$_SERVER[SERVER_NAME]/$script_path/$data[url]";
        }
          }else{
         mysql_query("update videos_data set downloads=downloads+1 where id='$id'");
         if (strchr($data['url'],"http://")) {
           header("Location: $data[url]");
            }else{
             header("Location: http://$_SERVER[SERVER_NAME]/$script_path/$data[url]");
                    }

                    }

                  }



        }else{

                print "<center> $phrases[err_wrong_url] </center>";
                }


                ?>