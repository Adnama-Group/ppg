<?php

function renderListingIcons( $array ) {
    $awards = [];
    if(is_string($array)) {
        $awards = explode(', ', $array);
    }
    $list = '';
    $list .= '<ul>';
    foreach($awards as $icon) {
        $icon_class = strtolower(str_replace(' ', '-', $icon));
        $list .= '<li class="' . $icon_class . '"><span class="additional-service-image"><img src="'. get_stylesheet_directory_uri() . '/img/icons-png/' . $icon_class . '.png" alt="'. $icon .' Icon" /></span> <span class="additional-service-content">'. $icon . '</span></li>';
    }
    $list .= '</ul>';
    return $list;
}