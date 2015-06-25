<?php 
/**
 * 图像识别类
 * @author jason<jason.jiang@appflint.com>
 */

class PicDistinguish{
    
    private $secretid;          //你的secretid
    private $taskUrl;           //任务链接
    
    public function __construct($secretid,$taskUrl)
    {
        $this->secretid = $secretid;
        $this->taskUrl = $taskUrl;
    }
    
    //获取 signature
    public function getDate($img){
        $secretid = $this->secretid;//你的secretid
        $timestamp = time(); //时间戳
        $nonce = rand(100,999); //随机数
        
        $sign_string = $secretid.",".$timestamp.",".$nonce;
        
        $taskUrl = $this->taskUrl;
        
        //读取私钥，并签名
        $fp = fopen("rsa_private_key.pem", "r");//注：填写你环境上的私钥地址
        $private_key_pem = fread($fp, 8192);
        fclose($fp);
        
        $pkeyid = openssl_get_privatekey($private_key_pem);
        openssl_sign($sign_string,$signature,$pkeyid,OPENSSL_ALGO_SHA256);
        $signature = base64_encode($signature);
        
        $data = array();
        $data['secretId'] = $secretid;
        $data['image'] = $img;
        $data['timestamp'] = $timestamp;
        $data['nonce'] = $nonce;
        $data['signature'] = $signature;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $taskUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        
        curl_close($ch);
        
        return $output;
    }
}
?>