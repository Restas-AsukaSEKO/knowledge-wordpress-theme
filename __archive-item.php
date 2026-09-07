<?php get_header(); ?>

<main class="main">
  <div class="item-archive l_section">
    <div class="l_contents">
      <div class="l_container">
        <h2 class="m_section-ttl" data-subtitle="アイテム">Item</h2>

        <div id="denim" class="item_category-group">
          <h3 class="m_section-subttl">
            <span class="m_section-subttl-hyphen"> - </span>Denim <span class="m_section-subttl-hyphen"> - </span>
          </h3>
          <div class="item_grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
              <?php get_template_part('template-parts/loop', 'item'); ?>
      
            <?php endwhile; endif; ?>           
          </div>
        </div>

        <div id="t-shirts" class="item_category-group">
          <h3 class="m_section-subttl">
            <span class="m_section-subttl-hyphen"> - </span>T-shirts <span class="m_section-subttl-hyphen"> - </span>
          </h3>
          <div class="item_grid">
             <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
              <?php get_template_part('template-parts/loop', 'item'); ?>
      
            <?php endwhile; endif; ?>
            <article class="item_card">
              <a href="single-item.html" class="item_card-link">
                <div class="item_card-img">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/white-shirt.png" alt="Organic Cotton Tee">
                </div>
                <div class="item_card-info">
                  <p class="item_card-name">Organic Cotton Tee</p>
                  <p class="item_card-price">¥8,800</p>
                </div>
              </a>
            </article>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>