<?php get_header(); ?>

<main class="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <section class="item-detail l_section">
    <div class="l_contents">
      <div class="l_container">
        <h2 class="m_section-ttl" data-subtitle="スタイリング">Styling</h2>
        <div class="item-detail_wrapper">

          <div class="item-detail_image-wrap">
            <?php if (has_post_thumbnail($post)): ?>
              <?php the_post_thumbnail('large', array('class' => 'item-detail_image')); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/style-j10.jpg"
              alt="no image" class="item-detail_image">
            <?php endif; ?>
          </div>

          <div class="item-detail_info">
            <h1 class="item-detail_name"><?php the_title(); ?></h1>

            <?php
            $related_item_id = get_field('related_item');
            if ($related_item_id) :
              $related_permalink = get_permalink($related_item_id);
            ?>
              <div class="item-meta">
                <div class="item-meta_content">
                  <div class="item-meta_item">
                    <span class="item-meta_label">Item:</span>
                    <a href="<?php echo esc_url($related_permalink); ?>"><?php echo esc_html(get_the_title($related_item_id)); ?></a>
                  </div>
                </div>
              </div>

              <div class="m_btn-wrap">
                <p class="m_btn">
                <a href="<?php echo esc_url($related_permalink); ?>" class="m_btn_link">View this item</a>
                </p>
              </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>
  </section>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
