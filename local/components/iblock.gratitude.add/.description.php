<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Массив благодаря которому компонент отобразится в списке компонентов в визуальном редакторе
$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_ELEMENT_ADD_NAME"), // название компонента
	"DESCRIPTION" => GetMessage("IBLOCK_ELEMENT_ADD_DESCRIPTION"), // описание компонента
	"ICON" => "/images/eadd.gif", // иконка компонента относительно папки компонента
    'CACHE_PATH' => 'Y', // показывать кнопку очистки кеша компонента, под кнопкой сбросить кеш в режиме редактирования
    'SORT' => 100, // порядок сортировки в визуальном редакторе
	"COMPLEX" => "N", // признак комплексного компонента
	"PATH" => array( // расположение компонента в визуальном редакторе
		"ID" => "my test component", // идентификатор верхнего уровеня в редакторе, можно указать произвольные данные
        'NAME' => GetMessage("T_IBLOCK_PARENT_NAME"), // название верхнего уровня в редакторе, можно указать произвольные данные
		"CHILD" => array( // второй уровень в визуальном редакторе
			"ID" => "iblock_gratitude_add", // идентификатор второго уровня в редакторе, можно указать произвольные данные
			"NAME" => GetMessage("T_IBLOCK_CHILD_NAME"), // название второго уровня в редакторе, можно указать произвольные данные
		),
	),
);

// Подробная информация тут https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2828&LESSON_PATH=3913.2704.2881.2828
?>



