<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

//�������� ������ �� POST �������
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$gratitudeText = $request->getPost('gratitudeText'); // ����� �������������
$gratitudeMood = $request->getPost('mood'); // ��� �������� ������� ����� ������������ � �������������
$operationType = $request->getPost('operationType'); // ��� �������������� ������. �������� ��� ���������� �������������
$parentBlock = $request->getPost('parentBlock');
$sectionID = $request->getPost('sectionID');
$profileID = $request->getPost('profileID');

/**------------------------------------------------------------------------------------------------------------------*/
/** �������� ID � ��� �������� ������������ */

$currentUserID = $USER->GetID();

$rsCurUser = CUser::GetByID($currentUserID);
if ($arCurUser = $rsCurUser->GetNext()) {
    $currentUserFullName = $arCurUser["~LAST_NAME"] . " " . $arCurUser["~NAME"];
} else {
    echo "Error: " . $rsCurUser->LAST_ERROR;
}


// ������� ����� ������������� � ������������
if (isset($gratitudeText) && isset($gratitudeMood) && $currentUserID >= "1" && $operationType === "addGratitude") {

    $gratitudeAdd = new CIBlockElement;

    $htmlSaveText = htmlspecialcharsEx($gratitudeText); //������ html ����������� �����
    $htmlSaveText =iconv("UTF-8", "windows-1251", $htmlSaveText);

    $arLoadProductArray = array(
        "MODIFIED_BY" => $currentUserID, // ������� ������� ������� �������������
        "IBLOCK_SECTION_ID" => $sectionID,   // ������� ����� � ����� �������
        "IBLOCK_ID" => $parentBlock,
        "NAME" => $currentUserID,
        "ACTIVE" => "Y",            // �������
        "PROPERTY_VALUES" => array(
            "FB_AUTHOR" => $currentUserID,
            "FB_TEXT" => $htmlSaveText,
            "FB_IMG" => htmlspecialcharsEx($gratitudeMood),
        )
    );

    $newElementID = $gratitudeAdd->Add($arLoadProductArray);

    if ($newElementID) {

        //�������� ������ ������������ �������� ��� �������� �����, ����� ��������� email
        $rsUser = CUser::GetByID($profileID);
        if ($arUser = $rsUser->GetNext()) {

            $userEmail = $arUser["~EMAIL"];
            $urlProfile = "http://portal.cmd.su/company/personal/user/" . $arUser["~ID"] . "/";

        } else {
            echo "Error: " . $rsUser->LAST_ERROR;
        }

        $arEventFields = array(
            "EMAIL" => $userEmail,
            "URL_PROFILE" => $urlProfile,

            "FULL_NAME" => $currentUserFullName,
            "TEXT" => $htmlSaveText,
        );
        $MesID = CEvent::Send("USER_ADD_GRATITUDE", "s1", $arEventFields, "N", "", array(''));

        if ($MesID) {
            $data = [
                $newElementID,
                iconv("windows-1251", "UTF-8", $htmlSaveText)
            ];

            echo json_encode($data);

        }else{
            echo "������ ��� �������� email";
        }


    } else {
        echo "Error: " . $gratitudeAdd->LAST_ERROR;
    }

}

?>