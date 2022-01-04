$(document).ready(function(){
  $('.header__search-icon-mobile').click(function(){
    $('.header__search-mobile').slideToggle();
  })

  $('.header__menu-mobile').click(function(){
    // mo menu mobile
    $('.section__menu').slideDown(); 
  })

  $(document).on('click', '.section__menu-inner', function(){
    console.log(12345);
  })
})

document.addEventListener('click', function(e){
  if (e.target.className === 'section__menu'){
    document.querySelector('.section__menu').slideUp();
  }
});