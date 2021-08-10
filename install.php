<?php
    if ( !file_exists( './smarty/libs/Smarty.class.php' ) ) {
        die( 'Smarty Templates are not setup properly.' );
    }
    require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';
    require_once( './smarty/libs/Smarty.class.php' );

    $smarty = new Smarty();
    if ( ! $_POST ) {
        $smarty->assign( 'title', "Localhost Links" );
        $smarty->assign( 'loggedin', false );
        $smarty->display( 'install.tpl' );
        exit();
    }
    