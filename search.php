<?php get_header();

if ( is_search() ) { ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-4' ); ?>>
        <header class="entry-header mb-4">
            <?php the_title( sprintf( '<h2 class="heading-4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    </article>

<?php } else {

    the_content(); 

    get_template_part( '/template-parts/block-support' );

}
get_footer()
?>