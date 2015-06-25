<?php 
/**
 * 图像识别
 * @author jason<jason.jiang@appflint.com>
 */

//引入图片处理类
include 'PicDistinguish.class.php';

$secretid = 'XXXXXXX';//你的secretid
$taskUrl = 'http://api.open.tuputech.com/v2/pipe/55545eb4559246743e9f35e7';//这里采用 是否色情+是否广告+人物类型接口
$picDistinguish = new PicDistinguish($secretid,$taskUrl);//实例化图片识别类

//$img 测试图片地址
$img = 'http://h.hiphotos.baidu.com/baike/g%3D0%3Bw%3D268/sign=c29f7dece7dde711f7d246fdd0d2fc2d/dbb44aed2e738bd4a4e17fd8a38b87d6267ff913.jpg';
$data = $picDistinguish->getDate($img);

//数据处理
$obj = json_decode($data);
$json_obj = $obj->{"json"};
$json_arr = json_decode($json_obj);
$a1 = $json_arr->{"54bcfc6c329af61034f7c2fc"};//是否色情 分类： 0：色情； 1：性感； 2：正常；
$b1 = $json_arr->{"54d1c23172f3d7264ba1c025"};//是否广告 分类： 0：广告； 1：正常；
$c1 = $json_arr->{"554202c4b01bd8ee3b6c005c"};//人物类别 分类： 0：男人； 1：女人； 2：其他； 3：多人；

$a2 = $a1->{"statistic"};
$b2 = $b1->{"statistic"};
$c2 = $c1->{"statistic"};

if($a2[0] == 1 || $b2[0] == 1){
    echo "色情 或 广告";
}else if($a2[1] == 1){
    echo "性感";
}else if($c2[0] == 1){
    echo "男人";
}else if($c2[1] == 1){
    echo "女人";
}else if($c2[2] == 1){
    echo "其他";
}else if($c2[3] == 1){
    echo "多人";
}else{
    echo "不详，需要人工审核";
}
?>