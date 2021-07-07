<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

//Получаем данные из POST запроса
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$operationType = $request->getPost('operationType'); // Тип обрабатываемых данных. Создание или обновление благодарности
$sectionID = $request->getPost('sectionID');
$elementID = $request->getPost('elementID');
//ID текущего пользователя
$currentUserID = $USER->GetID();

// Удаляем благодарность о пользователе (Удаление производится деактивацией элемента)
if ($currentUserID >= "1" && $operationType === "delGratitude") {

    $elementDisable = new CIBlockElement;

    $arLoadProductArray = array(
        "MODIFIED_BY" => $currentUserID, // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => $sectionID,   // элемент лежит в корне раздела
        "ACTIVE" => "N",
    );

    $isElementDisable = $elementDisable->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);

    if ($isElementDisable) {
        //echo "Элемент обновлен?: " . $isElementUpdate;
        echo "<div class='gratitudes__item'>","Благодарность удалена","</div>";
    } else {
        echo "Error: " . $elementDisable->LAST_ERROR;
    }
}

?>