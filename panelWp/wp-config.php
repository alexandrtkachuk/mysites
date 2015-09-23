<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
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
define('AUTH_KEY',         'VQo*> o`Uuw[oXDU?Hxi@C5h`YCrojiqC3)q<&Sb=/fP6FP[KwZ&v)n+[a9Kj0vb');
define('SECURE_AUTH_KEY',  'IHz;.~Zza)A-E+^JQ]$!VCykhoEz!6)f&z*:0g0HSNGkACdb,G,QU|wMzqJi*KvQ');
define('LOGGED_IN_KEY',    '5:Pjc(Tg%/}7Yq9,$j59s[J<^r4]<_j~BXo>V]m+-koT*OP{u?XtP:saI.8mp$Fn');
define('NONCE_KEY',        'd~tIlr,(Lx92IU:$|5sbK6:8!EAPQ{n;@#{{jho,&w=)uP=YW@+x=1pTFihN@K3$');
define('AUTH_SALT',        'gEUuH7lFV!Q5#,l*8nAPE$6#?Ocuq?~|6Yl]HcZGNqrTu0[FSe/!&|J&j6@}6{wP');
define('SECURE_AUTH_SALT', 'F({Sckw,u+-.a&:3%Z;g-pkX&yLl[{z(4{# -E(S>tM_&9iibAr!sioUs>Q)$ dT');
define('LOGGED_IN_SALT',   'vSCuLG3-?6|[ok+apVVi3#C8)/kcGiTe~Jv({xtlnyt|+j`N8bL.wC;t1,9Le6Zu');
define('NONCE_SALT',       'Z#M6?&j|.MpnNp0htr+N-;;O}; Nl#%K7q7^f/ZqI4N -#l3/Wk7p%<5]Rz+1{V]');

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
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
