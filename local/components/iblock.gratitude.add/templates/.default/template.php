<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
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
                            <button class="sidebar-button gratitudes__item-btn ">
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

                            <form action="http://<?= $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurUri() ?>"
                                  method="post"
                                  class="" id="delForm">
                                <input hidden name="type" value="delGratitude">
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
                                  class="gratitudes__update-form display-none">
                                <input hidden name="type" value="updateGratitude">
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

                                    <button class="sidebar-button gratitudes__input-button">
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
                  class="gratitudes__add-form">
                <input hidden name="type" value="addGratitude">
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

                    <button class="sidebar-button gratitudes__input-button">
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

<style>
    .gdparent {
        margin: 20px 0 0 0;
    }

    .gratitudes__wrap {
        width: 100%;
        margin: 26px 0 10px 0;
    }

    .gratitudes {
        min-width: 600px;
    }

    .gratitudes__radio {
        display: flex;
    }

    .gratitudes__input-wrap {
        position: relative;
        box-sizing: border-box;
        margin-right: 10px;
        height: 40px;
        width: 40px;
    }

    .gratitudes__input {
        width: 40px;
        height: 40px;
        margin: 0 0;
        border: none;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 10;
        opacity: 0;
    }

    .gratitudes__item {
        position: relative;
        margin: 5px 0 5px 0;
        padding: 5px 10px;
    }

    .gratitudes__item:nth-child(even) {
        background-color: #f0f0f0;
    }

    .gratitudes__item-title {
        display: flex;
        align-items: center;
    }

    .gratitudes__item-img {
        margin-right: 20px;
    }

    .gratitudes__item-date {
        color: #606060;
        margin: 0 0 0 auto;
    }

    button.gratitudes__item-btn,
    button.gratitudes__del-item-btn{
        border: none;
        margin: 0 0 0 10px;
        padding: 0 0;
        max-width: 100px;
    }

    button.gratitudes__item-btn b,
    button.gratitudes__del-item-btn b{
        margin: 0;
    }

    .gratitudes__item-body {
        text-indent: 20px;
        padding: 5px 0 0 0;
    }

    .gratitudes__radio-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0.5;
        z-index: 5;
        box-sizing: border-box;
    }

    .gratitudes__input:checked ~ .gratitudes__radio-img {
        opacity: 1;
    }

    .gratitudes__input:focus ~ .gratitudes__radio-img {
        opacity: 1;
    }

    .gratitudes__update-form {
        /*display: none;*/
        margin: 0 0 5px 0;
    }

    .gratitudes__form-bottom {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    button.gratitudes__input-button {
        border: none;
        margin: 0 0;
        padding: 0 0;
        min-width: 125px;
    }

    button .sidebar-button-content-inner {
        padding: 5px 10px 5px 0;
    }

    .gratitudes__button-text {
        padding: 2px 0 0 0;
    }

    .gratitudes__form-bottom .sidebar-button-content-inner b {
        margin: 0 0;
    }

    .gratitudes__form-textarea {
        color: #555;
        border: 1px solid #91cef4 !important;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 17px;
        position: relative;
        height: 70px;
        width: 97%;
        resize: vertical;
    }

    .gratitudes__form-textarea_update {
        width: 90%;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .display-none {
        display: none;
    }

    .gratitudes__show-all-wrap {
        display: flex;
        justify-content: center;
        margin: 10px 0 0 0;
    }

    b.gratitudes__show-all-text {
        margin: 0 0 0 0;
        text-align: center;
    }

</style>

<? /**------------------------------------------------------------------------------------------------------------*/
/** Скрипт для гаджета благодарности */
?>
<script>

    /**-------------------------------------------------------------------------------------------------------------*/
    /**Функция отображения таблицы изменения комментария*/
    (function () {

        function f_changeGratitude(event) {
            //Проверяем, по какой кнопке "Изменить" кликнули
            let target = event.target;
            let updateBtn = target.closest("button.gratitudes__item-btn");

            if (updateBtn !== null) {
                if (updateBtn.tagName !== "BUTTON") return;

                //получаем родительскую обертку благодарности
                let gratitudeWrap = target.closest("div.gratitudes__item");

                //Инзменяем видимость формы редактирования благодарности
                let updateForm = $(gratitudeWrap).find("form.gratitudes__update-form");
                $(updateForm).toggleClass("display-none");
            }

        }
        function successDelElement (data){
            alert(data);
        }

        function errorDelElement (){
            alert("Произошла ошибка");
        }

        function f_delGratitude(event) {
            event.preventDefault();
            //Проверяем, по какой кнопке "Удалить" кликнули
            let target = event.target;
            let delBtn = target.closest("button.gratitudes__del-item-btn");

            if (delBtn !== null) {
                if (delBtn.tagName !== "BUTTON") return;

                //получаем родительскую обертку благодарности
                let delForm = target.closest("form#delForm");

                //Получаем из скрытого инпута тип тействия
                let operationType = $(delForm).children("input[name='type']");

                //Получаем из скрытого инпута id элемента инфоблока на удаление
                let elementID = $(delForm).children("input[name='elementID']");

                //$.ajax({
                //    url:"<?//=urlencode($templateFolder.'/ajax.php');?>//",
                //    type:"POST",
                //    data:({"operationType":operationType,"elementID":elementID,}),
                //    dataType:"html",
                //    success: successDelElement,
                //    error: errorDelElement,
                //});

                BX.ajax({
                    url: '<?=urlencode($templateFolder.'/ajax.php');?>',
                    data: {'val1':'value', 'val2':'value2'},
                    method: 'POST',
                    dataType: 'html',
                    timeout: 30,
                    async: true,
                    processData: true,
                    scriptsRunFirst: true,
                    emulateOnload: true,
                    start: true,
                    cache: false,
                    onsuccess: function(data){
                        console.log(data);
                    },
                    onfailure: function(){
                        console.log("Ошибка AJAX");
                    }
                });


            }

        }

        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик событий на блок благодарностей*/
        $(".gratitudes").click(f_changeGratitude);

        /**---------------------------------------------------------------------------------------------------------*/
        /** Устанавливаем обработчик удаления благодарности на кнопку "Удалить"*/
        $(".gratitudes").click(f_delGratitude);


    })();

</script>
