<?php

$config = [];

/**
 * 运行环境（dev|test|pro）
 */
$config['env'] = 'pro';

/**
 * 加解密钥
 */
$config['key'] = 'mlq7jQ1Py8kTdW9m';

/**
 * 所在时区
 */
$config['timezone'] = 'Asia/Shanghai';

/**
 * 网站根地址，必须以"/"结尾
 */
$config['base_uri'] = '/';

/**
 * 静态资源根地址，必须以"/"结尾
 */
$config['static_base_uri'] = '/static/';

/**
 * 静态资源版本
 */
$config['static_version'] = '202004080830';

/**
 * 数据库主机名
 */
$config['db']['host'] = 'mysql';

/**
 * 数据库端口
 */
$config['db']['port'] = 3306;

/**
 * 数据库名称
 */
$config['db']['dbname'] = 'ctc';

/**
 * 数据库用户名
 */
$config['db']['username'] = 'ctc';

/**
 * 数据库密码
 */
$config['db']['password'] = '1qaz2wsx3edc';

/**
 * 数据库编码
 */
$config['db']['charset'] = 'utf8mb4';

/**
 * redis主机名
 */
$config['redis']['host'] = 'redis';

/**
 * redis端口号
 */
$config['redis']['port'] = 6379;

/**
 * redis密码
 */
$config['redis']['auth'] = '1qaz2wsx3edc';

/**
 * redis库编号
 */
$config['redis']['index'] = 0;

/**
 * 缓存有效期（秒）
 */
$config['redis']['lifetime'] = 24 * 3600;

/**
 * 会话有效期（秒）
 */
$config['session']['lifetime'] = 2 * 3600;

/**
 * 日志级别
 */
$config['log']['level'] = Phalcon\Logger::INFO;

return $config;