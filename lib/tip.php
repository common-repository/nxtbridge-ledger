<?php 

  //$acc = substr($acc,0,strpos($acc,' '));

/*****************************************************************************************************/

function nxtbridge_tip( $content ) { 
  global $api;
  $pattern = '/\[NXTBridgeTip .*\]/';
  preg_match_all($pattern, $content, $result); //find all Asset patterns
  $result = array_unique($result[0]); // remove duplicates

  for ( $i=0; $i<count($result); $i++ ) {
    $account = explode("=", str_replace(']', '', $result[$i]), 3);
    $acc = $account[1]; // explode nxt address
    $acc = substr($acc,0,strpos($acc,' '));    
    $acc2 = $account[2]; // amount for pay

    
    $length = 10;
    $uid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    $wpadmin = admin_url();

    
    $a[$i] = "";
    if ( strlen($acc) > 0 and strlen($acc2) > 0) { 
      // generate button
      $a[$i] .= sprintf("<div class='nb container'><div class='nb row'><div class='nb col-xs-8 col-sm-8 col-lg-6'><div class='nb input-group'>");
      $a[$i] .= sprintf("<span class='nb input-group-addon' id='Tip-help-%s'>NXT</span>", $uid);
      $a[$i] .= sprintf("<input type='text' class='nb form-control' aria-describedby='Tip-help-%s' id='Tip-%s' value='%s' /> ", $uid, $uid, $acc2);
      $a[$i] .= sprintf("<span class='nb input-group-btn'><button class='nb btn btn-default NXTBridge-tip-button' type='button' data-addr='%s' data-amount='%s' data-id='%s' data-wpadmin='%s' href='#'>Tip Me</button></span>", $acc, $acc2, $uid, $wpadmin);
      $a[$i] .= sprintf("</div></div></div></div>");

      $a[$i] .= sprintf("");
      $a[$i] .= sprintf("");


    } else {
      // wrong Nxt address
      $a[$i] = "";
    }
  }

  $content = str_replace($result, $a, $content);
  return $content;

}

?>
