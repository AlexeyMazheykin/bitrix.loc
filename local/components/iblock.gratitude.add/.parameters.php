<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// проверяем, установлен ли модуль «Информационные блоки»; если да — то подключаем его
if (!CModule::IncludeModule("iblock"))
    return;

// Получаем массив всех типов инфоблоков — для возможности выбора их в параметрах
$arIBlockType = CIBlockParameters::GetIBlockTypes();

// Получаем массив всех инфоблоков — для возможности выбора их в параметрах
$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}

// Группы пользователей, имеющие право на добавление/редактирование
$arGroups = array();
$rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", array("ACTIVE" => "Y"));
while ($arGroup = $rsGroups->Fetch()) {
    $arGroups[$arGroup["ID"]] = $arGroup["NAME"];
}


// Массив который описывает входные параметры компонента
$arComponentParameters = array(
    // Массив групп параметров компонента в визуальном редакторе
    "GROUPS" => array(

        // Стандартные коды которые есть по умолчанию. Код - Вес сортировки - Название
        // BASE	- 100 - сновные параметры
        // DATA_SOURCE - 200 - Источник данных
        // VISUAL - 300 - Настройки внешнего вида
        // USER_CONSENT - 350 - Согласие пользователя
        // URL_TEMPLATES - 400 - Шаблоны ссылок
        // SEF_MODE - 500 - Управление адресами страниц
        // AJAX_SETTINGS - 550 - Управление режимом AJAX
        // CACHE_SETTINGS - 600 - Настройки кеширования
        // ADDITIONAL_SETTINGS - 700 - Дополнительные настройки
//        "ACCESS" => array( //ACCESS код группы параметров, указывается в PARENT параметра
//            "NAME" => GetMessage("IBLOCK_ACCESS"), // Название группы в визуальном редакторе на текущем языке
//            "SORT" => "400", // Cортировка
//        ),

        "PARAMS" => array( //PARAMS код группы параметров, указывается в PARENT параметра
            "NAME" => GetMessage("IBLOCK_PARAMS"), // Название группы в визуальном редакторе на текущем языке
            "SORT" => "1000" // Cортировка
        ),

    ),

    // Массив параметров компонента
    "PARAMETERS" => array(

//        "код параметра" => array(
//            "PARENT" => "код группы",  // если пустое - ставится ADDITIONAL_SETTINGS
//            "NAME" => " название параметра на текущем языке", //рекомендуется подключение из lang файлов с помощью GetMessage("IBLOCK_USER_ID"),
//            "TYPE" => "тип элемента управления, в котором будет устанавливаться параметр",
//            // Типы бывают следующих типов: LIST, STRING, CHECKBOX, FILE, COLORPICKER
//            //Для типа LIST ключ VALUES содержит массив значений следующего вида:
//            //VALUES => array(
//            //   "ID или код, сохраняемый в настройках компонента" => "языкозависимое описание",
//            //),
//            "REFRESH" => "перегружать окно настроек или нет после выбора (N/Y)",
//            "MULTIPLE" => "одиночное/множественное значение (N/Y)",
//            "VALUES" => "массив значений для списка ('TYPE' = 'LIST')",
//            "ADDITIONAL_VALUES" => "добавляется значение "другое" в тип параметра "LIST", вводимых вручную (Y/N)",
//            "SIZE" => "число строк для списка (если нужен не выпадающий список)",
//            "DEFAULT" => "значение по умолчанию",
//            "COLS" => "ширина поля в символах",
//        ),

        //Также есть страндартные параметры которые не нужно пописывать и указать как указанно ниже.
//        "SET_TITLE" => array(), // следует ли компоненту установить заголовок страницы
//        "CACHE_TIME" => array(), // все настройки, связанные с кешированием
//        "AJAX_MODE" => array(), // все настройки, связанные с AJAX настроками
//        "SEF_MODE" => array(), // все настройки, связанные ЧПУ

        "CACHE_TIME" => array(),

        "IBLOCK_TYPE" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("IBLOCK_TYPE"), //Тип инфоблока
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
            "MULTIPLE" => "N",
        ),

        "IBLOCK_ID" => array(
            "PARENT" => "DATA_SOURCE", //
            "NAME" => GetMessage("IBLOCK_IBLOCK"), //Инфоблок
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "MULTIPLE" => "N",
        ),

        "USER_ID" => array(
            "PARENT" => "PARAMS",
            "NAME" => GetMessage("USER_ID"),
            "TYPE" => "STRING",
            "COLS" => "30",
        ),

        "GRATITUDE_AMOUNT" => array(
            "PARENT" => "PARAMS",
            "NAME" => GetMessage("GRATITUDE_AMOUNT"),
            "TYPE" => "STRING",
            "COLS" => "30",
        ),


//        "GROUPS" => array(
//            "PARENT" => "ACCESS",
//            "NAME" => GetMessage("IBLOCK_GROUPS"), // Группы пользователей, имеющие право на добавление/редактирование
//            "TYPE" => "LIST",
//            "MULTIPLE" => "Y",
//            "ADDITIONAL_VALUES" => "N",
//            "VALUES" => $arGroups,
//        ),


//        "ALLOW_EDIT" => array(
//            "PARENT" => "ACCESS",
//            "NAME" => GetMessage("IBLOCK_ALLOW_EDIT"), //Разрешать редактирование
//            "TYPE" => "CHECKBOX",
//            "DEFAULT" => "Y",
//        ),

//        "ALLOW_DELETE" => array(
//            "PARENT" => "ACCESS",
//            "NAME" => GetMessage("IBLOCK_ALLOW_DELETE"), // Разрешать удаление
//            "TYPE" => "CHECKBOX",
//            "DEFAULT" => "Y",
//        ),


    ),
);

?>