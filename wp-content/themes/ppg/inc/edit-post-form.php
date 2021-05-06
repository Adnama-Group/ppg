<?php
    $edit_post = add_query_arg( 'post', get_the_ID(), get_permalink( 61 + $_POST['_wp_http_referer'] ) );
?>
