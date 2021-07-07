<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

//�������� ������ �� POST �������
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$operationType = $request->getPost('operationType'); // ��� �������������� ������. �������� ��� ���������� �������������
$sectionID = $request->getPost('sectionID');
$elementID = $request->getPost('elementID');
//ID �������� ������������
$currentUserID = $USER->GetID();

// ������� ������������� � ������������ (�������� ������������ ������������ ��������)
if ($currentUserID >= "1" && $operationType === "delGratitude") {

    $elementDisable = new CIBlockElement;

    $arLoadProductArray = array(
        "MODIFIED_BY" => $currentUserID, // ������� ������� ������� �������������
        "IBLOCK_SECTION_ID" => $sectionID,   // ������� ����� � ����� �������
        "ACTIVE" => "N",
    );

    $isElementDisable = $elementDisable->Update(htmlspecialcharsEx($elementID), $arLoadProductArray);

    if ($isElementDisable) {
        //echo "������� ��������?: " . $isElementUpdate;
        echo "<div class='gratitudes__item'>","������������� �������","</div>";
    } else {
        echo "Error: " . $elementDisable->LAST_ERROR;
    }
}

?>