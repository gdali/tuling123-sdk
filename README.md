# tuling123-sdk
    图灵机器人API SDK for PHP，支持图灵机器人接口v1.0和v2.0，官方文档：http://doc.tuling123.com/openapi2/263611
# 要求
    PHP >= 5.3.0
# 安装
    composer require "gdali/tuling123-sdk"
# 使用
    有五个主要参数：
*  appID：机器人的APIkey，必填
*  appKey：机器人的secret，必填
*  userID：用户唯一标识符，选填，默认为1
*  selfInfo：客户端属性参数，数组，选填，默认为空，详见demo
*  Text：输入字符串，必填
# 输出
    当->tuling带true参数时，返回Tuling123的原生数组，否则返回文字信息。
