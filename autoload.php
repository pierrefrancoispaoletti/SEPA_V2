<?php

function autoload($classe)
{
    if (file_exists("classes/$classe.php"))
        require_once "classes/$classe.php";

    if (file_exists("classes/abstracts/$classe.php"))
        require_once "classes/abstracts/$classe.php";

    if (file_exists("classes/formatter/$classe.php"))
        require_once "classes/formatter/$classe.php";

    if (file_exists("classes/format/$classe.php"))
        require_once "classes/format/$classe.php";

    if (file_exists("classes/exporter/$classe.php"))
        require_once "classes/exporter/$classe.php";

    require_once "vendor/autoload.php";
}

spl_autoload_register("autoload");
