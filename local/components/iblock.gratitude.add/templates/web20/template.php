<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? // �������� �������� ������
$arGratitudes = $arResult["arGratitudes"];
$showAllGratitude = $arResult["showAllGratitude"];
$gratitudeAmount = $arResult["gratitudeAmount"];
$currentUserID = $arResult["currentUserID"];
$userAuthorized = $arResult["userAuthorized"];
$gratitudeMoodImages = $arResult["gratitudeMoodImages"];
$profileID = $arResult["profileID"];
?>

<div class="gratitudes__wrap">

    <? // ���� ������� ?>

    <div class="gratitudes">
        <? if (!isset($arGratitudes[0]) && count($arGratitudes) < 1): ?>

            <? //������������� ����������� ?>
            <h4 class="gratitudes__none">������ �����������...</h4>

        <? else: ?>

            <? // ���� ��� ����������� ��������� �������������� ?>

            <? foreach ($arGratitudes as $i => $gratitude): ?>


                <? // ���� ��� ��������� "�������� ��� �������������" �� ������� ������ ���
                if ($showAllGratitude !== "all" && $i >= $gratitudeAmount) {
                    break;
                } ?>

                <div class="gratitudes__item">

                    <? // ����� ������������� (������, ���, ����, ��������) ?>
                    <div class="gratitudes__item-title">
                        <img class="gratitudes__item-img" src="/upload/images/mood/<?= $gratitude["FB_IMG"] ?>.png"
                             width="40" height="40" alt="<?= $gratitude["FB_IMG"] ?>">
                        <a class="gratitudes__item-name"
                           href="/company/personal/user/<?= $gratitude["FB_AUTHOR_ID"] ?>/"><?= $gratitude["FB_AUTHOR_NAME"] ?></a>
                        <div class="gratitudes__item-date">����
                            ��������: <?= substr($gratitude["DATE_CREATE"], 0, 10) ?></div>

                        <? //������ "��������" ������������� ?>
                        <? if (intval($gratitude["FB_AUTHOR_ID"]) === intval($currentUserID) && $userAuthorized): ?>
                            <button class="sidebar-button gratitudes__item-btn gratitudes__open-change-form">
                                <span class="sidebar-button-top"><span class="corner left"></span><span
                                            class="corner right"></span></span>
                                <span class="sidebar-button-content"><span
                                            class="sidebar-button-content-inner"><b>��������</b></span></span>
                                <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                            class="corner right"></span></span>
                            </button>
                        <? endif; ?>

                        <? //������ "�������" ������������� ?>
                        <? if (intval($gratitude["FB_AUTHOR_ID"]) === intval($currentUserID) && $userAuthorized): ?>

                            <form action=""
                                  method="post"
                                  class="delForm">
                                <input hidden name="type" value="delGratitude">
                                <input hidden name="sectionID" value="<?= $gratitude["SECTION_ID"] ?>">
                                <input hidden name="elementID" value="<?= $gratitude["ELEMENT_ID"] ?>">
                                <button class="sidebar-button gratitudes__del-item-btn">
                                <span class="sidebar-button-top"><span class="corner left"></span><span
                                            class="corner right"></span></span>
                                    <span class="sidebar-button-content"><span
                                                class="sidebar-button-content-inner"><b>�������</b></span></span>
                                    <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                                class="corner right"></span></span>
                                </button>

                            </form>

                        <? endif; ?>

                    </div>


                    <div class="gratitudes__item-body">
                        <div class="gratitudes__item-text"><?= $gratitude["FB_TEXT"] ?></div>

                        <? // ����� ��������� ������������� ?>

                        <? if (intval($gratitude["FB_AUTHOR_ID"]) === intval($currentUserID) && $userAuthorized): ?>
                            <form action="http://<?= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri() ?>"
                                  method="post"
                                  class="chageForm gratitudes__update-form display-none">
                                <input hidden name="type" value="updateGratitude">
                                <input hidden name="sectionID" value="<?= $gratitude["SECTION_ID"] ?>">
                                <input hidden name="elementID" value="<?= $gratitude["ELEMENT_ID"] ?>">
                                <textarea class="gratitudes__form-textarea gratitudes__form-textarea_update"
                                          name="gratitude__text" required><?= $gratitude["FB_TEXT"] ?></textarea>

                                <div class="gratitudes__form-bottom">
                                    <div class="gratitudes__radio">

                                        <? foreach ($gratitudeMoodImages as $key => $moodImage): ?>
                                            <div class="gratitudes__input-wrap">
                                                <input class="gratitudes__input" type="radio" name="mood"
                                                       value="<?= $moodImage ?>"
                                                    <? if ($moodImage === $gratitude["FB_IMG"]) {
                                                        echo "checked";
                                                    } ?>>
                                                <img class="gratitudes__radio-img"
                                                     src="/upload/images/mood/<?= $moodImage ?>.png"
                                                     width="40" height="40"
                                                     alt="good">

                                            </div>
                                        <? endforeach; ?>

                                    </div>

                                    <button class="sidebar-button gratitudes__input-button gratitudes__send-change-form">
                        <span class="sidebar-button-top"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                                        <span class="sidebar-button-content"><span
                                                    class="sidebar-button-content-inner">
                                                <i class="sidebar-button-accept"></i><b class="gratitudes__button-text">�������� �������������</b></span></span>
                                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                                    class="corner right"></span></span>
                                    </button>

                                </div>


                            </form>
                        <? endif; ?>

                    </div>

                </div>


            <? endforeach; ?>

            <? // ���� ��� ��������� "�������� ��� �������������" �� ������� ������, �������� ���
            if ($showAllGratitude !== "all" && count($arGratitudes) > $gratitudeAmount):?>
                <div class="gratitudes__show-all-wrap">

                    <a class="sidebar-button gratitudes__show-all"
                       href="http://<?= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri("amo=all") ?>">
                        <span class="sidebar-button-top"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                        <span class="sidebar-button-content"><span class="sidebar-button-content-inner"><b
                                        class="gratitudes__show-all-text">�������� ��� �������������</b></span></span>
                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                    </a>

                </div>

            <? endif; ?>

        <? endif; ?>


    </div>


    <? // ���� ���������� ����� ������������� ?>

    <? if ($profileID !== $currentUserID && $userAuthorized): ?>

        <div class="gratitudes__add-wrap">

            <h4 class="gratitudes__add-title">�������� �����</h4>

            <form action="http://<?= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri() ?>" method="post"
                  class="gratitudes__add-form" id="addForm">
                <input hidden name="type" value="addGratitude">
                <input hidden name="parentBlock" value="<?= $arResult["parentBlock"] ?>">
                <input hidden name="sectionID" value="<?= $arResult["personGratitudesID"] ?>">
                <input hidden name="profileID" value="<?= $arResult["profileID"] ?>">
                <textarea class="gratitudes__form-textarea" name="gratitude__text" required></textarea>

                <div class="gratitudes__form-bottom">
                    <div class="gratitudes__radio">

                        <? foreach ($gratitudeMoodImages as $key => $moodImage): ?>
                            <div class="gratitudes__input-wrap">
                                <input class="gratitudes__input" type="radio" name="mood" value="<?= $moodImage ?>"
                                    <? if ($key === 0) {
                                        echo "checked";
                                    } ?>>
                                <img class="gratitudes__radio-img" src="/upload/images/mood/<?= $moodImage ?>.png"
                                     width="40" height="40"
                                     alt="good">

                            </div>
                        <? endforeach; ?>

                    </div>

                    <button class="sidebar-button gratitudes__input-button gratitudes__add-input-button">
                        <span class="sidebar-button-top"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                        <span class="sidebar-button-content"><span class="sidebar-button-content-inner"><i
                                        class="sidebar-button-create"></i><b class="gratitudes__button-text">�������� �������������</b></span></span>
                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                    </button>

                </div>


            </form>

        </div>

    <? endif; ?>

</div>


<? /**------------------------------------------------------------------------------------------------------------*/
/** ������ ��� ������� ������������� */
?>
<script>


    (function () {

        /**-------------------------------------------------------------------------------------------------------------*/
        /**������� �������� �������������*/

        function f_delGratitude(event) {

            //���������, �� ����� ������  ��������
            let target = event.target;
            let delBtn = target.closest("button.gratitudes__del-item-btn");

            let gratitudeItem = target.closest("div.gratitudes__item");

            // ���������� �������� � �������� �������������
            if (delBtn !== null) {
                if (delBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //�������� ������������ ������� �������������
                let delForm = target.closest("form.delForm");

                //�������� �� �������� ������ ��� ��������
                let operationType = $(delForm).children("input[name='type']")["0"]["defaultValue"];

                //�������� �� �������� ������ id ������� � ������� ��������� �������
                let sectionID = $(delForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //�������� �� �������� ������ id �������� ��������� �� ��������
                let elementID = $(delForm).children("input[name='elementID']")["0"]["defaultValue"];

                BX.ajax({
                    url: '<?=$templateFolder . '/delAjax.php';?>',
                    data: {'operationType': operationType, 'elementID': elementID, 'sectionID': sectionID},
                    method: 'POST',
                    dataType: 'html',
                    timeout: 30,
                    async: true,
                    processData: true,
                    scriptsRunFirst: true,
                    emulateOnload: true,
                    start: true,
                    cache: false,
                    onsuccess: function (data) {
                        $(gratitudeItem).replaceWith(data);
                    },
                    onfailure: function () {
                        console.log("������ AJAX");
                    }
                });

            }

        }


        /**-------------------------------------------------------------------------------------------------------------*/
        /**������� ����������� ����� ��������� �������������*/

        function f_openChangeGratitudeForm(event) {
            //���������, �� ����� ������ "��������" ��������
            let target = event.target;
            let updateBtn = target.closest("button.gratitudes__open-change-form");

            if (updateBtn !== null) {
                if (updateBtn.tagName !== "BUTTON") return;

                //�������� ������������ ������� �������������
                let gratitudeWrap = target.closest("div.gratitudes__item");

                //��������� ��������� ����� �������������� �������������
                let updateForm = $(gratitudeWrap).find("form.gratitudes__update-form");
                $(updateForm).toggleClass("display-none");
            }

        }


        /**-------------------------------------------------------------------------------------------------------------*/
        /**������� �������������� �������������*/

        function f_sendChangeGratitudeForm(event) {

            //���������, �� ����� ������  ��������
            let target = event.target;
            let sendBtn = target.closest("button.gratitudes__send-change-form");

            let gratitudeItem = target.closest("div.gratitudes__item");

            // ���������� �������� � �������� �������������
            if (sendBtn !== null) {
                if (sendBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //�������� ������������ ������� �������������
                let delForm = target.closest("form.chageForm");

                //�������� �� �������� ������ ��� ��������
                let operationType = $(delForm).children("input[name='type']")["0"]["defaultValue"];

                //�������� �� �������� ������ id ������� � ������� ��������� �������
                let sectionID = $(delForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //�������� �� �������� ������ id �������� ��������� �� ��������
                let elementID = $(delForm).children("input[name='elementID']")["0"]["defaultValue"];

                //�������� �� ������ ����� �������������
                let gratitudeText = $(delForm).children("textarea[name='gratitude__text']")["0"]["value"];

                //�������� �� ������ �������� ��������� ��������
                let mood = $(delForm).find("input[name='mood']:checked")["0"]["defaultValue"];

                BX.ajax({
                    url: '<?=$templateFolder . '/changeAjax.php';?>',
                    data: {
                        'operationType': operationType,
                        'sectionID': sectionID,
                        'elementID': elementID,
                        'gratitudeText': gratitudeText,
                        'mood': mood,
                    },
                    method: 'POST',
                    dataType: 'html',
                    timeout: 30,
                    async: true,
                    processData: true,
                    scriptsRunFirst: true,
                    emulateOnload: true,
                    start: true,
                    cache: false,
                    onsuccess: function (data) {
                        // ����������� ������ ������ �������������
                        let textWrap = $(delForm).closest("div.gratitudes__item-body");
                        let textSpace = $(textWrap).children("div.gratitudes__item-text");
                        textSpace.html(data);

                        // �������� �������� �������������
                        let gratitudeWrap = $(textWrap).closest("div.gratitudes__item");
                        let moodImg = $(gratitudeWrap).find("img.gratitudes__item-img");
                        moodImg.attr("src", "/upload/images/mood/" + mood + ".png");
                    },
                    onfailure: function () {
                        console.log("������ AJAX");
                    }
                });

            }

        }

        /**-------------------------------------------------------------------------------------------------------------*/
        /**������� ���������� ����� �������������*/

        function f_addGratitude(event) {

            //���������, �� ����� ������  ��������
            let target = event.target;
            let addBtn = target.closest("button.gratitudes__add-input-button");

            let gratitudeAddWrap = target.closest("div.gratitudes__wrap");

            // ���������� ��������
            if (addBtn !== null) {
                if (addBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //�������� ������������ ������� ����� �������������
                let addForm = target.closest("form#addForm");

                //�������� �� ������ ����� �������������
                let gratitudeText = $(addForm).children("textarea[name='gratitude__text']")["0"]["value"];

                //�������� �� ������ �������� ��������� ��������
                let mood = $(addForm).find("input[name='mood']:checked")["0"]["defaultValue"];

                //�������� �� �������� ������ ��� ��������
                let operationType = $(addForm).children("input[name='type']")["0"]["defaultValue"];

                //�������� �� �������� ������ id ���������
                let parentBlock = $(addForm).children("input[name='parentBlock']")["0"]["defaultValue"];

                //�������� �� �������� ������ id ������� � ������� ��������� �������
                let sectionID = $(addForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //�������� �� �������� ������ id ���������
                let profileID = $(addForm).children("input[name='profileID']")["0"]["defaultValue"];

                BX.ajax({
                    url: '<?=$templateFolder . '/addAjax.php';?>',
                    data: {
                        'gratitudeText': gratitudeText,
                        'mood': mood,
                        'operationType': operationType,
                        'parentBlock': parentBlock,
                        'sectionID': sectionID,
                        'profileID': profileID,
                    },
                    method: 'POST',
                    dataType: 'json',
                    timeout: 30,
                    async: true,
                    processData: true,
                    scriptsRunFirst: true,
                    emulateOnload: true,
                    start: true,
                    cache: false,
                    onsuccess: function (data) {

                        // ������� ����� �������� ����� �������������.
                        $(addForm).children("textarea[name='gratitude__text']")["0"]["value"] = "";

                        let newIDGratitude = data[0];
                        let newTextGratitude = data[1];

                        // ����������� ������ ������ �������������
                        let gratitudesSpace = $(gratitudeAddWrap).children("div.gratitudes");

                        $(gratitudesSpace).prepend("" +
                            "<div class=\"gratitudes__item\"> " +
                            "<div class=\"gratitudes__item-title\"> " +
                            "<img class=\"gratitudes__item-img\" src=\"/upload/images/mood/" +
                            mood +
                            ".png\" width=\"40\" height=\"40\" alt=\"" +
                            mood +
                            "\"> " +
                            "<a class=\"gratitudes__item-name\" href=\"/company/personal/user/11840/\">" +
                            "<?=$arResult["currentUserFullName"]?>" +
                            "</a> " +
                            "<div class=\"gratitudes__item-date\">" +
                            "���� ��������: " +
                            "<?=$arResult["currentDate"]?>" +
                            "</div> " +
                            "<button class=\"sidebar-button gratitudes__item-btn gratitudes__open-change-form\"> " +
                            "<span class=\"sidebar-button-top\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> " +
                            "<span class=\"sidebar-button-content\"><span class=\"sidebar-button-content-inner\"><b>" + "��������" +
                            "</b></span></span> <span class=\"sidebar-button-bottom\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> </button> " +
                            "<form action=\"\" method=\"post\" class=\"delForm\"> " +
                            "<input hidden=\"\" name=\"type\" value=\"delGratitude\"> " +
                            "<input hidden=\"\" name=\"sectionID\" value=\"" +
                            sectionID +
                            "\"> " +
                            "<input hidden=\"\" name=\"elementID\" value=\"" +
                            newIDGratitude +
                            "\"> " +
                            "<button class=\"sidebar-button gratitudes__del-item-btn\"> " +
                            "<span class=\"sidebar-button-top\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> " +
                            "<span class=\"sidebar-button-content\"><span class=\"sidebar-button-content-inner\"><b>�������</b></span></span> " +
                            "<span class=\"sidebar-button-bottom\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> </button> </form> " +
                            "</div> <div class=\"gratitudes__item-body\"> <div class=\"gratitudes__item-text\">" +
                            newTextGratitude +
                            "</div> " +
                            "<form action=\"http://portal.cmd.su/test.php\" method=\"post\" class=\"chageForm gratitudes__update-form display-none\"> " +
                            "<input hidden=\"\" name=\"type\" value=\"updateGratitude\"> " +
                            "<input hidden=\"\" name=\"sectionID\" value=\"" +
                            sectionID +
                            "\"> " +
                            "<input hidden=\"\" name=\"elementID\" value=\"" +
                            newIDGratitude +
                            "\"> " +
                            "<textarea class=\"gratitudes__form-textarea gratitudes__form-textarea_update\" name=\"gratitude__text\" required=\"\">" +
                            newTextGratitude +
                            "</textarea> " +
                            "<div class=\"gratitudes__form-bottom\"> <div class=\"gratitudes__radio\"> <div class=\"gratitudes__input-wrap\"> " +
                            "<input class=\"gratitudes__input\" type=\"radio\" name=\"mood\" value=\"crown\"> " +
                            "<img class=\"gratitudes__radio-img\" src=\"/upload/images/mood/crown.png\" width=\"40\" height=\"40\" alt=\"good\"> </div> " +
                            "<div class=\"gratitudes__input-wrap\"> <input class=\"gratitudes__input\" type=\"radio\" name=\"mood\" value=\"comment\" checked=\"\"> " +
                            "<img class=\"gratitudes__radio-img\" src=\"/upload/images/mood/comment.png\" width=\"40\" height=\"40\" alt=\"good\"> </div> " +
                            "<div class=\"gratitudes__input-wrap\"> <input class=\"gratitudes__input\" type=\"radio\" name=\"mood\" value=\"fire\"> " +
                            "<img class=\"gratitudes__radio-img\" src=\"/upload/images/mood/fire.png\" width=\"40\" height=\"40\" alt=\"good\"> </div> </div> " +
                            "<button class=\"sidebar-button gratitudes__input-button gratitudes__send-change-form\"> <span class=\"sidebar-button-top\">" +
                            "<span class=\"corner left\"></span><span class=\"corner right\"></span></span> <span class=\"sidebar-button-content\">" +
                            "<span class=\"sidebar-button-content-inner\"> <i class=\"sidebar-button-accept\"></i><b class=\"gratitudes__button-text\">�������� �������������</b></span></span> " +
                            "<span class=\"sidebar-button-bottom\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> </button> </div> </form> </div> </div>");

                    },
                    onfailure: function (data) {
                        console.log("������ AJAX",data);
                    }
                });

            }

        }


        /**---------------------------------------------------------------------------------------------------------*/
        /** ������������� ���������� �������� ������������� �� ������ "�������"*/
        $(".gratitudes").click(f_delGratitude);

        /**---------------------------------------------------------------------------------------------------------*/
        /** ������������� ���������� ������� �� �������� ����� �������������� ������������� �� ����� �� "��������"*/
        $(".gratitudes").click(f_openChangeGratitudeForm);

        /**---------------------------------------------------------------------------------------------------------*/
        /** ������������� ���������� ������� �� �������� ����� �������������� ������������� �� ����� �� "�������� �������������"*/
        $(".gratitudes").click(f_sendChangeGratitudeForm);

        /**---------------------------------------------------------------------------------------------------------*/
        /** ������������� ���������� ������� �� ���������� ������������� �� ����� �� "�������� �������������"*/
        $(".gratitudes__add-wrap").click(f_addGratitude);


    })();

</script>
