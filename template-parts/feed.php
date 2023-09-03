<?php
function display_post_card($post_classes)
{
    ob_start(); // Start output buffering
?>
    <div class="<?php echo implode(' ', $post_classes) . ' ' . get_theme_mod('feed_image_postion'); ?>">
        <?php if (has_post_thumbnail() && get_theme_mod('feed_post_card_image')) { ?>
            <a class="imgA" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php } ?>
        <div class="textDiv">
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
            <span class="date"><?php the_date(); ?></span>
            <?php the_excerpt(); ?>
            <div class="tagsDiv">
                <?php
                if (get_theme_mod('feed_post_card_tags')) {
                    $tags = get_the_tags();
                    if ($tags) {
                        echo '<ul>';
                        foreach ($tags as $tag) {
                            $tag_link = get_tag_link($tag->term_id);
                            echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
                ?>
            </div>
            <div class="buttomDiv">
                <span class="pin">📌</span>
                <div class="postLinks">
                    <?php if (get_theme_mod('feed_post_card_comments')) { ?>

                        <a href="<?php comments_link(); ?>" class="commentscount">
                            <?php
                            $commentscount = get_comments_number();
                            echo '<span>' . $commentscount . '</span>' . '<span>💬</span>';
                            ?>
                        </a>
                    <?php } ?>

                    <?php if (get_theme_mod('feed_post_card_read_more')) {
                        echo '<a class="readMore" href="' . get_permalink() . '">' . __('read more', 'my-theme') . '</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean(); // Return the buffered output as a string
}
