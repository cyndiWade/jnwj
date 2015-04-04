<?php 
header('Content-Type:application/json;charset=utf-8');

/**
 * 文档地址https://github.com/dodgepudding/wechat-php-sdk
 */
include "App/weixin-sdk/wechat-php-sdk-master/wechat.class.php";

include "App/Common/common.php";

$api_data_url = "http://jnwj.techshow.club";

// $subject_server_json = file_get_contents($api_data_url.'/Api/Weixin/getSubject/subject_id/1',false);
// $subject_server_arr = json_decode($subject_server_json);
// PRINT_r($subject_server_json);
// EXIT;



// $options = array(
//     'token'=>'jianniweijian7889', //填写你设定的key
//     'appid'=>'wxf9f6944fb535cbb2', //填写高级调用功能的app id
//     'appsecret'=>'4eaed2550d5c58add216469d3df0b6aa', //填写高级调用功能的密钥
//     'encodingaeskey'=>'Swj8JGbBgErT4gP9vQzuVcPi2CvdE8qnLNAXgujvbcX', //填写加密用的EncodingAESKey
// );

$options = array(
    'token'=>'jianniweijian7889', //填写你设定的key
    'appid'=>'wx301d13a26307b276', //填写高级调用功能的app id
    'appsecret'=>'2495d54b68e8debe96315aa965108648', //填写高级调用功能的密钥
    'encodingaeskey'=>'AVm1MFhnifWlgzGOw7kT5BwUOolqZHGtZkitvw5KBUS', //填写加密用的EncodingAESKey
);

$weObj = new Wechat($options);
$weObj->valid();

//流程控制
$type = $weObj->getRev()->getRevType();

//$str = json_encode($data);

switch($type) {

    case Wechat::MSGTYPE_TEXT:

        $user_put_data = $weObj->getRevData();//用户输入数据
        $user_put_content = $user_put_data['Content'];//用户输入文字内容

        if (is_numeric($user_put_content)) {
            $subject_id = $user_put_content;

            $subject_info_json = file_get_contents($api_data_url.'/Api/Weixin/getSubject/subject_id/'.$subject_id,false);
            $subject_info_obj = json_decode($subject_info_json);
            
            if ($subject_info_obj->status == 0) {
                
                $subject_server_json = file_get_contents($api_data_url.'/Api/Weixin/getSubjectResultBySubjectId/subject_id/'.$subject_id,false);
                $subject_server_obj = json_decode($subject_server_json);
                
                $result .= $subject_info_obj->data->name."\n\r";
                
                foreach ($subject_server_obj->data as $key=>$val) {
                    $result .= $val->start.'~'.$val->over.'分：'.$val->content."\n\r";
                }

            } else {
                $result .= '对不起暂无该题目';
            }

            $weObj->text($result)->reply();
            
        } else {
            $new_ten_subject_obj = getUlrData($api_data_url.'/Api/Weixin/getNewTenSubject');
            
            if ($new_ten_subject_obj->status == 0) {
                $data = array();
                
//                 $data[] = array(
//                     'Title'=>"【见你未见】",
//                     'Description'=>"请输入测试题目标号获取答案O(∩_∩)O",
//                     'Url'=>$api_data_url.'/Home/Forecast/subject/subject_id/1'
//                 );
                $jljs_string = "教练技术测试题：\n\n";
                foreach ($new_ten_subject_obj->data as $key=>$val) {
                	$jljs_url = $api_data_url.'/Home/Forecast/subject/subject_id/'.$val->id;
                	$jljs_string .= '<a href="'.$jljs_url.'" >'.$val->title.'</a>';
                }
                
                $weObj->text($jljs_string)->reply();
            }
//             $data = array(
//                 0=>array(
//                     'Title'=>$Str_msg,
//                     'Description'=>$Str_msg,
//                     'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
//                     #'Url'=>'http://www.domain.com/1.html'
//                 ),
//                 1=>array(
//                     'Title'=>$Str_msg,
//                     'Description'=>$Str_msg,
//                     'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
//                     #'Url'=>'http://www.domain.com/1.html'
//                 ),
//             );
            	
            
            
        }

        
        
        break;
    case Wechat::MSGTYPE_EVENT:
        break;
    case Wechat::MSGTYPE_IMAGE:
        break;
    default:
        $weObj->text("help info")->reply();

}


function getUlrData ($url) {
    $server_json = file_get_contents($url,false);
    $server_obj = json_decode($server_json);
    return $server_obj;
}