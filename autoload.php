<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! function_exists( 'FluentFormMauticAutoload' ) ) {

    function FluentFormMauticAutoload( $class ) {

        // Do not load unless in plugin domain.
        $namespace = 'FluentFormMautic';
        if ( strpos( $class, $namespace ) !== 0 ) {
            return;
        }

        // Remove the root namespace.
        $unprefixed = substr( $class, strlen( $namespace ) );

        // Build the file path.
        $file_path = str_replace( '\\', DIRECTORY_SEPARATOR, $unprefixed );

        $file      = dirname( __FILE__ ) . $file_path . '.php';
        if ( file_exists( $file ) ) {
            require $file;
        }
    }
    // Register the autoloader.
    spl_autoload_register( 'FluentFormMauticAutoload' );
}
