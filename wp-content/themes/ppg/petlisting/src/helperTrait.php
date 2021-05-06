<?php
namespace nyulawlms;

trait helperTrait{
    public $dbobj;
    function __construct(){
        global $wpdb;
        $this->dbobj=$wpdb;
        
    }
    public function helperTraitCurl($url){
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);  
        return $output;       
    }  
    public function helperTraitRemoveBOM($str){
        if ( 'efbbbf' === substr( bin2hex( $str ), 0, 6 ) ) {
			$str = substr( $str, 3 );
		}

        return $str; //https://stackoverflow.com/questions/689185/json-decode-returns-null-after-webservice-call
        //Code from \wp-content\plugins\woocommerce\includes\import\class-wc-product-csv-importer.php

    }  
}
?>