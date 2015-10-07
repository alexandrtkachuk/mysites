<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'db_ihelp');

/** Имя пользователя MySQL */
define('DB_USER', 'ihelp');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'tihelp');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ff~m`[} |+a8.W/i0~9-12}0{F:sgzQyr)&O7FaF+2[|2{hABYlL]#C6)#O|k rE');
define('SECURE_AUTH_KEY',  'H9c ?XMyOd|taUP:&den&CH&pq5.|JuY3B#[{-K8^EH|7f:@5Dz4B3BV_x2x|%}7');
define('LOGGED_IN_KEY',    'KBx$f:U4%Tmr=C,$G/1,4)7Ox}#36,KLx/ZA7TLONy?<#?O>TBi,cjt-8>ph,he8');
define('NONCE_KEY',        'pAD|}%Y.1&s#;g}m%>8X+7] gC=q;%EH,-u`N&2[h7/fI+V-sYVS}d{+4<YB..HZ');
define('AUTH_SALT',        'PoaA>ax*uVf8C@o0-E*gg#-am!er&oIWYf1@aCvDHnpOAr2k%.9W-+cGE/mE@_zF');
define('SECURE_AUTH_SALT', '%fg2+Z;$:-Np,9IO1CnNAM@j=$o8pc-/yK14nI+ +N`%KxY;V|wgS;}6-|aMsj/R');
define('LOGGED_IN_SALT',   'ct!oA!+KXY*E!krF-Eu d2e,D`O& 2+Hwc&x`/98C%+ZVfy64w&Egvkr+Yww,-c{');
define('NONCE_SALT',       'IqRm%kG%_p-z<U+w<x*$Oqd5w<O0rJ@9U{6-v^K`bFj`7wkXC+K7cS9$MY2B1Z~u');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
