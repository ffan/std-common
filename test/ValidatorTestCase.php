<?php
namespace ffan\php\utils;

require_once '../vendor/autoload.php';

var_dump(Validator::isMobile('18018684626'));

var_dump(Validator::isMobile('+8618018684626'));

var_dump(Validator::isEmail('18844626@qq.com'));

var_dump(Validator::isEmail('18844626@qq.com.cn'));

var_dump(Validator::isEmail('haung.s.z@qq.com.cn'));

var_dump(Validator::isEmail('haung_sz@qq.cn'));

var_dump(Validator::isUrl('http://api.ffan.com/activity/v1/gift/logistics/recipient?couponId=20170310155351&couponCode=072002816872'));

var_dump(Validator::isIdCard('51052220140106001x'));

var_dump(Validator::isIdCard('510522201401060012'));

var_dump(Validator::isIp('255.255.255.255'));

var_dump(Validator::isIp('255.255.255.256'));

var_dump(Validator::isIp('51.139.2.69'));

var_dump(Validator::isQQ('18844626'));

var_dump(Validator::isPrice(127.36));

var_dump(Validator::isPrice(-127.36));

var_dump(Validator::isPlateNumber('苏KP2017'));

var_dump(Validator::isPlateNumber('苏K-P2017'));

var_dump(Validator::isPlateNumber('内K P2017'));

var_dump(Validator::isPlateNumber('蒙K P2017'));

var_dump(Validator::isZipCode('201802'));

var_dump(Validator::isDate('2017-12-12'));

var_dump(Validator::isDate('2017/12/12'));

var_dump(Validator::isDateTime('2017/12/12 12:00:21'));

var_dump(Validator::isDateTime('2017/12/12 12:01'));
