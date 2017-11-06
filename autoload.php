<?php
/**
 * Автозагрузка:
 *  - создаем и регистрируем анонимную функцию автозагрузки для собственных классов
 *  - подключаем файл автозагрузки, созданный composer
**/

spl_autoload_register(function($class) 
{
	$filename = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
	if(file_exists($filename)) {
		require $filename;	
	}
});

include __DIR__ . '/vendor/autoload.php';
