$(document).ready(function(){
  $('.header__menu-mobile').click(function(){
    // open mobile menu
    $('.section__menu').slideDown(); 
  })

  $(document).on('click', '.section__menu-inner', function(){
    console.log(12345);
  })

  $('.section__menu').click(function(){

  })
})