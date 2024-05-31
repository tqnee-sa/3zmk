// /*=============== SWIPER JS ===============*/
// let swiperCards = new Swiper(".card__content", {
//   loop: true,
//   spaceBetween: 32,
//   grabCursor: true,

//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//     dynamicBullets: true,
//   },

//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },

//   breakpoints:{
//     600: {
//       slidesPerView: 2,
//     },
//     968: {
//       slidesPerView:3,
//     },
//   },
// });
document.addEventListener("DOMContentLoaded", function () {
    const cardArticles = document.querySelectorAll(".card__article");
    let swiperCards;

    // Check the number of card articles
    if (cardArticles.length > 3) {
        swiperCards = new Swiper(".card__content", {
            loop: true,
            spaceBetween: 32,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                600: {
                    slidesPerView: 2,
                },
                968: {
                    slidesPerView: 3,
                },
            },
        });
    } else {
        // swiperCards = new Swiper(".card__content", {
        //   loop: true,
        //   spaceBetween: 32,
        //   grabCursor: true,
        //   breakpoints: {
        //     600: {
        //       slidesPerView: 2,
        //     },
        //     968: {
        //       slidesPerView: 3,
        //     },
        //   },
        // });

        //   const navigationButtons = document.querySelectorAll(
        //     ".swiper-button-next, .swiper-button-prev"
        //   );
        //   const pagination = document.querySelector(".swiper-pagination");

        //   navigationButtons.forEach((button) => {
        //     button.style.display = "none";
        //   });

        //   if (pagination) {
        //     pagination.style.display = "none";
        //   }
        // }
        // const navigationButtons = document.querySelectorAll(
        //   ".swiper-button-next, .swiper-button-prev"
        // );
        // const pagination = document.querySelector(".swiper-pagination");

        // navigationButtons.forEach((button) => {
        //   button.style.display = "none";
        // });

        // if (pagination) {
        //   pagination.style.display = "none";
        // }

        cardArticles.forEach((article) => {
            article.style.margin = "auto";
        });
    }

    $('.show_main_info').on('click', '.category_item' ,function() {
        console.log('category click')
        var tag = $(this);
        var id = tag.attr('id');

        var url =tag.data('url');
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            data: {
                is_category: true,
            },
            success: function(json) {
                console.log(json);
                $('#restaurant-products').html(json.data.products);
                $('#subcategories-content').html(json.data.sub_category_content);
            }
        });
    });

    var splide = new Splide('.splide', {
        // type     : 'loop',
        // height   : '10rem',
        // focus    : 'right',
        //  autoplay: 'pause',
        direction: langDirection,
        autoplay: 'play',
        perPage: 1,
        interval: 3000,
        autoWidth: true,
    });
    splide.mount();

});
