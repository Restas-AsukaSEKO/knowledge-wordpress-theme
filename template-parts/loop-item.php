
            <article class="item_card">
              <a href="<?php the_permalink(); ?>" class="item_card-link">
                <div class="item_card-img">
                  <?php if (has_post_thumbnail($post)): ?>
                    <?php the_post_thumbnail('medium'); ?>
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/style-j10.png" alt="Vintage Denim">
                  <?php endif; ?>
                  </div>
                <div class="item_card-info">
                  <p class="item_card-name"><?php the_title(); ?></p>
                  <p class="item_card-price">
                    ¥<?php 
                    $price = get_post_meta(get_the_ID(), 'price', true); 
                    echo $price
                    ?>
                  </p>
                </div>
              </a>
            </article>

            <!-- <?php echo get_field('price'); ?>これはAFCプラグイン専用、get_post_meta(get_the_ID(), 'price', true)こっちはWordpress標準 -->