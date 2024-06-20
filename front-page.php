<?php get_header(); ?>

<div class="container my-28 mx-auto">

    <div>
        <h2 id="subtitle">Upcoming Fixtures</h2>
    </div>

    <div class="border border-black border-1">
        <?php
        // Query teams from the 'team' custom post type
        $team_query = new WP_Query(array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Retrieve all posts
        ));

        if ($team_query->have_posts()) :
            $counter = 0; // Counter to limit the number of teams displayed per row
            while ($team_query->have_posts()) : $team_query->the_post();
                // Increment counter
                $counter++;

                // Get team name and image
                $team_name = get_the_title();
                $team_image = get_the_post_thumbnail_url(); // Replace with the code to retrieve team image if available

                // Output team HTML
                ?>
                <?php if ($counter == 1) : ?>
                    <div class="flex flex-row justify-around">
                <?php endif; ?>

                <div class="flex flex-col">
                    <img class= "w-full h-full" src="<?php echo esc_url($team_image); ?>">
                    <h4><?php echo esc_html($team_name); ?></h4>
                </div>

                <?php if ($counter == 2) : ?>
                    </div>
                    <?php $counter = 0; // Reset counter ?>
                <?php endif; ?>

        <?php
            endwhile;

            // Reset post data
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <?php if (have_posts()) : ?>
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <?php get_template_part('template-parts/content', 'single'); ?>
            <?php if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
