<?php
$query = new WP_Query(['post_type' => 'cit_project']);
if ($query->have_posts()) {
    echo '<ul>';
    while ($query->have_posts()) {
        $query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }
    echo '</ul>';
}
wp_reset_postdata();
