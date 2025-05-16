<?php

/**
 * Provides a markup for redirect loading screeen
 *
 * This file is used to markup the public view aspects of the plugin.
 * You can access all the required variables throught $_POST
 *
 * @link       http://pixel-industry.com/
 * @since      1.0.0
 *
 * @package    My_Mayan_Sign
 * @subpackage My_Mayan_Sign/public/views
 */

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php'); ?>

<style>
    .page-preloader {
        background-color: #fff;
        height: 100vh;
        width: 100%;
        z-index: 999999;
        position: fixed;
        top: 0;
        left: 0;
        opacity: 1;
        visibility: visible;
        -webkit-transition: .6s ease-in-out;
        -o-transition: .6s ease-in-out;
        transition: .6s ease-in-out;
        -webkit-transition-property: opacity, visibility;
        -o-transition-property: opacity, visibility;
        transition-property: opacity, visibility;
    }
    .page-preloader .loader {
        width: 6px;
        height: 6px;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-animation: typing 1s linear infinite alternate;
        animation: typing 1s linear infinite alternate;
    }
    .page-preloader .loader .la-dark {
        color: #eae8da;
    }
    .la-ball-beat,
    .la-ball-beat > div {
    position: relative;
    -webkit-box-sizing: border-box;
    box-sizing: border-box; }

    .la-ball-beat {
    display: block;
    font-size: 0;
    color: #fff; }

    .la-ball-beat.la-dark {
    color: #333; }

    .la-ball-beat > div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor; }

    .la-ball-beat {
    width: 54px;
    height: 18px; }

    .la-ball-beat > div {
    width: 10px;
    height: 10px;
    margin: 4px;
    -webkit-border-radius: 100%;
            border-radius: 100%;
    -webkit-animation: ball-beat .7s -.15s infinite linear;
    animation: ball-beat .7s -.15s infinite linear; }

    .la-ball-beat > div:nth-child(2n-1) {
    -webkit-animation-delay: -.5s;
    animation-delay: -.5s; }

    .la-ball-beat.la-sm {
    width: 26px;
    height: 8px; }

    .la-ball-beat.la-sm > div {
    width: 4px;
    height: 4px;
    margin: 2px; }

    .la-ball-beat.la-2x {
    width: 108px;
    height: 36px; }

    .la-ball-beat.la-2x > div {
    width: 20px;
    height: 20px;
    margin: 8px; }

    .la-ball-beat.la-3x {
    width: 162px;
    height: 54px; }

    .la-ball-beat.la-3x > div {
    width: 30px;
    height: 30px;
    margin: 12px; }

    /*
    * Animation
    */
    @-webkit-keyframes ball-beat {
    50% {
        opacity: .2;
        -webkit-transform: scale(0.75);
        transform: scale(0.75); }
    100% {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1); } }

    @keyframes ball-beat {
    50% {
        opacity: .2;
        -webkit-transform: scale(0.75);
        transform: scale(0.75); }
    100% {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1); } }
</style>
<div class="page-preloader" id="page-preloader">
    <div class="loader">
        <div class="la-ball-beat la-dark">
            <div></div>
            <div></div>
            <div></div>
        </div>	
    </div>
</div>
<script>window.location.href = "<?php echo $_POST['url']; ?>"</script>
