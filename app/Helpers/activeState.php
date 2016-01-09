<?php

if ( ! function_exists('setActive')) {
    function setActive($path, $active = ' active') {
		return  Request::is($path) ? $active : '';

    }
}

if ( ! function_exists('setActiveTree')) {
    function setActiveTree($path, $active = ' active') {
        if( Request::segment(1) === $path) {
            return $active;
        }
        return '';
    }
}
