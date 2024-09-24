<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => env('ALI_APP_ID', '2018061260399180'), //2018061260399180

        // 支付宝异步通知地址
        'notify_url' => '',

        // 支付成功后同步通知地址

        'return_url' => env('APP_URL').'/alipay/callback',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqMUjITuYeHctCt1sRoYHXI8eSYh / HmyZAtP1ShCWR5VRNffshQBAxbXBTcTDcIo454LckocnA9yPfttJQT3rh5JCVnpxLEJBZZOFraR7 / y2ZW / gpwM / 5St0 + UNx4QWwmxrzGIglAOsf5EX77ShLAEqQTucUdtNpO3 + 7NLc4aM9 / OMfUEf + Ju / UWhl8TixkkEWusIrr1BVClGf / UKIRNgbNMWXp2cRYFWJZJcKxD0f2BnpKjU52PKwlT9U7ZZ6gbWhmljitvFoBZl1omP / b1FLgtY1EKBjgrNq1BT5R95iaxFtzbxa6nbbsAU7PqprJq6leN8iUkwRrWIwAKsSCvoNwIDAQAB',//'file:///opt/lampp/htdocs/elearning/rsa_public_key.pem',

        // 自己的私钥，签名时使用
        'private_key' => 'MIIEogIBAAKCAQEAq5p4nj4ycV5bL3GBB5M9tp/8VPHPN1ep6b0bDd56bAd5F1HR
LW7LmD4gGi16lElOSrTXrMpW8qCksRFUCW2ZxJPUBaxLTG7KQm6IJHl0PwtifPvM
s+xmj9LhFYHdHgJGOd/z5k/Iuv45nBO/hMfT/nR/yslRI1ZxvQB5C5SaOmyKhCw2
l5EQlc4rOGzhX8QAJ4xJN4Tbt8r9wpRiFmLHzOklrO1Iv0A+r7EM1h4P1N7FwBmZ
c5QDxq3EEc4x3FSWGGqmkOR5T2O6/MXh+wS/UaiCP8SRVXd1a/Ze3GnnqXOmTXMs
8eFmf25zNsGTOmuWxfypgcJko2g0D86xMUS7twIDAQABAoIBAH8//u2pRZKX25pk
2r+ZSgwguubqoTRyx0bSujsgnTt6lyrZuvmrzUHJ39hJnTpU2b/ANqalLLCiuz2q
kdyj74C79l92kifNiCKXAFG71p3hfVkdB4Dsbml8gPiH4kYcfaLxFVXWGA3B80pv
wndeDzADh7gCbS59Lb5vmVMjEPL8zySHAQma6YobS9eU7HdT8/a7cm5vXbyKW5pi
sZfM2JBGm3O9YEKz/ek1D1EfalBVcpAvPN1RubdRELYIju66yn9WW0R7P3ejLShi
4Lr7JjO2ApeA8zY6FOlY2SdUi4psN3p7KAaW97njhAJdZzAuWSh2pM4S0SGw2CLI
kjd3sBECgYEA08veS1+udcM3AAyyYXwziKztD4iGRQDinQQ+3A/DRoGQnvQtAcEU
Zav8pbY45eYgX4tF0jM4YbneuLadYdr4MQRLbReBsHnrVJIhBmV4gT+m8RfInJI1
2vbTudBg6TsGDcqSiKUyfGPD0ij86E3MWPQH7iak7Du79BD27C4fy+0CgYEAz2sf
BHfuIpDoiK2zKqqpDLA9YymAV4ttdeJXsaaBlSMa2ndCMzT5pKsQrgQ0SafycIBb
T5ZVlzw2yVMyuZGSNAkbo6f7NgzBu55nfl4Zv3Y1ErPCi3yWo6MMx/Xexh1OhEz2
5oQVcYaYK+6mU/pMqGnFt1aQ2QssC6LtnWC7GbMCgYAvE4aCjG7zwANuoGPZ5Uhz
HbTHmhn2Jn84VWQ/d8V4232wxydl12vYOYU7tCgreZ5CfmtzkGz809qchgKvaIN4
KbM2OV5bQo47SwvKJy3E1MgfmKC/pIQR+oEPMTEJRlRPJnKxqr5xBZ/WC8RDQl+k
egF1PuOzmodpdYfc8Veh9QKBgFECSW75WCxv5CHdlWhIlxW5j4A3KUUH04yDBjUA
DwQsXcSNZ3GQcx/5H96XDcTmry15NDB1SqByiANBV0JatHtWQ1E7vkVx3ghk6Y7V
OcEpbbkMNCM+Wac3ezptsMA3mf7aAGQvmiBorO4bmyKZU29DQFFGofPjBSTWUW9x
5CE5AoGAYH1JsW+LWFUz0svclEEkyyAJ5MzomegPNOHL2d1rsxLqcjCuek9p/ksT
FJJgIgu4D/JlggKqVBBwH8zgJhGZIhpHhdlu1rF62suCKgDavTjJgufR8cgAVVQw
hp5YILCiZtJcfvePE1AQho50pFZ2a041FYV8PyOMPpIwQn/z1TI=',//'file:///opt/lampp/htdocs/elearning/rsa_private_key.pem',

/*       

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => 'file:///opt/lampp/htdocs/elearning/rsa_public_key.pem',

        // 自己的私钥，签名时使用
        'private_key' => 'file:///opt/lampp/htdocs/elearning/rsa_private_key.pem',*/


        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        //     'level' => 'debug'
        ],

        // optional，设置此参数，将进入沙箱模式
        //'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号 APPID
        'app_id' => env('WECHAT_APP_ID', ''),

        // 小程序 APPID
        'miniapp_id' => '',

        // APP 引用的 appid
        'appid' => '',

        // 微信支付分配的微信商户号
        'mch_id' => env('WECHAT_MCH_ID', ''),

        // 微信支付异步通知地址
        'notify_url' => '',

        // 微信支付签名秘钥
        'key' => '',

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => 'file://'.base_path('pementkey/wechat/apiclient_cert.pem'),

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => 'file://'.base_path('pementkey/wechat/apiclient_key.pem'),

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
        //     'level' => 'debug'
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
         //'mode' => 'dev',
    ],
];
