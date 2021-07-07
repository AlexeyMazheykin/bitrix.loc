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

    /**---------------------------------------------------------------------------------------------------------*/
    /** Устанавливаем обработчик событий на блок благодарностей*/
    $(".gratitudes").click(f_changeGratitude);

})();