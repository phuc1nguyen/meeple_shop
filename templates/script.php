  <!-- Script -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="public/js/main.js"></script>
  <script>
    const swiper = new Swiper('#mySwiper', {
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      autoplay: {
        delay:2500,
        disableOnInteraction: false,
      }
    })
  </script>
  <!-- End script -->
</body>
</html>