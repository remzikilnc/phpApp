<?php


require_once 'System/Helper/Functions.php';
$param = $_GET['params'];
if (str_starts_with($param, 'api')) {
    include_once ROOT_PATH . "/routes/api.php";
} else {
    /**
     * Error Catching, Prepare Logging
     */
    function shutdownFunction(): void
    {
        $error = error_get_last();
        if ($error['type'] === E_ERROR) {

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $txt = "\nDate : " . date("d.m.Y H:i:s");
            $txt .= "\nFile : " . $error["file"];
            $txt .= "\nLine : " . $error["line"];
            $txt .= "\nMessage : " . $error["message"];
            $txt .= "\nIP : " . $ip;
/*            $txt .= "\nUser: " . (\App\System\Helper\Session::get('userName') ? \App\System\Helper\Session::get('userName') : 'Guest');*/
            $txt .= "\n";

/*            if (writeLog("report", $txt)) {
                ob_clean();
                include 'Themes/500.php';
                exit();
            }*/
            print_r($txt);
        }
    }
    register_shutdown_function("shutdownFunction");

    /**
     * General
     */
    include_once ROOT_PATH . "/routes/web.php";
}