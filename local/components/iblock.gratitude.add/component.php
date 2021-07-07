<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if (!CModule::IncludeModule("socialnetwork")) {
    return false;
}

if (!CModule::IncludeModule("iblock")) {
    return false;
}

/**------------------------------------------------------------------------------------------------------------------*/
/** Тип инфоблока с которым будем работать */
//$parentTypeBlock = "person";
$parentTypeBlock = $arParams["~IBLOCK_TYPE"];

/**------------------------------------------------------------------------------------------------------------------*/
/** ID инфоблока с которым будем работать */
//$parentBlock = '71';
$parentBlock = $arParams["~IBLOCK_ID"];

/**------------------------------------------------------------------------------------------------------------------*/
/** Колличество благодарностей которые можно высести по умолчанию */
//$gratitudeAmount = 3;
$gratitudeAmount = intval($arParams["~GRATITUDE_AMOUNT"]);

/**------------------------------------------------------------------------------------------------------------------*/
/** Проверяем авторизован ли пользователь или нет*/
global $USER;
$userAuthorized = $USER->IsAuthorized();

/**------------------------------------------------------------------------------------------------------------------*/
/** Создаем массив названий возможных картинок к отзывам */
$gratitudeMoodImages = ["crown", "comment", "fire"];

/**------------------------------------------------------------------------------------------------------------------*/
/** Получаем разделы инфоблоков, чтобы понять есть ли среди разделов раздел с ID пользователя*/

$idPersonsHasGratitudes = [];

$depthLevelBlock = '1';
$arFilter = array('IBLOCK_ID' => $parentBlock, 'DEPTH_LEVEL' => $depthLevelBlock); // выберет потомков без учета активности
$rsSect = CIBlockSection::GetList(array('name' => 'desc'), $arFilter);
while ($arSect = $rsSect->GetNext()) {
    $idPersonsHasGratitudes[$arSect['ID']] = $arSect['NAME'];
}

/**------------------------------------------------------------------------------------------------------------------*/
/** Если в списке пользователей о которых ведется сбор отзывов нет ID пользователя которого мы просматриваем,
 * то создаем данный раздел
 */

$profileID = $arParams['USER_ID']; //ID пользователя которого мы просматриваем


if (!in_array($profileID, $idPersonsHasGratitudes, true) && $userAuthorized) {

    $bsAdd = new CIBlockSection;

    $arFields = array(
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => $parentBlock,
        'NAME' => $profileID,
    );

    $rsAdd = $bsAdd->Add($arFields);

    if (!$rsAdd) {
        echo $bs->LAST_ERROR;
    } else {
        $idPersonsHasGratitudes[$rsAdd] = $profileID;
    }

}

/**------------------------------------------------------------------------------------------------------------------*/
/** получаем ID и ФИО текущего пользователя */

$currentUserID = $USER->GetID();

if ($userAuthorized) {
    $rsCurUser = CUser::GetByID($currentUserID);
    if ($arCurUser = $rsCurUser->GetNext()) {
        $currentUserFullName = $arCurUser["~LAST_NAME"] . " " . $arCurUser["~NAME"];
    } else {
        echo "Error: " . $rsCurUser->LAST_ERROR;
    }
}


/**------------------------------------------------------------------------------------------------------------------*/
/** Получаем и обрабатываем благодарность отправленню пользователем*/

//Получает ID инфоблока в котором хранятся благодарности, пользователя для которого мы хотим просмотреть благодарности
$personGratitudesID = array_search($profileID, $idPersonsHasGratitudes, true);

//Получаем данные из POST запроса
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
//$gratitudeText = $request->getPost('gratitude__text'); // Текст благодарности
//$gratitudeMood = $request->getPost('mood'); // Тип картинки которую будем использовать в благодарности
//$operationType = $request->getPost('type'); // Тип обрабатываемых данных. Создание или обновление благодарности
//$elementID = $request->getPost('elementID');
$showAllGratitude = $request->get('amo');


//// Создаем новую благодарность о пользователе
//if (isset($gratitudeText) && isset($gratitudeMood) && $currentUserID >= "1" && $operationType === "addGratitude") {
//
//    $elementAdd = new CIBlockElement;
//
//    $arLoadProductArray = array(
//        "MODIFIED_BY" => $currentUserID, // элемент изменен текущим пользователем
//        "IBLOCK_SECTION_ID" => $personGratitudesID,   // элемент лежит в корне раздела
//        "IBLOCK_ID" => $parentBlock,
//        "NAME" => $currentUserID,
//        "ACTIVE" => "Y",            // активен
//        "PROPERTY_VALUES" => array(
//            "FB_AUTHOR" => $currentUserID,
//            "FB_TEXT" => htmlspecialcharsEx($gratitudeText),
//            "FB_IMG" => htmlspecialcharsEx($gratitudeMood),
//        )
//    );
//
//    $newElementID = $elementAdd->Add($arLoadProductArray);
//
//    if ($newElementID) {
//        //Получаем данные пользователя которому был добавлен отзыв
//
//        $rsUser = CUser::GetByID($profileID);
//        if ($arUser = $rsUser->GetNext()) {
//
//            $userEmail = $arUser["~EMAIL"];
//            $urlProfile = "http://portal.cmd.su/company/personal/user/" . $arUser["~ID"] . "/";
//
//        } else {
//            echo "Error: " . $rsUser->LAST_ERROR;
//        }
//
//        $arEventFields = array(
//            "EMAIL" => $userEmail,
//            "URL_PROFILE" => $urlProfile,
//
//            "FULL_NAME" => $currentUserFullName,
//            "TEXT" => htmlspecialcharsEx($gratitudeText),
//        );
//        $MesID = CEvent::Send("USER_ADD_GRATITUDE", "s1", $arEventFields, "N", "", array(''));
//
//    } else {
//        echo "Error: " . $elementAdd->LAST_ERROR;
//    }
//
//    header('Location: http://' . $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri());
//}

//// Обновляем благодарность о пользователе
//if (isset($gratitudeText) && isset($gratitudeMood) && $currentUserID >= "1" && $operationType === "updateGratitude") {
//
//    $elementUpdate = new CIBlockElement;
//
//    $arLoadProductArray = array(
//        "MODIFIED_BY" => $currentUserID, // элемент изменен текущим пользователем
//        "IBLOCK_SECTION_ID" => $personGratitudesID,   // элемент лежит в корне раздела
//        "NAME" => $currentUserID,
//        "PROPERTY_VALUES" => array(
//            "FB_AUTHOR" => $currentUserID,
//            "FB_TEXT" => htmlspecialcharsEx($gratitudeText),
//            "FB_IMG" => htmlspecialcharsEx($gratitudeMood),
//        )
//    );
//
//    $isElementUpdate = $elementUpdate->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);
//
//    if ($isElementUpdate) {
//        //echo "Элемент обновлен?: " . $isElementUpdate;
//    } else {
//        echo "Error: " . $elementUpdate->LAST_ERROR;
//    }
//
//    header('Location: http://' . $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri());
//}


//// Удаляем благодарность о пользователе (Удаление производится деактивацией элемента)
//if ($currentUserID >= "1" && $operationType === "delGratitude") {
//
//    $elementDisable = new CIBlockElement;
//
//    $arLoadProductArray = array(
//        "MODIFIED_BY" => $currentUserID, // элемент изменен текущим пользователем
//        "IBLOCK_SECTION_ID" => $personGratitudesID,   // элемент лежит в корне раздела
//        "ACTIVE" => "N",
//    );
//
//    $isElementDisable = $elementDisable->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);
//
//    if ($isElementDisable) {
//        //echo "Элемент обновлен?: " . $isElementUpdate;
//    } else {
//        echo "Error: " . $elementDisable->LAST_ERROR;
//    }
//
//    header('Location: http://' . $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri());
//}




/**------------------------------------------------------------------------------------------------------------------*/
/** Получаем список элементов (Благодарностей) из раздела = ID пользователя */

//Массив благодарностей
$arGratitudes = [];

$arFilter = array("IBLOCK_TYPE" => "$parentTypeBlock", "IBLOCK_ID" => $parentBlock, "SECTION_ID" => $personGratitudesID, "ACTIVE" => "Y");
$arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
$dbEls = CIBlockElement::GetList(array('ID' => 'DESC'), $arFilter, false, false, array());

while ($obEl = $dbEls->GetNextElement()) {
    //Превращаем значения массива в html безопастный вид
    $arItem = $obEl->GetFields();

    //Получаем значения свойств созданных вручную
    $extraProperties = $obEl->GetProperties();

    $arGratitudes[] = [
        "SECTION_ID" => $personGratitudesID,
        "ELEMENT_ID" => $arItem["ID"],
        "DATE_CREATE" => $arItem["~DATE_CREATE"],
        "FB_AUTHOR_ID" => $extraProperties["FB_AUTHOR"]["~VALUE"],
        "FB_TEXT" => $extraProperties["FB_TEXT"]["~VALUE"],
        "FB_IMG" => $extraProperties["FB_IMG"]["~VALUE"],
    ];

}

/**------------------------------------------------------------------------------------------------------------------*/
/** Получаем ФИО сотрудника который оставил отзыв */

foreach ($arGratitudes as $key => $gratitude) {
    $rsUser = CUser::GetByID($gratitude["FB_AUTHOR_ID"]);
    if ($arUser = $rsUser->GetNext()) {
        $arGratitudes[$key]["FB_AUTHOR_NAME"] = $arUser["LAST_NAME"] . " " . $arUser["NAME"];
    } else {
        $arGratitudes[$key]["FB_AUTHOR_NAME"] = "Не получилось получить имя";
    }

}

/**------------------------------------------------------------------------------------------------------------------*/
/** Текущая дата */
$currentDate = date("d.m.Y");

$arResult = [
    "arGratitudes" => $arGratitudes,
    "showAllGratitude" => $showAllGratitude,
    "gratitudeAmount" => $gratitudeAmount,
    "currentUserID" => $currentUserID,
    "userAuthorized" => $userAuthorized,
    "gratitudeMoodImages" => $gratitudeMoodImages,
    "profileID" => $profileID,
    "personGratitudesID" => $personGratitudesID,
    "parentBlock" => $parentBlock,
    "currentUserFullName" => $currentUserFullName,
    "currentDate" => $currentDate,
];

//подключение шаблона компонента
$this->IncludeComponentTemplate();
?>