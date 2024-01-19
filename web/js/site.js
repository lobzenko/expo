new Swiper('#places .swiper', {
  speed: 1200,
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 30
    },    
    768: {
      slidesPerView: 2,
      spaceBetween: 30
    },
    1000: {
      slidesPerView: 3,
      spaceBetween: 30
    }
  },  
  navigation: {
    nextEl: '#places .swiper-button-next',
    prevEl: '#places .swiper-button-prev',
  },
  pagination: {
    el: '#places .swiper-pagination',
    type: 'bullets',
  }
});

new Swiper('#services .swiper', {
  speed: 1200,  
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 30
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 30
    },
    1000: {
      slidesPerView: 3,
      spaceBetween: 30
    }
  },
  navigation: {
    nextEl: '#services .swiper-button-next',
    prevEl: '#services .swiper-button-prev',
  },
  pagination: {
    el: '#services .swiper-pagination',
    type: 'bullets',
  }
});

new Swiper('#responses .swiper', {
  speed: 1200,
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 30
    },
    1000: {
      slidesPerView: 2,
      spaceBetween: 30
    }
  },
  navigation: {
    nextEl: '#responses .swiper-button-next',
    prevEl: '#responses .swiper-button-prev',
  },
  pagination: {
    el: '#responses .swiper-pagination',
    type: 'bullets',
  }
});

jQuery(document).ready(function(){

    $("#cart-form").submit(function(e){

        e.preventDefault();
        e.stopPropagation();

        let $form = $("#cart-form");
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: $form.serialize(),
            success: function(data)
            {              
              if (data.success)
              {
                let myModal = new bootstrap.Modal('#cartModal', {});
                myModal.show();
              }
            }
        });

        //$form.reset();

        return false;
    });

    $("#contact-form").submit(function(){

        let $form = $("#contact-form");
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: $form.serialize(),
            success: function(data)
            {              
              if (data.success)
              {
                let myModal = new bootstrap.Modal('#contactModal', {});
                myModal.show();
              }
            }
        });

        //$form.reset();

        return false;
    });

    if ($("#placeModal").length>0)
    {
      var placeModal = new bootstrap.Modal('#placeModal', {});

      $(".place-modal").click(function(){

        let $link = $(this);
        $.ajax({
            url: $link.attr('href'),
            type: 'get',
            success: function(data)
            {              
                $("#placeModal .modal-body").html(data);

                placeModal.show();

                new Swiper('#modal-swiper', {
                  speed: 1200,    
                  pagination: {
                    el: '#modal-swiper .swiper-pagination',
                    type: 'bullets',
                  },
              });
            }
        });

        return false;
      });    
    }

    $("#placeModal").delegate('.add-to-cart','click',function(){    

      //var cart = JSON.parse(Cookies.get('cart'));

      var cart = Cookies.get('cart');

      if (typeof cart == 'undefined')
        cart = [];      
      else 
        cart = JSON.parse(cart);

      if (cart.indexOf($(this).data('id'))==-1)
        cart.push($(this).data('id'));

      console.log(cart);
      
      Cookies.set('cart', JSON.stringify(cart), { expires: 10 });

      $(this).removeClass('add-to-cart').text('Перейти в корзину')

      return false;
    });
});