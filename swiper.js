var swiper = new Swiper(".home", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

// swiper for coming
var swiper = new Swiper(".coming-container", {
  spaceBetween: 20,
  loop:true,
  autoplay: {
      delay: 55000,
      disableOnInteraction: false,
  },
  centeredSlides: true,
  breakpoints: {
      0: {
          slidesPerView: 2,
      },
      568:{
        slidesPerView: 3,  
      },
      768:{
          slidesPerView: 4,
      },
      968:{
          slidesPerView: 5,
      },
  },
});