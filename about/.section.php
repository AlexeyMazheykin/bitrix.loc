
<?
$sSectionName = "testadminpanel";
$arDirProperties = Array(
   "description" => "О компании",
   "keywords" => "Лучшая компания в жизни",
   "TITLE" => "О нас"
);

/** 1)
 * Когда нужно вывести этот заголовок, используем в целевом метсе метод ShowTitle(), а когда вывести заголовок, заданный методом SetTitle(), нужно пользоваться методом
 *ShowTitle( false ), если задавать методом SetPageProperty('TITLE', .....)(самый надежный метод), то можно тоже без false
 *
 *
 */
?>