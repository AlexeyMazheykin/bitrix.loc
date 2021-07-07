<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

//ѕолучаем данные из POST запроса
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$gratitudeText = $request->getPost('gratitudeText'); // “екст благодарности
$gratitudeMood = $request->getPost('mood'); // “ип картинки которую будем использовать в благодарности
$operationType = $request->getPost('operationType'); // “ип обрабатываемых данных. —оздание или обновление благодарности
$elementID = $request->getPost('elementID');
$sectionID = $request->getPost('sectionID');
//ID текущего пользовател€
$currentUserID = $USER->GetID();

// ќбновл€ем благодарность о пользователе
if (isset($gratitudeText) && isset($gratitudeMood) && $currentUserID >= "1" && $operationType === "updateGratitude") {

    $elementUpdate = new CIBlockElement;
    $htmlSaveText = htmlspecialcharsEx($gratitudeText); //делаем html безопастным текст
    $htmlSaveText =iconv("UTF-8", "windows-1251", $htmlSaveText);

    $arLoadProductArray = array(
        "MODIFIED_BY" => $currentUserID, // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => $sectionID,   // элемент лежит в корне раздела
        "NAME" => $currentUserID,
        "PROPERTY_VALUES" => array(
            "FB_AUTHOR" => $currentUserID,
            "FB_TEXT" => $htmlSaveText,
            "FB_IMG" => htmlspecialcharsEx($gratitudeMood),
        )
    );

    $isElementUpdate = $elementUpdate->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);

    if ($isElementUpdate) {
        //echo "Ёлемент обновлен?: " . $isElementUpdate;
        echo $htmlSaveText;
    } else {
        echo "Error: " . $elementUpdate->LAST_ERROR;
    }
}

?>