<?php get_header(); ?>

<main class="main">
  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
  <section class="item-detail l_section">
    <div class="l_contents">
      <div class="l_container">
        <h2 class="m_section-ttl" data-subtitle="アイテム">Item</h2>
        <div class="item-detail_wrapper">
          
          <div class="item-detail_image-wrap">
            <?php if (has_post_thumbnail($post)): ?>
              <?php the_post_thumbnail('large', array('class' => 'item-detail_image')); ?>
             <?php else : ?> 
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/white-shirt.png" 
              alt="一生モノの白シャツ" class="item-detail_image">
            <?php endif; ?>
          </div>

          <div class="item-detail_info">
            <h1 class="item-detail_name"><?php the_title(); ?></h1>
            <p class="item-detail_price">¥<?php echo get_field('price'); ?> <span class="tax-in">(tax in)</span></p>
            
            <div class="item-detail_description">
              <?php the_content(); ?>
            </div>
            <div class="item-meta">
              <div class="item-meta_content">
                <div class="item-meta_item">
                  <span class="item-meta_label">Category:</span>
                  <?php echo get_the_term_list(get_the_ID(), 'item_category', '', '', ''); ?>
                </div>
                <div class="item-meta_item">
                  <span class="item-meta_label">Tags:</span>
                  <div class="item-meta_tags">
                    <?php
                    $recommend = get_field('recommend');
                    if($recommend): ?>
                      <span class="item-meta_tag">recommend</span>
                    <?php endif; ?>
                    <?php 
                    $tags = get_field('other');
                   if( $tags): ?>
                   <?php foreach ($tags as $tag ): ?>
                    <span class="item-meta_tag"><?php echo esc_html($tag); ?></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="item-styling l_section">
    <div class="l_contents">
      <div class="l_container">
        <h3 class="m_section-subttl m_text-center">
          <span class="m_section-subttl-hyphen"> - </span> Styling <span class="m_section-subttl-hyphen"> - </span>
        </h3>
        
        <div class="item-styling_grid">
          <?php
          $term_ids = wp_get_object_terms(get_the_ID(), 'item_category', array('fields' => 'ids'));
          if( !empty($term_ids) ): 
            $args = array(
              'post_type' => 'styling',
              'posts_per_page' => 4,
              'orderby' => 'rand',
              'tax_query' => array(
                array(
                'taxonomy' => 'item_category',
                'field' => 'term_id',
                'terms' => $term_ids,
                'operator' => 'IN',
              ),
            ),
          );

          $styling_query = new WP_Query($args);

          if ($styling_query->have_posts()):
            while ($styling_query->have_posts()): $styling_query->the_post(); ?>

          <div class="item-styling_item">
            <div class="item-styling_img-wrap">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('large', array('class' => 'item-styling_img')); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/dummy.png" alt="no image" class="item-styling_img">
            <?php endif; ?>

            </div>
            <div class="item-styling_cards">
              <?php
              $styling_terms = get_the_terms(get_the_ID(), 'item_category');
              if($styling_terms && !is_wp_error($styling_terms)): 
                foreach( $styling_terms as $term) : ?>
                  <a href="<?php echo get_term_link($term); ?>" class="m_category-card">
                    <?php echo $term->name; ?>
                  </a>
                <?php endforeach; 
                endif ; ?>
            </div>
          </div>
            <?php endwhile ;
            wp_reset_postdata(); 
            endif;
          endif; ?>          
        </div>

        <div class="m_btn-wrap m_btn-wrap__item-detail">              
              <p class="m_btn">
              <a href="<?php echo get_post_type_archive_link('item'); ?>" class="m_btn_link">Back to all items</a>
              </p>
        </div> 
      </div>
    </div>
  </section>
  <?php endwhile; endif;  ?>
</main>

<?php get_footer(); ?>