<?php
if (!defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$arComponentParameters = [
    "GROUPS" => [
        "BASE" => [
            "NAME" => GetMessage( "MAZHEYKIN_MYCOMP_BASE_NAME" ),
            "SORT" => 100
        ],
        "LINERUN" => [
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_LINERUN_NAME"),
            "SORT" => 200
        ],
        "JQUERY" => [
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_JQUERY_NAME"),
            "SORT" => 300,
        ],
        "BOOTSTRAP" => [
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_BOOTSTRAP_NAME"),
            "SORT" => 300,
        ],
    ],
    "PARAMETERS" => [
        "DATA_FINISH" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_DATA_FINISH"),
            "TYPE"=> "STRING"
        ],

        "TEXT_FINISH" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_TEXT_FINISH"),
            "TYPE"=> "STRING"
        ],
        "TEXT_NOT_FINISH" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_TEXT_NOT_FINISH"),
            "TYPE"=> "STRING"
        ],
        "ONLY_HOME" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_ONLY_HOME"),
            "TYPE"=> "CHECKBOX",
            "DEFAULT" => "N"
        ],
        "USE_LINE_RUN" => [
            "PARENT" => "LINERUN",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_USE_LINE_RUN"),
            "TYPE"=> "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y"
        ],
        "USE_JQUERY" => [
            "PARENT" => "JQUERY",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_USE_JQUERY"),
            "TYPE"=> "CHECKBOX",
            "DEFAULT" => "N",
        ],
        "USE_BOOTSTRAP" => [
            "PARENT" => "BOOTSTRAP",
            "NAME" => GetMessage("MAZHEYKIN_MYCOMP_USE_BOOTSTRAP"),
            "TYPE"=> "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y"
        ],

    ]
];

if ($arCurrentValues["USE_LINE_RUN"] === "Y") {
    $arComponentParameters["PARAMETERS"]["LINE_TEXT_SPEED"] = [
        "PARENT" => "LINERUN",
        "NAME" => GetMessage("MAZHEYKIN_MYCOMP_LINE_RUN_TEXT_SPEED"),
        "TYPE" => "STRING",
        "DEFAULT"=> 30,
    ];
}
if ($arCurrentValues["USE_BOOTSTRAP"] === "Y") {
    $arComponentParameters["PARAMETERS"]["USE_BOOTSTRAP_v3"] = [
        "PARENT" => "BOOTSTRAP",
        "NAME" => GetMessage("MAZHEYKIN_MYCOMP_USE_BOOTSTRAP_v3"),
        "TYPE" => "CHECKBOX",
        "DEFAULT"=> "N",
    ];
    $arComponentParameters["PARAMETERS"]["USE_BOOTSTRAP_v4"] = [
        "PARENT" => "BOOTSTRAP",
        "NAME" => GetMessage("MAZHEYKIN_MYCOMP_USE_BOOTSTRAP_v4"),
        "TYPE" => "CHECKBOX",
        "DEFAULT"=> "N",
    ];
}
