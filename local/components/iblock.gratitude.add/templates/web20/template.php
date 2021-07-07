<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? // Получаем входящие данные
$arGratitudes = $arResult["arGratitudes"];
$showAllGratitude = $arResult["showAllGratitude"];
$gratitudeAmount = $arResult["gratitudeAmount"];
$currentUserID = $arResult["currentUserID"];
$userAuthorized = $arResult["userAuthorized"];
$gratitudeMoodImages = $arResult["gratitudeMoodImages"];
$profileID = $arResult["profileID"];
?>

<div class="gratitudes__wrap">

    <? // Блок отзывов ?>

    <div class="gratitudes">
        <? if (!isset($arGratitudes[0]) && count($arGratitudes) < 1): ?>

            <? //Благодарности отсутствуют ?>
            <h4 class="gratitudes__none">Отзывы отсутствуют...</h4>

        <? else: ?>

            <? // Цикл для отображения созданных благодарностей ?>

            <? foreach ($arGratitudes as $i => $gratitude): ?>


                <? // Если нет парамента "Показать все благодарности" то вывести только три
                if ($showAllGratitude !== "all" && $i >= $gratitudeAmount) {
                    break;
                } ?>

                <div class="gratitudes__item">

                    <? // Шапка благодарности (Иконка, Имя, Дата, Изменить) ?>
                    <div class="gratitudes__item-title">
                        <img class="gratitudes__item-img" src="/upload/images/mood/<?= $gratitude["FB_IMG"] ?>.png"
                             width="40" height="40" alt="<?= $gratitude["FB_IMG"] ?>">
                        <a class="gratitudes__item-name"
                           href="/company/personal/user/<?= $gratitude["FB_AUTHOR_ID"] ?>/"><?= $gratitude["FB_AUTHOR_NAME"] ?></a>
                        <div class="gratitudes__item-date">Дата
                            создания: <?= substr($gratitude["DATE_CREATE"], 0, 10) ?></div>

                        <? //Кнопка "Изменить" благодарность ?>
                        <? if (intval($gratitude["FB_AUTHOR_ID"]) === intval($currentUserID) && $userAuthorized): ?>
                            <button class="sidebar-button gratitudes__item-btn gratitudes__open-change-form">
                                <span class="sidebar-button-top"><span class="corner left"></span><span
                                            class="corner right"></span></span>
                                <span class="sidebar-button-content"><span
                                            class="sidebar-button-content-inner"><b>Изменить</b></span></span>
                                <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                            class="corner right"></span></span>
                            </button>
                        <? endif; ?>

                        <? //Кнопка "удалить" благодарность ?>
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
                                                class="sidebar-button-content-inner"><b>Удалить</b></span></span>
                                    <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                                class="corner right"></span></span>
                                </button>

                            </form>

                        <? endif; ?>

                    </div>


                    <div class="gratitudes__item-body">
                        <div class="gratitudes__item-text"><?= $gratitude["FB_TEXT"] ?></div>

                        <? // форма изменения благодарности ?>

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
                                                <i class="sidebar-button-accept"></i><b class="gratitudes__button-text">Изменить благодарность</b></span></span>
                                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                                    class="corner right"></span></span>
                                    </button>

                                </div>


                            </form>
                        <? endif; ?>

                    </div>

                </div>


            <? endforeach; ?>

            <? // Если нет парамента "Показать все благодарности" то вывести кнопку, показать все
            if ($showAllGratitude !== "all" && count($arGratitudes) > $gratitudeAmount):?>
                <div class="gratitudes__show-all-wrap">

                    <a class="sidebar-button gratitudes__show-all"
                       href="http://<?= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri("amo=all") ?>">
                        <span class="sidebar-button-top"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                        <span class="sidebar-button-content"><span class="sidebar-button-content-inner"><b
                                        class="gratitudes__show-all-text">Показать все благодарности</b></span></span>
                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                    </a>

                </div>

            <? endif; ?>

        <? endif; ?>


    </div>


    <? // Блок добавления новой благодарности ?>

    <? if ($profileID !== $currentUserID && $userAuthorized): ?>

        <div class="gratitudes__add-wrap">

            <h4 class="gratitudes__add-title">Добавить отзыв</h4>

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
                                        class="sidebar-button-create"></i><b class="gratitudes__button-text">Добавить благодарность</b></span></span>
                        <span class="sidebar-button-bottom"><span class="corner left"></span><span
                                    class="corner right"></span></span>
                    </button>

                </div>


            </form>

        </div>

    <? endif; ?>

</div>


<? /**------------------------------------------------------------------------------------------------------------*/
/** Скрипт для гаджета благодарности */
?>
<script>


    (function () {

        /**-------------------------------------------------------------------------------------------------------------*/
        /**Функция удаления благодарности*/

        function f_delGratitude(event) {

            //Проверяем, по какой кнопке  кликнули
            let target = event.target;
            let delBtn = target.closest("button.gratitudes__del-item-btn");

            let gratitudeItem = target.closest("div.gratitudes__item");

            // Производим отправку и удаление благодарности
            if (delBtn !== null) {
                if (delBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //получаем родительскую обертку благодарности
                let delForm = target.closest("form.delForm");

                //Получаем из скрытого инпута тип тействия
                let operationType = $(delForm).children("input[name='type']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id раздела в котором находится элемент
                let sectionID = $(delForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id элемента инфоблока на удаление
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
                        console.log("Ошибка AJAX");
                    }
                });

            }

        }


        /**-------------------------------------------------------------------------------------------------------------*/
        /**Функция отображения формы изменения благодарности*/

        function f_openChangeGratitudeForm(event) {
            //Проверяем, по какой кнопке "Изменить" кликнули
            let target = event.target;
            let updateBtn = target.closest("button.gratitudes__open-change-form");

            if (updateBtn !== null) {
                if (updateBtn.tagName !== "BUTTON") return;

                //получаем родительскую обертку благодарности
                let gratitudeWrap = target.closest("div.gratitudes__item");

                //Инзменяем видимость формы редактирования благодарности
                let updateForm = $(gratitudeWrap).find("form.gratitudes__update-form");
                $(updateForm).toggleClass("display-none");
            }

        }


        /**-------------------------------------------------------------------------------------------------------------*/
        /**Функция редактирования благодарности*/

        function f_sendChangeGratitudeForm(event) {

            //Проверяем, по какой кнопке  кликнули
            let target = event.target;
            let sendBtn = target.closest("button.gratitudes__send-change-form");

            let gratitudeItem = target.closest("div.gratitudes__item");

            // Производим отправку и изменяем благодарность
            if (sendBtn !== null) {
                if (sendBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //получаем родительскую обертку благодарности
                let delForm = target.closest("form.chageForm");

                //Получаем из скрытого инпута тип тействия
                let operationType = $(delForm).children("input[name='type']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id раздела в котором находится элемент
                let sectionID = $(delForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id элемента инфоблока на удаление
                let elementID = $(delForm).children("input[name='elementID']")["0"]["defaultValue"];

                //Получаем из инпута текст благодарности
                let gratitudeText = $(delForm).children("textarea[name='gratitude__text']")["0"]["value"];

                //Получаем из инпута название выбранной картинки
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
                        // Отображение нового текста благодарности
                        let textWrap = $(delForm).closest("div.gratitudes__item-body");
                        let textSpace = $(textWrap).children("div.gratitudes__item-text");
                        textSpace.html(data);

                        // Заменяем картинку благодарности
                        let gratitudeWrap = $(textWrap).closest("div.gratitudes__item");
                        let moodImg = $(gratitudeWrap).find("img.gratitudes__item-img");
                        moodImg.attr("src", "/upload/images/mood/" + mood + ".png");
                    },
                    onfailure: function () {
                        console.log("Ошибка AJAX");
                    }
                });

            }

        }

        /**-------------------------------------------------------------------------------------------------------------*/
        /**Функция добавления новой благодарности*/

        function f_addGratitude(event) {

            //Проверяем, по какой кнопке  кликнули
            let target = event.target;
            let addBtn = target.closest("button.gratitudes__add-input-button");

            let gratitudeAddWrap = target.closest("div.gratitudes__wrap");

            // Производим отправку
            if (addBtn !== null) {
                if (addBtn.tagName !== "BUTTON") return;

                event.preventDefault();

                //получаем родительскую обертку формы благодарности
                let addForm = target.closest("form#addForm");

                //Получаем из инпута текст благодарности
                let gratitudeText = $(addForm).children("textarea[name='gratitude__text']")["0"]["value"];

                //Получаем из инпута название выбранной картинки
                let mood = $(addForm).find("input[name='mood']:checked")["0"]["defaultValue"];

                //Получаем из скрытого инпута тип тействия
                let operationType = $(addForm).children("input[name='type']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id инфоблока
                let parentBlock = $(addForm).children("input[name='parentBlock']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id раздела в котором находится элемент
                let sectionID = $(addForm).children("input[name='sectionID']")["0"]["defaultValue"];

                //Получаем из скрытого инпута id инфоблока
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

                        // очищаем форму создания новой благодарности.
                        $(addForm).children("textarea[name='gratitude__text']")["0"]["value"] = "";

                        let newIDGratitude = data[0];
                        let newTextGratitude = data[1];

                        // Отображение нового текста благодарности
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
                            "Дата создания: " +
                            "<?=$arResult["currentDate"]?>" +
                            "</div> " +
                            "<button class=\"sidebar-button gratitudes__item-btn gratitudes__open-change-form\"> " +
                            "<span class=\"sidebar-button-top\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> " +
                            "<span class=\"sidebar-button-content\"><span class=\"sidebar-button-content-inner\"><b>" + "Изменить" +
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
                            "<span class=\"sidebar-button-content\"><span class=\"sidebar-button-content-inner\"><b>Удалить</b></span></span> " +
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
                            "<span class=\"sidebar-button-content-inner\"> <i class=\"sidebar-button-accept\"></i><b class=\"gratitudes__button-text\">Изменить благодарность</b></span></span> " +
                            "<span class=\"sidebar-button-bottom\"><span class=\"corner left\"></span><span class=\"corner right\"></span></span> </button> </div> </form> </div> </div>");

                    },
                    onfailure: function (data) {
                        console.log("Ошибка AJAX",data);
                    }
                });

            }

        }


        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик удаления благодарности на кнопку "Удалить"*/
        $(".gratitudes").click(f_delGratitude);

        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик событий на открытие формы редактирования благодарности по клину на "Изменить"*/
        $(".gratitudes").click(f_openChangeGratitudeForm);

        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик событий на отправку формы редактирования благодарности по клину на "Изменить благодарность"*/
        $(".gratitudes").click(f_sendChangeGratitudeForm);

        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик событий на добавление длагодарности по клину на "Добавить благодарность"*/
        $(".gratitudes__add-wrap").click(f_addGratitude);


    })();

</script>
