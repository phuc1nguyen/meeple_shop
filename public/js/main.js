// $(document).ready(function(){
//   $('.header__menu-mobile').click(function(){
//     // open mobile menu
//     $('.section__menu').slideDown(); 
//   })
// })

document.querySelector('.section_tut').addEventListener('click', test);

function test(e) {
  if (e.target.classList.contains('video_thumb_img') || e.target.classList.contains('video_title')) {
    console.log(12345);
  }
}