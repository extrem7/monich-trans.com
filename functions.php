<?

require_once "app/Theme.php";

function app()
{
    return Theme::getInstance();
}

app();
