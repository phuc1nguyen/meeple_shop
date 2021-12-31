<?php 
  $title = "Meeple Shop | Home";
  include('templates/header.php');
?>
  <div class="section__main">
    <!-- Home slider -->
    <div class="home__slider" id="mySwiper">
      <div class="swiper-wrapper wide">
        <div class="swiper-slide"><img src="public/img/sliders/home-slider-1.jpg" alt=""></div>
        <div class="swiper-slide"><img src="public/img/sliders/home-slider-2.jpg" alt=""></div>
        <div class="swiper-slide"><img src="public/img/sliders/home-slider-3.jpg" alt=""></div>
        <div class="swiper-slide"><img src="public/img/sliders/home-slider-4.jpg" alt=""></div>
        <div class="swiper-slide"><img src="public/img/sliders/home-slider-5.jpg" alt=""></div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <!-- End home slider -->

    <!-- Hightlights banners -->
    <div class="highlights-banners">
      <div class="highlights-banners-inner wide">
        <a href="#" class="highlights-banners-ship">
          <div class="highlights-banners-icon">
            <svg width="60" height="40" viewBox="0 0 60 40"><path fill="currentColor" fill-rule="evenodd" transform="translate(-263.000000, -117.000000)" d="M289,151.5 C289,154.537566 286.537566,157 283.5,157 C280.462434,157 278,154.537566 278,151.5 C278,151.331455 278.007581,151.164681 278.022422,151 L271,151 L271,140 L273,140 L273,149 L278.59971,149 C279.510065,147.219162 281.362657,146 283.5,146 C285.637343,146 287.489935,147.219162 288.40029,148.999999 L301,149 L301,119 L271,119 L271,117 L303,117 L303,126 L316.723739,126 C317.85789,126 318.895087,126.639588 319.404327,127.652985 L320.786845,130.404226 C322.242105,133.300224 323,136.496398 323,139.737476 L323,148 C323,149.656854 321.656854,151 320,151 L316.977578,151 C316.992419,151.164681 317,151.331455 317,151.5 C317,154.537566 314.537566,157 311.5,157 C308.462434,157 306,154.537566 306,151.5 C306,151.331455 306.007581,151.164681 306.022422,151 L288.977578,151 C288.992419,151.164681 289,151.331455 289,151.5 Z M319.417229,134.516568 L319.417798,134.118058 C319.418189,133.844298 319.362374,133.573373 319.253808,133.32206 L317.177681,128.516129 L310.567164,128.516129 C310.014879,128.516129 309.567164,128.963844 309.567164,129.516129 L309.567164,134.330091 C309.567164,134.882376 310.014879,135.330091 310.567164,135.330091 L318.602544,135.330091 C319.052028,135.330091 319.416588,134.966052 319.417229,134.516568 Z M311.5,155 C313.432997,155 315,153.432997 315,151.5 C315,149.567003 313.432997,148 311.5,148 C309.567003,148 308,149.567003 308,151.5 C308,153.432997 309.567003,155 311.5,155 Z M283.5,155 C285.432997,155 287,153.432997 287,151.5 C287,149.567003 285.432997,148 283.5,148 C281.567003,148 280,149.567003 280,151.5 C280,153.432997 281.567003,155 283.5,155 Z M264,123 L280,123 C280.552285,123 281,123.447715 281,124 C281,124.552285 280.552285,125 280,125 L264,125 C263.447715,125 263,124.552285 263,124 C263,123.447715 263.447715,123 264,123 Z M267,128 L280,128 C280.552285,128 281,128.447715 281,129 C281,129.552285 280.552285,130 280,130 L267,130 C266.447715,130 266,129.552285 266,129 C266,128.447715 266.447715,128 267,128 Z M271,133 L280,133 C280.552285,133 281,133.447715 281,134 C281,134.552285 280.552285,135 280,135 L271,135 C270.447715,135 270,134.552285 270,134 C270,133.447715 270.447715,133 271,133 Z"></path></svg>
          </div>
          <div class="highlights-banners-text">
            <h4 class="highlights-banners-heading">Free Shipping</h4>
            <p class="highlights-banners-details">When you spend $80+</p>
          </div>
        </a>

        <div class="highlights-banners-call">
          <div class="highlights-banners-icon">
            <svg class="icon-cell-phone" aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="23" height="39" viewBox="0 0 23 39">      <path fill="currentColor" fill-rule="evenodd" transform="translate(-154.000000, -121.000000)" d="M157.833333,160 L173.166667,160 C175.275511,160 177,158.270825 177,156.15625 L177,124.84375 C177,122.729175 175.275511,121 173.166667,121 L157.833333,121 C155.724489,121 154,122.729175 154,124.84375 L154,156.15625 C154,158.270825 155.724489,160 157.833333,160 Z M165.5,158.71875 C164.4144,158.71875 163.583333,157.885425 163.583333,156.796875 C163.583333,155.708325 164.4144,154.875 165.5,154.875 C166.5856,154.875 167.416667,155.708325 167.416667,156.796875 C167.416667,157.885425 166.5856,158.71875 165.5,158.71875 Z M162.946181,123.5625 L168.053819,123.5625 C168.407627,123.5625 168.694444,123.849318 168.694444,124.203125 L168.694444,124.203125 C168.694444,124.556932 168.407627,124.84375 168.053819,124.84375 L162.946181,124.84375 C162.592373,124.84375 162.305556,124.556932 162.305556,124.203125 L162.305556,124.203125 C162.305556,123.849318 162.592373,123.5625 162.946181,123.5625 Z M156,127.016304 L175,127.016304 L175,153.092391 L156,153.092391 L156,127.016304 Z"></path></svg>
          </div>
          <div class="highlights-banners-text">
            <h4 class="highlights-banners-heading">Give Us A Call</h4>
            <p class="highlights-banners-details">+84 99 054 74 35</p>
          </div>
        </div>

        <a href="#" class="highlights-banners-email">
          <div class="highlights-banners-icon">
            <svg class="icon-email" aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">      <path fill="currentColor" fill-rule="nonzero" d="M6.19 6.26A21.247 21.247 0 0 0 0 21.348C.052 33 9.843 42.5 21.832 42.5h.824v-3.125h-.824c-10.262 0-18.663-8.084-18.707-18.043A18.126 18.126 0 0 1 21.25 3.125c10.042.045 18.125 8.445 18.125 18.707v6.45a4.06 4.06 0 0 1-4.062 4.062 4.06 4.06 0 0 1-4.063-4.063v-7.035a10.043 10.043 0 0 0-3.614-7.747 10.035 10.035 0 1 0-1.055 16.194l1.383-.872.48 1.562a7.185 7.185 0 0 0 7.93 4.995A7.19 7.19 0 0 0 42.5 28.28v-6.45C42.5 9.844 33.003.054 21.352 0 15.596 0 10.175 2.253 6.189 6.26zm15.06 21.865a6.876 6.876 0 1 1 2.632-13.227 6.876 6.876 0 0 1-2.632 13.227z"></path></svg>
          </div>
          <div class="highlights-banners-text">
            <h4 class="highlights-banners-heading">Email Us</h4>
            <p class="highlights-banners-details">customerservice@meepleshop.com</p>
          </div>
        </a>

        <a href="#" class="highlights-banners-location">
          <div class="highlights-banners-icon">
            <svg class="icon-pin " aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="31" height="40" viewBox="0 0 31 40">      <path fill="currentColor" fill-rule="evenodd" d="M14.774 39.849C14.17 39.504 0 27.242 0 15.35 0 6.887 6.887 0 15.351 0c8.465 0 15.351 6.887 15.351 15.351 0 11.054-14.13 24.093-14.734 24.47a1.166 1.166 0 0 1-1.194.027zm.574-37.815C8.045 2.034 2.1 7.977 2.1 15.284c0 9.398 10.572 20.573 13.252 22.275 2.667-1.828 13.246-13.543 13.246-22.276 0-7.306-5.945-13.249-13.249-13.249zm0 7.924c-2.46 0-4.46 2-4.46 4.46s2 4.46 4.46 4.46 4.46-2 4.46-4.46-2-4.46-4.46-4.46z"></path></svg>
          </div>
          <div class="highlights-banners-text">
            <h4 class="highlights-banners-heading">Location</h4>
            <p class="highlights-banners-details">Stop In</p>
          </div>
        </a>
      </div>
    </div>
    <!-- End highlights banners -->

    <!-- Main section -->
    <div class="home__content">
      <section class="home__new-release wide">
        <div class="section_heading">
          <h1 class="section_name">New Release</h1>
        </div>

        <div class="section_prod">
          <div class="section_prod_inner">
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/last-friday.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Last Friday Revised Edition</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 37.99</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/diabolik.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Diabolik - Heists & Investigation</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 32.68</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/crime-zoom-2.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Crime Zoom: Bird of Omen</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 9.24</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/crime-zoom.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Crime Zoom: His Last Card</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 9.24</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <a href="#" class="prod_more">
              <div class="prod_more_inner">
                <h4>View All</h4>
                <h2>New Games</h2>
              </div>
            </a>
          </div>
        </div>
      </section>
    </div>

    <div class="home__content">
      <section class="home__pre-order wide">
        <div class="section_heading">
          <h1 class="section_name">Pre-Orders</h1>
        </div>

        <div class="section_prod">
          <div class="section_prod_inner">
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/phantom-ink.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Phantom Ink (Pre-Order)</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 21.96</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/echoes.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Echoes - The Microchip (Pre-Order)</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 8.49</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/star-trek.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Star Trek - Mission - Fantasy Realms Game (Pre-Order)</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 16.99</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <article class="prod_item">
              <div class="prod_thumb">
                <a href="#" class="prod_thumb-inner">
                  <img src="public/img/products/home/star-trek.jpg" alt="Product Thumbnail">
                </a>
              </div>
              <div class="prod_info">
                <div class="prod_name"><a href="#">Star Trek: Super-Skill Pinball (Pre-Order)</a></div>
                <div class="prod_price"><span class="prod_price-red">$ 16.99</span></div>
              </div>
              <button type="button" class="btn btn-primary btn-add-cart" data-url="">Add to cart</button>
            </article>
            <a href="#" class="prod_more">
              <div class="prod_more_inner">
                <h4>View All</h4>
                <h2>Pre-Orders</h2>
              </div>
            </a>
          </div>
        </div>
      </section>
    </div>

    <div class="home__content">
      <section class="home__tutorial wide">
        <div class="section_heading">
          <h1 class="section_name">Tutorials</h1>
        </div>

        <div class="section_tut">
          <div class="section_tut_inner">
            <div id="mainIframe">
              <iframe src="https://www.youtube.com/embed/gn2qIOdPcd8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="homeIframe">
              <article class="iframe_item">
                <div class="iframe_item_inner">
                  <div class="video_title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, officiis!</div> 
                  <div class="video_thumb" data-source="">
                    <img class="video_thumb_img" src="public/img/thumbs/home/video_thumb.png" alt="Video Thumbnail">
                  </div>
                </div>
              </article>
              <article class="iframe_item">
                <div class="iframe_item_inner">
                  <div class="video_title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, officiis!</div> 
                  <div class="video_thumb" data-source="">
                    <img class="video_thumb_img" src="public/img/thumbs/home/video_thumb.png" alt="Video Thumbnail">
                  </div>
                </div>
              </article>
              <article class="iframe_item">
                <div class="iframe_item_inner">
                  <div class="video_title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, officiis!</div> 
                  <div class="video_thumb" data-source="">
                    <img class="video_thumb_img" src="public/img/thumbs/home/video_thumb.png" alt="Video Thumbnail">
                  </div>
                </div>
              </article>
              <article class="iframe_item">
                <div class="iframe_item_inner">
                  <div class="video_title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, officiis!</div> 
                  <div class="video_thumb" data-source="">
                    <img class="video_thumb_img" src="public/img/thumbs/home/video_thumb.png" alt="Video Thumbnail">
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="home__content">
      <section class="home__sub wide">
        <div class="section_heading">
          <h1 class="section_name">Meeple Newsletter</h1>
        </div>

        <div class="section_sub">
          <div class="section_sub_inner">
            <p class="section_sub_description">Join our mailing list for notifications on sales!</p>
            <div class="section_sub_item">
              <input type="text" name="home_email" placeholder="Your email address">
              <button type="button" name="btn-sub" class="btn btn-primary btn-sub" data-url="">Subscribe</button>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- End main section -->
  </div>
<?php
  include('templates/footer.php');
  include('templates/script.php');
?>