<?php
/*
  Plugin Name: CustomIndexBanner
  Plugin URI:
  Description: indexページに表示可能なバナーの設定
  Version: 1.0.0
  Author: Tomoaki TANAKA
  Author URI: https://github.com/TomoakiTANAKA/CustomIndexBanner
  License: GPLv2
 */

add_action('init', 'CustomIndexBanner::init');

class CustomIndexBanner
{
    static function init()
    {
        return new self();
    }

    function __construct()
    {
        if (is_admin() && is_user_logged_in()) {
            // メニュー追加
            add_action('admin_menu', [$this, 'set_plugin_menu']);
            add_action('admin_sub_menu', [$this, 'set_plugin_sub_menu']);

        }
    }

    function set_plugin_menu()
    {
        add_menu_page(
            'カスタムバナー',           /* ページタイトル*/
            'カスタムバナー',           /* メニュータイトル */
            'manage_options',         /* 権限 */
            'custom-index-banner',    /* ページを開いたときのURL */
            [$this, 'show_about_plugin'],       /* メニューに紐づく画面を描画するcallback関数 */
            'dashicons-format-gallery', /* アイコン see: https://developer.wordpress.org/resource/dashicons/#awards */
            99                          /* 表示位置のオフセット */
        );
    }
    function set_plugin_sub_menu() {

        add_submenu_page(
            'es-custom-index',  /* 親メニュー */
            '設定',
            '設定',
            'manage_options',
            'custom-index-banner-config',
            [$this, 'show_config_form']);
    }

} // end of class
?>

