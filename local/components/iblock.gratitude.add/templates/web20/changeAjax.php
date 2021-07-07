<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

//�������� ������ �� POST �������
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$gratitudeText = $request->getPost('gratitudeText'); // ����� �������������
$gratitudeMood = $request->getPost('mood'); // ��� �������� ������� ����� ������������ � �������������
$operationType = $request->getPost('operationType'); // ��� �������������� ������. �������� ��� ���������� �������������
$elementID = $request->getPost('elementID');
$sectionID = $request->getPost('sectionID');
//ID �������� ������������
$currentUserID = $USER->GetID();

// ��������� ������������� � ������������
if (isset($gratitudeText) && isset($gratitudeMood) && $currentUserID >= "1" && $operationType === "updateGratitude") {

    $elementUpdate = new CIBlockElement;
    $htmlSaveText = htmlspecialcharsEx($gratitudeText); //������ html ����������� �����
    $htmlSaveText =iconv("UTF-8", "windows-1251", $htmlSaveText);

    $arLoadProductArray = array(
        "MODIFIED_BY" => $currentUserID, // ������� ������� ������� �������������
        "IBLOCK_SECTION_ID" => $sectionID,   // ������� ����� � ����� �������
        "NAME" => $currentUserID,
        "PROPERTY_VALUES" => array(
            "FB_AUTHOR" => $currentUserID,
            "FB_TEXT" => $htmlSaveText,
            "FB_IMG" => htmlspecialcharsEx($gratitudeMood),
        )
    );

    $isElementUpdate = $elementUpdate->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);

    if ($isElementUpdate) {
        //echo "������� ��������?: " . $isElementUpdate;
        echo $htmlSaveText;
    } else {
        echo "Error: " . $elementUpdate->LAST_ERROR;
    }
}

?>