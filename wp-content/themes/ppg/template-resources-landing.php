<?php
/*
Template name: Resources
*/
get_header();

/*
    post categories: obtained from https://harborsocial.wpengine.com/wp-admin/post.php?post=153&action=edit
    by clicking "Section settings" icon (gear icon) next to "Blog"
    1. Pet Planning ("Research" on front end): 8
    2. Pet Care ("Health and safety"): 17
    3. Lifestyle: 20
    4. Pet Products: 562
*/

$catCatId = 0;
$catAll = false;

if(preg_match('/\/pet-planning\//',$_SERVER['REQUEST_URI'])){
    $catId = array(8);
    $catCatId = 8;
} else if(preg_match('/\/health-and-safety\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
    $catId = array(17);
    $catCatId = 17;
} else if(preg_match('/\/lifestyle\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
    $catId = array(20);
    $catCatId = 20;
} else if(preg_match('/\/pet-products\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
    $catId = array(562);
    $catCatId = 562;
} else {
    $catId = array(8,562,17,20);
    $catAll = true;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'=> 'post',
    'orderby'    => 'date',
    'post_status' => 'publish',
    'order'    => 'DESC',
    'paged' =>$paged,
    'category__in' => $catId,
    //'cat' => $catId,
    'posts_per_page' => 9 // this will retrive all the post that is published 
);
if($catAll){
    $args = array(
        'post_type'=> 'post',
        'orderby'    => 'date',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'paged' =>$paged,
        //'cat' => $catId,
        'posts_per_page' => 9 // this will retrive all the post that is published 
    );   
}

$result = new WP_Query( $args );
// $posts = $result->posts;
?>

<section id="primary" class="content-area col-sm-12">
    <div id="main" class="site-main posts" role="main">

        <div class="posts__featured">
            <div class="container">
                <div class="row">
                    <?php
                        $featured_first_post_id = $result->posts[0]->ID;
                        if(isset($result->posts[0]->post_title)&&!empty($result->posts[0]->post_title)) : ?>
                        <div class="col-lg-8">
                            <article class="post post--bg-image">
                                <a class="post__image" href="<?= get_permalink($featured_first_post_id); ?>">
                                    <?php
                                        $main_image = get_field('main_image', $featured_first_post_id);
                                        if( !empty($main_image['url']) ) {
                                            echo "<img src='" . $main_image['url'] . "' />";
                                        } else {
                                            echo get_the_post_thumbnail($featured_first_post_id, 'medium');
                                        };
                                    ?>
                                </a>
                                <div class="post__cat">
                                    <a href="<?= getResourceLink($featured_first_post_id); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($featured_first_post_id))); ?> post__cat-button'><?= getResourceCategory($featured_first_post_id);?></a>
                                </div>
                                <div class="post__meta">
                                    <h2 class="post__title"><a href="<?= get_permalink($featured_first_post_id); ?>"><?= get_the_title($featured_first_post_id);?></a></h2>
                                    <!-- <time class="post__date" datetime="<?= get_the_date('c', $featured_first_post_id); ?>"><?= get_the_date('F d, Y', $featured_first_post_id); ?></time> -->
                                    <div class="post__content">
                                        <p><?= wp_trim_words( get_the_content(null, false, $featured_first_post_id) ); ?></p>
                                        <p><a class="text--uppercase text--red" href="<?= get_permalink($featured_first_post_id); ?>">Read More</a></p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endif;?>

                    <div class="col-lg-4">
                        <?php
                            $featured_second_post_id = $result->posts[1]->ID;
                            if(isset($result->posts[1]->post_title)&&!empty($result->posts[1]->post_title)) : ?>
   
                            <article class="post post--bg-image">
                                <a class="post__image" href="<?= get_permalink($featured_second_post_id); ?>">
                                    <?php
                                        $main_image = get_field('main_image', $featured_second_post_id);
                                        if( !empty($main_image['url']) ) {
                                            echo "<img src='" . $main_image['url'] . "' />";
                                        } else {
                                            echo get_the_post_thumbnail($featured_second_post_id, 'large');
                                        };
                                    ?>
                                </a>
                                <div class="post__cat">
                                    <a href="<?= getResourceLink($featured_second_post_id); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($featured_second_post_id))); ?> post__cat-button'><?= getResourceCategory($featured_second_post_id);?></a>
                                </div>
                                <div class="post__meta">
                                    <h2 class="post__title"><a href="<?= get_permalink($featured_second_post_id); ?>"><?= get_the_title($featured_second_post_id);?></a></h2>
                                    <!-- <time class="post__date" datetime="<?= get_the_date('c', $featured_second_post_id); ?>"><?= get_the_date('F d, Y', $featured_second_post_id); ?></time> -->
                                    <div class="post__content">
                                        <p><?= wp_trim_words( get_the_content(null, false, $featured_second_post_id) ); ?></p>
                                        <p><a class="text--uppercase text--red" href="<?= get_permalink($featured_second_post_id); ?>">Read More</a></p>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>

                        <?php
                            $featured_third_post_id = $result->posts[2]->ID;
                            if(isset($result->posts[2]->post_title)&&!empty($result->posts[2]->post_title)) : ?>
   
                            <article class="post post--bg-image">
                                <a class="post__image" href="<?= get_permalink($featured_third_post_id); ?>">
                                    <?php
                                        $main_image = get_field('main_image', $featured_third_post_id);
                                        if( !empty($main_image['url']) ) {
                                            echo "<img src='" . $main_image['url'] . "' />";
                                        } else {
                                            echo get_the_post_thumbnail($featured_third_post_id, 'large');
                                        };
                                    ?>
                                </a>
                                <div class="post__cat">
                                    <a href="<?= getResourceLink($featured_third_post_id); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($featured_third_post_id))); ?> post__cat-button'><?= getResourceCategory($featured_third_post_id);?></a>
                                </div>
                                <div class="post__meta">
                                    <h2 class="post__title"><a href="<?= get_permalink($featured_third_post_id); ?>"><?= get_the_title($featured_third_post_id);?></a></h2>
                                    <!-- <time class="post__date" datetime="<?= get_the_date('c', $featured_third_post_id); ?>"><?= get_the_date('F d, Y', $featured_third_post_id); ?></time> -->
                                    <div class="post__content">
                                        <p><?= wp_trim_words( get_the_content(null, false, $featured_third_post_id) ); ?></p>
                                        <p><a class="text--uppercase text--red" href="<?= get_permalink($featured_third_post_id); ?>">Read More</a></p>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
                            
        <!-- feature posts END -->
        <?php
            //if(isset($result->posts[3]->post_title)&&!empty($result->posts[3]->post_title)){
        ?>
        <!-- cats and tags START -->
        <div class="posts__cat">
            <div class="container" id="cats_tags">
                <div class="text-center d-flex flex-wrap justify-content-around justify-content-lg-between" id="post_terms">
                    <button type="button" class="button button--default <?php echo $catCatId==0?'hover':'';?>">
                        <a href="/all-articles/">All</a>
                    </button>       
                    <button type="button" class="button button--default <?php echo $catCatId==8?'hover':'';?>">
                        <a href="/pet-planning/">Pet Planning</a>
                    </button>       
                    <button type="button" class="button button--default <?php echo $catCatId==17?'hover':'';?>">
                        <a href="/health-and-safety/">Health and safety</a>
                    </button>       
                    <button type="button" class="button button--default <?php echo $catCatId==20?'hover':'';?>">
                        <a href="/lifestyle/">Lifestyle</a>
                    </button>       
                    <button type="button" class="button button--default <?php echo $catCatId==562?'hover':'';?>">
                        <a href="/pet-products/">Pet products</a>
                    </button>       
                </div>
            </div>
        </div>
        <!-- cats and tags END -->
        <?php
            //}
        ?>
        <div class="posts__additional">
            <div class="container add_posts">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- two per row START -->
                        <div class="row">
                            <?php if(isset($result->posts[3]->post_title)&&!empty($result->posts[3]->post_title)): ?>
                                <div class="col-md-6 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[3]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[3]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[3]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[3]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[3]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[3]->ID); ?>"><?= get_the_title($result->posts[3]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[3]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[3]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[3]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[3]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($result->posts[4]->post_title)&&!empty($result->posts[4]->post_title)): ?>
                                <div class="col-md-6 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[4]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[4]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[4]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[4]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[4]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[4]->ID); ?>"><?= get_the_title($result->posts[4]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[4]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[4]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[4]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[4]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- two per row END -->
                        <!-- one per row START -->
                        <div class="row">
                            <?php if(isset($result->posts[5]->post_title)&&!empty($result->posts[5]->post_title)): ?>
                                <div class="col-md-12 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[5]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[5]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[5]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[5]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[5]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[5]->ID); ?>"><?= get_the_title($result->posts[5]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[5]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[5]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[5]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[5]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- one per row END -->                    
                        <!-- two per row START -->
                        <div class="row">
                            <?php if(isset($result->posts[6]->post_title)&&!empty($result->posts[6]->post_title)) : ?>
                                <div class="col-md-6 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[6]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[6]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[6]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[6]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[6]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[6]->ID); ?>"><?= get_the_title($result->posts[6]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[6]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[6]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[6]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[6]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>  
                            <?php endif; ?>

                            <?php if(isset($result->posts[7]->post_title)&&!empty($result->posts[7]->post_title)) : ?>
                                <div class="col-md-6 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[7]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[7]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[7]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[7]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[7]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[7]->ID); ?>"><?= get_the_title($result->posts[7]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[7]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[7]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[7]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[7]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div> 
                            <?php endif; ?>
                        </div>
                        <!-- two per row END -->     
                        <!-- one per row START -->
                        <div class="row">
                            <?php if(isset($result->posts[8]->post_title)&&!empty($result->posts[8]->post_title)) : ?>
                                <div class="col-md-12 mb-5">
                                    <article class="post post--condensed">
                                        <a class="post__image" href="<?= get_permalink($result->posts[8]->ID); ?>">
                                            <img src="<?= get_the_post_thumbnail_url($result->posts[8]->ID, 'large'); ?>" />
                                        </a>
                                        <div class="post__cat">
                                            <a href="<?= getResourceLink($result->posts[8]->ID); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($result->posts[8]->ID))); ?> post__cat-button'><?= getResourceCategory($result->posts[8]->ID);?></a>
                                        </div>
                                        <div class="post__meta">
                                            <h2 class="post__title"><a href="<?= get_permalink($result->posts[8]->ID); ?>"><?= get_the_title($result->posts[8]->ID);?></a></h2>
                                            <!-- <time class="post__date" datetime="<?= get_the_date('c', $result->posts[8]->ID); ?>"><?= get_the_date('F d, Y', $result->posts[8]->ID); ?></time> -->
                                            <div class="post__content">
                                                <p><?= wp_trim_words( get_the_content(null, false, $result->posts[8]->ID), 20 ); ?></p>
                                                <p><a class="text--uppercase text--red" href="<?= get_permalink($result->posts[8]->ID); ?>">Read More</a></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- one per row END -->
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center"> 
                        <?php 		
                            if($result->have_posts()) :
                            
                                $total_pages = $result->max_num_pages;
                            
                                if ($total_pages > 1){
                            
                                    $current_page = max(1, get_query_var('paged'));
                            
                                    echo paginate_links(array(
                                        'base' => get_pagenum_link(1) . '%_%',
                                        'format' => '/page/%#%',
                                        'current' => $current_page,
                                        'total' => $total_pages,
                                        'prev_text'    => __('< '),
                                        'next_text'    => __(' >'),
                                    ));
                                }
                            endif;
                        ?>                          
                                </div>
                            </div>
                        </div>        
                    </div>
                    <!-- right sidebar START-->
                    <div class="col-lg-4" id="right-side-bar">
                        <?php get_sidebar('resources'); ?>
                    </div>
                    <!-- right sidebar END-->
                </div>
            </div>  
        </div>
    </div><!-- #main -->
</section><!-- #primary -->
<?php
get_footer();