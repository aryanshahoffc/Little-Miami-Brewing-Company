<?php
/**
 * Template part for displaying beer items
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('beer-card'); ?>>
    <div class="beer-image">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        }
        ?>
    </div>
    <div class="beer-content">
        <h3 class="beer-title"><?php the_title(); ?></h3>
        <?php
        $beer_style = get_post_meta(get_the_ID(), 'beer_style', true);
        $beer_abv = get_post_meta(get_the_ID(), 'beer_abv', true);
        $beer_ibu = get_post_meta(get_the_ID(), 'beer_ibu', true);
        ?>
        <div class="beer-meta">
            <?php if ($beer_style) : ?>
                <span class="beer-style"><?php echo esc_html($beer_style); ?></span>
            <?php endif; ?>
            <?php if ($beer_abv) : ?>
                <span class="beer-abv"><?php echo esc_html($beer_abv); ?>% ABV</span>
            <?php endif; ?>
            <?php if ($beer_ibu) : ?>
                <span class="beer-ibu"><?php echo esc_html($beer_ibu); ?> IBU</span>
            <?php endif; ?>
        </div>
        <div class="beer-description">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
