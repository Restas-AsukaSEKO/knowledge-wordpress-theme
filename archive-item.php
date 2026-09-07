<?php get_header(); ?>

<main class="main">
  <div class="item-archive l_section">
    <div class="l_contents">
      <div class="l_container">
        <h2 class="m_section-ttl" data-subtitle="アイテム">Item</h2>

        <?php
        $taxonomy   = 'item_category';
        $term_args = [
              'parent' => 0,          //親ターム限定
              'hide_empty' => true,   //件数の０は表示しない
              // 'exclude'    => 8       //非表示にしたいタームがあればここにIDで指定
        ];
        $terms = get_terms( $taxonomy , $term_args );
        if ( count( $terms ) != 0 ) :
        foreach ($terms as $term):
        
        $args = array(
          'post_type' => 'item',
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'item_category',
              'field' => 'slug',
              'terms' => $term->slug,
            ),
          ),
        );
        $query = new WP_Query($args);
        ?>

        <div id="<?php echo ucfirst($term->slug); ?>" class="item_category-group">
          <h3 class="m_section-subttl">
            <span class="m_section-subttl-hyphen"> - </span><?php echo $term->name; ?> <span class="m_section-subttl-hyphen"> - </span>
          </h3>
          <div class="item_grid">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
      
              <?php get_template_part('template-parts/loop', 'item'); ?>
      
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
        </div>
      <?php endforeach; ?>
      <?php endif;?>
        
      </div>
    <!-- l_container -->
    </div>
    <!-- l_contents -->
  </div>
  <!-- archive-item -->
</main>

<?php get_footer(); ?>