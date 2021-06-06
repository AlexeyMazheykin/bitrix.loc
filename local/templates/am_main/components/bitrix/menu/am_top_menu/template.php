<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?php

//dd ($arResult);
    ?>


    <div class="header-main-menu hidden-xs">
        <nav id="primary-menu">
            <ul class="main-menu text-right">
                <?php
                foreach ($arResult as $item) :
                    $color = null;
                    if ($item['SELECTED']) {
                        $color = 'color: #03A9F4';
                    }
                    ?>
                <li>
                    <a href="<?=$item['LINK']?>" style="<?=$color?>" ><?=$item['TEXT']?></a>
                </li>
                <?php endforeach;?>
            </ul>
        </nav>
    </div>



<?endif?>

<!--<li>
    <a href="services.html"> Услуги
        <span class="indicator"><i class="fa fa-angle-down"></i></span></a>
    <ul class="dropdown">
        <li>
            <a href="services_landing.html">Лендинг</a>
        </li>
        <li>
            <a href="services_online_shop.html">Интернет-магазин</a>
        </li>
    </ul>
</li>
-->