<?php 
/*
Template Name:Page wth Cat Posts
*/
?>
<?php get_header(); ?>
	<div id="content">
    	<div class="content_wrap">
            <div class="content_wrap">
            	<div id="posts">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if (get_option('simplepress_integration_single_top') <> '' && get_option('simplepress_integrate_singletop_enable') == 'on') echo(get_option('simplepress_integration_single_top')); ?>
					<?php $thumb = '';
                    $width = 182;
                    $height = 182;
                    $classtext = '';
                    $titletext = get_the_title();
                    $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                    $thumb = $thumbnail["thumb"]; 
                    $categoryslug = $post->post_name;
                   
                    ?>
                    <h2 style="margin-top: 20px;"><?php the_title(); ?></h2>
                    <br class="clear" />
                    <div class="post">
                        <?php if ($thumb <> '' && get_option('simplepress_page_thumbnails') == 'on') { ?>
                        <div class="thumb">
                            <div>
                                <span class="image" style="background-image: url(<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext, true, true); ?>);">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/thumb-overlay.png" alt="" />
                                </span>
                            </div>
                            <span class="shadow"></span>
                        </div>
                        <?php }; ?>
                                <?php the_content(''); ?>
                            <br class="clear" />
                            <?php edit_post_link(esc_html__('Edit this page','SimplePress')); ?>
                    <?php if (get_option('simplepress_integration_single_bottom') <> '' && get_option('simplepress_integrate_singlebottom_enable') == 'on') echo(get_option('simplepress_integration_single_bottom')); ?>
                    <?php if (get_option('simplepress_468_enable') == 'on') { ?>
                        <?php if(get_option('simplepress_468_adsense') <> '') echo(get_option('simplepress_468_adsense'));
                        else { ?>
                            <a href="<?php echo esc_url(get_option('simplepress_468_url')); ?>"><img src="<?php echo esc_url(get_option('simplepress_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
                        <?php } ?>	
                    <?php } ?>
                    </div><!-- .post -->  
				<?php if (get_option('simplepress_show_pagescomments') == 'on') comments_template('', true); ?>
				<?php endwhile; endif; ?>
                <div class="blog-roll">
                       <?   
                        $cat = get_category_by_slug($categoryslug);
                        $catID = $cat->term_id;
                        $args = array('category'=> $catID);
                        $posts_array = get_posts( $args ); 
                        
                        foreach ($posts_array as $POST) {

                           $items = <<<BLOCK
<hr style="margin: 10px 30px;">
<div id="post-$POST->ID" class="post">
<h3>$POST->post_title</h3>
<p><small>Date: <em>$POST->post_date<em></small></p>
<p>$POST->post_excerpt</p>
<a href="$POST->guid">» Read more about "$POST->post_title"</a>
</div>


BLOCK;
echo $items;
                            }
                       ?>
                </div>


                </div><!-- #posts -->  
				<?php get_sidebar(); ?>
            </div><!-- .content_wrap --> 
        </div><!-- .content_wrap --> 
    </div><!-- #content --> 
</div><!-- .wrapper --> 
<?php get_footer(); ?>