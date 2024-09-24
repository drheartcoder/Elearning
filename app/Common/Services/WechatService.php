<?php 

namespace App\Common\Services;
use App\Common\Services\StudentService;

class WechatService
{
	public function __construct(StudentService $studentService)
	{
		$this->AppId          = 'wx1f51fad5a833d332';
		$this->AppSecret      = 'a45eb571f559d3c5331bd3b6b8df758d';
		$this->StudentService = $studentService;
	}

//http get
        public function httpRequest($url){

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);

            if($output == false){
                return 'curl error:'.curl_error($ch);
            }

            curl_close($ch);

            return $output;
        }

        //curl获取参数
        //https 中的 get  和  post
        public function https_request($url,$data=null){
            
            $curl = curl_init();
        
            curl_setopt($curl,CURLOPT_URL,$url);

            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);

            //不为空，使用post传参数，否则使用get
            if($data){

                curl_setopt($curl,CURLOPT_POST,1);
                curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

            }

            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            
            $output = curl_exec($curl);
            curl_close($curl);

            return $output;
        }

        //获取接口票据access_token
        public function get_token(){

            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->AppId."&secret=".$this->AppSecret;

            $json = $this->https_request($url);

            $arr = json_decode($json,true);
            
            return $arr['access_token'];
        }



        /*获取授权后重定向的回调链接地址，请使用urlencode对链接进行处理
         * @param string $redirect_uri
         * @param string $state
         **/
        public function get_authorize_url($redirect_uri = '', $state = ''){

            $redirect_uri = urlencode($redirect_uri);
            return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->AppId."&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
        }


        /**
         *加载网页授权通过code获取access_token
         *
         * @param string $code
         **/
        public function get_code_access_token($code){

            //第一步：用户同意授权，获取code
            // 第二步：通过code换取网页授权access_token,与接口票据不一样
            $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->AppId."&secret=".$this->AppSecret."&code={$code}&grant_type=authorization_code";

            $access_token = $this->https_request($access_token_url);

            $arr = json_decode($access_token,true);

            return $arr;
        }


        /**
         * 刷新access_token（如果需要）
         *
         **/
        public function refresh_access_token($refresh_token){

            //三步：刷新access_token（如果需要）
            $refresh_url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->AppId."&grant_type=refresh_token&refresh_token={$refresh_token}";

            $access_token = $this->https_request($refresh_url);

            return json_decode($access_token,true);

        }


       /**
        * 获取授权后的微信用户信息
        *
        * @param string $access_token
        * @param string $open_id
           **/
           public function get_user_info($access_token = '', $open_id = ''){

               // 第四步：拉取用户信息(需scope为 snsapi_userinfo)

            if($access_token && $open_id){

                $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
                
                $info_data = $this->https_request($info_url);

                return json_decode($info_data, TRUE);

            }
            
            return FALSE;
        }

        /**
         *检验授权凭证（access_token）是否有效
         * @param string $access_token
         * @param string $open_id
         **/
        public function checkAvail($access_token='',$openid=''){
             if($access_token!='' && $openid!=''){

                 $avail_url = "https://api.weixin.qq.com/sns/auth?access_token={$access_token}&openid={$openid}";

                 $avail_data = $this->https_request($avail_url);
                return json_decode($avail_data, TRUE);
             }

              return FALSE;
        }



        //获取自定义菜单创建接口
        public function setcustomMenu(){

            $access_token = $this->get_token();

            $menuurl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";

            $jsonmenu = '{
                 "button":[
                 {    
                      "type":"view",
                      "name":"抽奖",
                      "url":"http://akira.weixin-sandbox.ciicgat.com/index.php?c=Phone&a=Index&page=Page"
                  },
                  {
                         "type":"click",
                       "name":"赞一下",
                       "key":"点赞"
                  },
                  {
                       "name":"上网",
                       "sub_button":[
                       {    
                           "type":"view",
                           "name":"搜搜",
                           "url":"http://www.soso.com/"
                        },
                        {
                           "type":"view",
                           "name":"腾讯",
                           "url":"http://v.qq.com/"
                        },
                        {
                           "type":"view",
                           "name":"百度",
                           "url":"http://www.baidu.com/"
                        }]
                   }]
             }';

            //在直接访问接口的时候已经改变了微站上面的信息
            $result = $this->https_request($menuurl,$jsonmenu);

            var_dump($result);
        }


        /**
         *openid
         *用户说的内容
         *获取和你聊天的用户的基本信息形成列表
         **/
        public  function  getUserInfo($openid,$text){

            $access_token = $this->get_token();
            //http请求方式:GET
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
            //请求获取用户信息的接口，返回这个openid对应的用户信息，json格式
            $jsoninfo = $this->httpRequest($url);
            //将json转为php数组
            $user = json_decode($jsoninfo,true);

            $this->insertuser($user);

            $this->insertmessage($openid,$text,0,'text');
        }

        /*
         *将用户的数据写入数据库
         */
        public function insertuser($arr){

            $user = new Model('user');

            $user->ctime = $arr['subscribe_time'];

            $user->add($arr);
        }

        /**
         *第一个参数: $openid 用户的编号
         *第二个参数: $text 用户消息和公众号数据标记  1 表示公众号 0 表示用户消息
         **/
        public function insertmessage($openid,$text,$who,$mtype="text"){

            $message = new Model('message');

            $message->openid = $openid;
            $message->mess = $text;
            $message->who = $who;
            $message->utime = time();
            $message->mtype = $mtype;

            $message->add();

            $sql = "upadte user set utime=".time()." where openid = '{$openid}'";

            $user = new Model('user');
            $user->query($sql);
        }


        //获取带参数的二维码的过程包括两步，首先创建二维码ticket，然后凭借ticket到指定URL换取二维码
        
         /**
          *微信获取二维码ticket
          *@param string $type
          *@param string $time
          **/
        public function getTicket($type="temporary",$time="604800"){

            /*
            http请求方式: POST
            URL: https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN
            POST数据格式：json

            临时二维码请求说明
            POST数据例子：{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        
            永久二维码请求说明
            POST数据例子：{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
            或者也可以使用以下POST数据创建字符串形式的二维码参数：
            {"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123"}}}
            */

            if((int)($time) > 604800){
                $time = 604800;
            }

            //获取token
            $token = $this->get_token();

            //临时
            $temporary_qrcode = '{"expire_seconds": '.$time.', "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}';

            //永久
            $permanent_qrcode = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}';

            //永久字符串
            $permanent_str_qrcode = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": 123}}}';

            //获取类型判定
            $code = $type.'_qrcode';
            $qrcode = $$code;

            //请求ticket
            $ticket_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}";

            $ticket = $this->https_request($ticket_url,$qrcode);

            return $ticket;
        }

        /**
         *凭借ticket到指定URL换取二维码  
         **/
        public function getQrcode(){
        
            //本接口无须登录态即可调用    TICKET进行UrlEncode
            // HTTP GET请求（请使用https协议）
            // https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=TICKET
            $ticket = json_decode($this->getTicket(),true);

            $qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket['ticket']);

            echo  $qrcode_url;

            $qrcode = $this->https_request($qrcode_url);

            // header("");
        }


        /*
         * 微信不接收\u***格式的json内容需要对json字符串处理
         * 仅支持发送text消息，其他类型消息自己添加代码
         * @param string msgtype
         * @param array
         * @return string
         */
        function my_json_encode($type, $p){

            if (PHP_VERSION >= '5.4'){

                $str = json_encode($p, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }
            else{

                switch ($type){

                    case 'text':
                        isset($p['text']['content']) && ($p['text']['content'] = urlencode($p['text']['content']));
                        break;
                }
                $str = urldecode(json_encode($p));
            }
            return $str;
        }

        
        //中文分词函数,只要传一句话，就可以分词出来
        public function fci($text){
            $text = iconv('UTF-8','GBK//IGNORE',$text);
            $text = urlencode($text);
            $result = file_get_contents("http://akira.weixin-sandbox.ciicgat.com/index.php?w=".$text);
            $result = iconv("GBK","UTF-8//IGNORE",$result);
            return explode(" ",$result);
        }
}

?>