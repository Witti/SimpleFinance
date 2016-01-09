<?php

if ( ! function_exists('setActive')) {
    /**
     * Gravatar URL from Email address
     *
     * @param string $email Email address
     * @param string $size Size in pixels
     * @param string $default Default image [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Max rating [ g | pg | r | x ]
     *
     * @return string
     */
    function function setActive($path, $active = 'active') {
		return  Request::is($path) ? $active : '';
    }
}
