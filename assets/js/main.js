jQuery(document).ready(function($) {
  $(document).ready(function() {
    var header = document.getElementById('thrive-header'); 
    window.addEventListener('scroll', function() {
      var currentPosition = window.pageYOffset || document.documentElement.scrollTop;
      
      if (currentPosition > 50) {
        header.classList.add('scroll-up');
      } else {
        header.classList.remove('scroll-up');
      }
    });
    $(window).scroll(function() {
      var scrollTop = $(window).scrollTop();
      var parallaxContainer = $('.hot-tub__specification')
      if (parallaxContainer.length > 0) {
        var parallaxImage = parallaxContainer.find('.custom-wave');
        var parallaxHeight = parallaxContainer.position().top;
        var imageOffset = parallaxHeight - scrollTop;
        parallaxImage.css('top', imageOffset / 5 + 'px');
  
        var parallaxContainer1 = $('.hot-tub__accessories')
        var parallaxImage1 = parallaxContainer1.find('.custom-wave');
        var parallaxHeight1 = parallaxContainer1.position().top;
        var imageOffset1 = parallaxHeight1 - scrollTop;
        parallaxImage1.css('top', imageOffset1 / 5 + 'px');
      }
    });
    var closeButton = document.querySelector('.tcb-icon-close-offscreen');
    if(closeButton)
      closeButton.style.setProperty('top', 35 + 'px', 'important');

    $('.tve-ham-wrap').scroll( function() {
      // Get the scroll position within the scrollable element
      var windowWidth = $(window).width();
      console.log(windowWidth);
  

      if (windowWidth < 1024) {
        var scrollPosition = $('.user-account').position().top - 10;
      
        // Adjust the position of the close button based on the scroll position
        closeButton.style.setProperty('top', scrollPosition + 'px', 'important');
      }
    });
//     window.addEventListener("mousemove", function(event) {
//       var mouseY = event.clientY;
  
//       if (mouseY <= 50) {
//         var currentPosition = window.pageYOffset;
//         if(currentPosition > 50)
//           header.classList.add('scroll-up');
// 		  header.style.setProperty('top', '32px', 'important');
//       }
//     });
    // Get the modal
    var modal = document.getElementById('searchModal');
    
    // Get the button that opens the modal
    var btn = document.getElementById("yourSearchButtonId");
    
    // Get the <span> element that closes the modal
    var span = $('#searchModal').find('.close')[0];
    
    // When the user clicks on the button, open the modal

    $('.blog-feed-filters').find('.filter-search').on('click', function() {
      modal.style.display = "block";
      $('footer > div').css('z-index', 30);

    })
    if(btn) {
      btn.onclick = function() {
        $('#search-results').html('');
        $('#search-form input').val('');
        modal.style.display = "block";
        $('footer > div').css('z-index', 30);
      }
    }
    
    // When the user clicks on <span> (x), close the modal
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      // console.log(event.target == span, event.target, span)
      if (event.target == modal || event.target == span) {
        modal.style.display = "none";
        $('footer > div').css('z-index', 14);
      }
    }
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        let searchString = $('#s').val();
        // console.log(searchString);
        fetchResults(searchString);
        $list.attr('data-search', searchString);
        // $list.attr('data-sort', $('.filter-sort').find('.filter-btn').attr('data-value'));
        ajaxCPT();
    });
  
    function fetchResults(searchString) {
        var results = '';
        $.ajax({
            url: '/wp-json/wp/v2/posts?search=' + searchString,
            type: 'GET',
            success: function(data) {
                data.forEach(post => {
                    //  results += `<h3>${post.title.rendered}</h3><p>${post.excerpt.rendered}</p><a href="${post.link}">Read More</a>`;
                     results += `<a href="${post.link}" class="search-result__item">${post.title.rendered}</a>`;
                });
                if (data.length == 0) {
                  results = '<h5 class="search-result__item">No result found</h5>'
                }
                $('#search-results').html(results);
            },
            error: function(err) {
                $('#search-results').html('<p>Error retrieving search results. Please try again.</p>');
            }
        });
    }
  
    // footer background color
    const currentUrl = window.location.href;
    console.log(currentUrl)
    if(currentUrl.includes('under-construction')) {
      console.log(currentUrl)
      const footer = document.querySelector('footer');
      const topSection = document.querySelector('#theme-top-section');
      footer.classList.add("remove-wave");
      topSection.classList.add("under-construction");
    }
  
    if(currentUrl.includes('experience') || currentUrl.includes('collection') || currentUrl.includes('resource') || currentUrl.includes('hot_tubs') || currentUrl.includes('swim_spas')|| currentUrl.includes('brand') || currentUrl.includes('promotion') || currentUrl.includes('specials') || currentUrl.includes('location') || currentUrl.includes('about/news') || currentUrl.includes('/awards-recognitions') || currentUrl.includes('/blog') || currentUrl.includes('/privacy') || currentUrl.includes('/service')) {
      const footer = document.querySelector('footer');
  
      footer.classList.add("custom-footer");
    }
    if(currentUrl.includes('/e-store') || currentUrl.includes('/product/') || currentUrl.includes('/cart') || currentUrl.includes('/checkout') || currentUrl.includes('/product-category/')) {
      const footer = document.querySelector('footer');
      setTimeout(function() {
        $('#woofc-count').addClass('show');
      }, 2000);
      footer.classList.add("estore-footer");
    }
    

    //Brand
    $('.brand-video').find('video').attr('playsinline', 'playsinline')

    //hot tub specification
    $('.info-right__specs__item.additional-specs').on('click', function() {
      $(this).toggleClass('active');
      $(this).find('.specs-item__data').slideToggle('normmal');
    })
      
    //Filter
    $('.filter').on('click', function(e) {
        e.stopPropagation();
        $('.filter-dropdown').removeClass('active');
        $('.filter').removeClass('active');
        $(this).find('.filter-dropdown').toggleClass('active');
    $(this).toggleClass('active');
    })
    $(document).click(function (e) {
      const filter = $(".filter");

      //check if the clicked area is dropDown or not
      if ( filter.has(e.target).length === 0 ) {
        $('.filter-dropdown').removeClass('active');
        $('.filter').removeClass('active');
      }
    })

    // leadership modal
    $('.leadership-team__item__image').on('click', function() {
      $(this).siblings('.leadership-modal').addClass('active');
      $('[data-css="tve-u-18a091af2e8"]').css('z-index', '9999');
      $('.custom-wave').css('display', 'none');
      $('header#thrive-header').css('display', 'none');
      $('footer#thrive-footer').css('display', 'none');
    })
    $('.leadership-modal .close').on('click', function() {
      $(this).parent().parent().removeClass('active');
      $('[data-css="tve-u-18a091af2e8"]').css('z-index', '1');
      $('.custom-wave').css('display', 'block');
      $('header#thrive-header').css('display', 'block');
      $('footer#thrive-footer').css('display', 'block');
    })

    // collection features modal
    $('.collection-features__item').on('click', function() {
      $(this).find('.collection-features__modal').addClass('active');
      $('[data-css="tve-u-189abe28316"]').css('z-index', '9999');
      $('.custom-wave').css('display', 'none');
    })
    $('.collection-features__modal .close').on('click', function(e) {
      e.stopPropagation();
      $(this).parent().parent().removeClass('active');
      $('[data-css="tve-u-189abe28316"]').css('z-index', '1');
      $('.custom-wave').css('display', 'block');
    })

    //hot tub
    const $list = $('.cpt-list');
    const $pagination = $('.pagination');
    function ajaxCPT() {
      const cat = $list.attr('data-cat');
      const post_type = $list.attr('data-post-type');
      const paged = $list.attr('data-paged');
      const posts_per_page = $list.attr('data-posts-per-page');
      const search = $list.attr('data-search');
      const individual = $list.attr('data-individual');
      const sort = $list.attr('data-sort');
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'ajax_cpt',
          post_type,
          sort,
          cat,
          individual,
          search,
          paged,
          posts_per_page
        },
        beforeSend() {
          $list.html(
            '<span class="loader"></span>'
          );
          $pagination.hide();
        },
        success(res) {
          const data = JSON.parse(res);
          $list.html(data.output);
          if (data.max_num_pages > 1) {
            $pagination.html(data.pagination);
            $pagination.show();
          }
          // helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
        }
      });
    }

    // blog feed page
    //pagination
    $('.blog-feed-pagination').find('.pagination-next').on('click', function() {
      const attribute = $list.attr('data-paged');
      page = parseInt(attribute);
      const total =   $list.find('.blog-feed__item').attr('total-pages') ?  $list.find('.blog-feed__item').attr('total-pages') : $list.attr('total-pages');
      if ( page * 9 >= total ) return;
      curPage = $('.pagination-num.active').attr('page');
      $('.pagination-num.active').next().trigger('click');
    })
    $('.blog-feed-pagination').find('.pagination-prev').on('click', function() {
      const attribute = $list.attr('data-paged');
      page = parseInt(attribute);
      if ( page < 2 ) return;
      curPage = $('.pagination-num.active').attr('page');
      $('.pagination-num.active').prev().trigger('click');
    })

    $('.filter').find('.option').on('click', function(e) {
      e.stopPropagation();
      $('.filter-dropdown p').removeClass('activeitem');
      $(this).addClass('activeitem');
      $('.filter-dropdown').removeClass('active')
      const text = $(this)[0].innerText;
      const attribute = $(this).attr('value');
      const attributes = $(this).parent().find('.option').map(function() {
        return $(this).attr('value');
      }).get();
      var prev_attr = $list.attr('data-cat');
      console.log(prev_attr);
      $(this).parent().prev().attr('data-value', attribute)
      $(this).parent().prev().text(text)

      for(i = 0;i < attributes.length;i ++) {
        prev_attr = prev_attr.toString()
        prev_attr= prev_attr.replace(attributes[i], '')
      }
      console.log(prev_attr, "abc")
      result = prev_attr.concat(' ', attribute);
      console.log(result);
      $('.filter').removeClass('active');
      result = result.replace('  ', ' ');
      $list.attr('data-cat', result);
      $('.filter').removeClass('active')
      $('.filter-dropdown').removeClass('active')
      // $list.attr('data-sort', $('.filter-sort').find('.filter-btn').attr('data-value'));
      ajaxCPT();
    })

    $('.hot-tub-product__seemore').on('click', function() {
      $('.filter-dropdown').removeClass('active')
      $list.attr('data-posts-per-page', '-1');      
      // $list.attr('data-sort', $('.filter-sort').find('.filter-btn').attr('data-value'));
      ajaxCPT();
    })
    $('.swim_spas__seemore').on('click', function() {
      $('.filter-dropdown').removeClass('active')
      $list.attr('data-posts-per-page', '-1');
      $list.attr('data-cat', '');
      // $list.attr('data-sort', $('.filter-sort').find('.filter-btn').attr('data-value'));
      ajaxCPT();
    })

    // blog feed search
    $('.blog-feed-filters').find('input').on('change', function() {
      $list.attr('data-search', $(this).val());
      ajaxCPT();
    })

    // clear filters
    $('.clear-filter').on('click', function() {
      $('.filter-dropdown').find('.initial').map(function() {
        value = $(this).text();
        return $(this).parent().prev().text(value);
      });
      $('.blog-feed-filters').find('input').val('');
      $('.filter-brand .filter-dropdown').find('.option').removeClass('activeitem');
      $list.attr('data-cat', '');
      $list.attr('data-search', '');
      $list.attr('data-posts-per-page', '9');
      ajaxCPT();
    })

    //estore
    $('.estore-category').find('.featured-cat').on('click', function() {
      var category = $(this).find('.featured-cat__title').attr('data-cat');
      console.log(category);
      $('.estore-product').removeClass('active');
      $(`#${category}`).addClass('active');
      $('html, body').animate({
        scrollTop: $(`#${category}`).offset().top
      }, 500);
    })
    //contact
    $('.contact-store__title').on('click', function() {
      console.log("1");
      $('.contact-store__item').removeClass('active');
      $('.contact-store__title').removeClass('active');
      $('.contact-store').addClass('active');
      $(this).next().addClass('active');
      $(this).addClass('active');
    })
    $('.contact-store').find('.close').on('click', function() {
      $('.contact-store__item').removeClass('active');
      $('.contact-store__title').removeClass('active');
      $('.contact-store').removeClass('active');
    })
    $('.contact-store').find('.seemap').on('click', function() {
      $(this).parent().siblings('.map-modal').addClass('active');
      $('[data-css="tve-u-18a27e35cc1"]').css('z-index', '9999');
      $('header#thrive-header').css('display', 'none');
      $('footer#thrive-footer').css('display', 'none');
    })
    $('.map-modal .map-close').on('click', function() {
      $(this).parent().parent().removeClass('active');
      $('[data-css="tve-u-18a27e35cc1"]').css('z-index', '1');
      $('header#thrive-header').css('display', 'block');
      $('footer#thrive-footer').css('display', 'block');
    })

    //estore smart top special product
    $('.custom-tab-links > li').on('click', function() {
      $('.custom-tab-links > li').removeClass('current-tab');
      $(this).addClass('current-tab');
      cName = $(this).find('a').attr('class');
      $('.custom-tabs-wrapper > div').removeClass('current-tab');
      $('.custom-tabs-wrapper').find('.' + cName).addClass('current-tab');
    })

    ///pre delivery form
    $('.pre-delivery-form-1 .pre-delivery-form-submit').on('click', function(e) {
      e.stopPropagation(); // Prevent the default form submission
      if($('.tve-lg-error-container').css('display') == 'none') {
        console.log("asdf");
      }
      // Perform validation checks here
    });

    $('.blog-paginations').on('click', '.pagination-num', function(e) {
      e.preventDefault();
      var blogElement = $('#blog-filters');
      $('html, body').animate({ scrollTop: blogElement.offset().top }, 'normal');
      $('.pagination-num').removeClass('active');
      $(this).addClass('active');
      totalPage = parseInt($('.pagination-num.end').attr('page'));
      curPage = parseInt($(this).attr('page'));
      console.log(totalPage, curPage)
      if(curPage == 1 || curPage == totalPage) {
        $list.attr('data-paged', curPage);
        ajaxCPT();
        return;
      }
      if(curPage == 2) {
        start = 3;
        end = 4;
      }
      else if(curPage == 3) {
        start = 3;
        end = 5;
      }
      else if(curPage == 4) {
        start = 3;
        end = 6;
      }
      else if(curPage == totalPage - 1) {
        start = totalPage - 3;
        end = totalPage - 2;
      }
      else if(curPage == totalPage - 2) {
        start = totalPage - 4;
        end = totalPage - 2;
      }
      else if(curPage == totalPage - 3) {
        start = totalPage - 5;
        end = totalPage - 2;
      }
      else {
        start = curPage - 2;
        end = curPage + 2;
      }
      var link = '';
      link += `<a href="#blog-filters" class="pagination-num first" page="1">1</a>`
      link += `<a href="#blog-filters" class="pagination-num${2 == curPage ? ' active' : ''}" page="2">2</a>`
      if(start >= 4) {
        link += '<span>...</span>'
      }
      for(i = start;i <= end;i ++) {
        link += `<a href="#blog-filters" class="pagination-num${i == curPage ? ' active' : ''}" page="${i}">${i}</a>`
      }
      if(end <= totalPage - 3) {
        link += '<span>...</span>'
      }
      link += `<a href="#blog-filters" class="pagination-num${totalPage - 1 == curPage ? ' active' : ''}" page="${totalPage - 1}">${totalPage - 1}</a>`
      link += `<a href="#blog-filters" class="pagination-num end" page="${totalPage}">${totalPage}</a>`
      $list.attr('data-paged', curPage);
      ajaxCPT();
      
      $('.blog-paginations').empty().append(link);
    })
    //pagination

    // $('.pre-delivery-form').find('.pre-delivery-form-submit').css('cssText', 'display: none !important');
    // $('.pre-delivery-form-prev').css('cssText', 'display: none !important');
    // $('.pre-delivery-form-next').attr('step', '1');
    // $('.pre-delivery-form').find('.step-2').css('display', 'none');
    // $('.pre-delivery-form').find('.step-3').css('display', 'none');
    // $('.pre-delivery-form').find('.step-4').css('display', 'none');
    // $('.pre-delivery-form').find('.step-5').css('display', 'none');
    
    // $('.pre-delivery-form-next').on('click', function(){
    //   var attr = parseInt($('.pre-delivery-form-next').attr('step'));

    //   var style = $('.pre-delivery-form-prev').attr('style');
    //   // console.log(style)
    //   style += 'display: table !important';
    //   $('.pre-delivery-form-prev').css('cssText', style);
    //   if(attr == 4) {
    //     $('.pre-delivery-form-next').css('cssText', 'display: none !important');
    //     $('.pre-delivery-form-prev').css('cssText', 'margin-top: -88px !important; display: table !important');
    //     $('.pre-delivery-form-submit').css('cssText', 'display: block !important');
    //   }
    //   $('.pre-delivery-form-next').attr('step', attr + 1);
    //   $('.pre-delivery-form').find(`.step-${attr}`).css('display', 'none');
    //   $('.pre-delivery-form').find(`.step-${attr + 1}`).css('display', 'block');

      
    // })
    // $('.pre-delivery-form-prev').on('click', function(){
    //   var attr = parseInt($('.pre-delivery-form-next').attr('step'));
    //   $('.pre-delivery-form-prev').css('cssText', 'display: table !important');
    //   if(attr == 2) {
    //     $('.pre-delivery-form-prev').css('cssText', 'display: none !important');
    //   }
    //   else if(attr == 5) {
    //     $('.pre-delivery-form').find('.pre-delivery-form-submit').css('cssText', 'display: none !important');
    //   }
    //   var style = $('.pre-delivery-form-next').attr('style');
    //   style += 'display: table !important';
    //   console.log(style)
    //   $('.pre-delivery-form-next').css('cssText', style);
    //   $('.pre-delivery-form-next').attr('step', attr - 1);
    //   $('.pre-delivery-form').find(`.step-${attr}`).css('display', 'none');
    //   $('.pre-delivery-form').find(`.step-${attr - 1}`).css('display', 'block');
    // })

    /*
    var validator = $('.pre-delivery-form-1 form').validate({invalidHandler: function(event, validator) {
        var errors = validator.errorList;
        console.log(errors);
      }
    });

    $('.pre-delivery-form-1 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });
    // $('.pre-delivery-form-2 form').validate();
    // $('.pre-delivery-form-3 form').validate();
    // $('.pre-delivery-form-4 form').validate();
    // $('.pre-delivery-form-5 form').validate();
    $('a.tcb-button-link.tve-form-button-submit.tcb-plain-text').off('click');
    $('a.tcb-button-link.tve-form-button-submit.tcb-plain-text').on('click', (e) => {
      console.log('12123123123');
      e.preventDefault();
      e.stopPropagation();
      if (!$('.pre-delivery-form-1 form').valid()) {
        // alert('Invalid');
      } else {
        // alert('Next step');
        $('.')
        var formData = $('.pre-delivery-form-1 form').serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
        }, {});
        if (!window.multiformData) {
          window.multiformData = {};
        }
        window.multiformData = {...window.multiformData, ...formData};
        console.log(window.multiformData);
      }
    });
    */
    $('.pre-delivery-form-1 form').validate({invalidHandler: function(event, validator) {
        var errors = validator.errorList;
      }
    });
    $('.pre-delivery-form-1 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });

    $('.pre-delivery-form-2 form').validate({invalidHandler: function(event, validator) {
      var errors = validator.errorList;
    }
    });
    $('.pre-delivery-form-2 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });

    $('.pre-delivery-form-3 form').validate({invalidHandler: function(event, validator) {
      var errors = validator.errorList;
    }
    });
    $('.pre-delivery-form-3 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });

    $('.pre-delivery-form-4 form').validate({invalidHandler: function(event, validator) {
      var errors = validator.errorList;
    }
    });
    $('.pre-delivery-form-4 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });

    $('.pre-delivery-form-5 form').validate({invalidHandler: function(event, validator) {
      var errors = validator.errorList;
    }
    });
    $('.pre-delivery-form-5 *[data-required="1"]').each(function() {
      $(this).rules('add', {
        required: true,
      });
    });


    $('.pre-delivery-form-next').find('.tcb-button-link').off('click');
    $('.pre-delivery-form-next').find('.tcb-button-link').on('click', function(e) {
      ind = parseInt($(this).parent().attr('id'));
      e.preventDefault();
      e.stopPropagation();
      if (!$(`.pre-delivery-form-${ind} form`).valid()) {
      } else {
        console.log($(`.pre-delivery-form-${ind + 1}`).closest('.tl-style'));
        $(`.pre-delivery-form-${ind}`).closest('.tl-style').css('cssText', 'display: none')
        $(`.pre-delivery-form-${ind + 1}`).closest('.tl-style').css('cssText', 'display: block');
        // $('.tl-style').eq(ind - 1).css('cssText', 'display: none !important');
        // $('.tl-style').eq(ind).css('cssText', 'display: block !important');
        var formData = $(`.pre-delivery-form-${ind} form`).serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
        }, {});
        if (!window.multiformData) {
          window.multiformData = {};
        }
        window.multiformData = {...window.multiformData, ...formData};
        console.log(window.multiformData);
      }
    });

    $('.pre-delivery-form-last').on('click', function(e) {
      e.preventDefault();
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        xhrFields: {
          withCredentials: !0
        },
        dataType: "json",
        data: window.multiformData,
        success: function(response) {
          // Handle the success response
          console.log('Form submitted successfully', response);
        },
        error: function(xhr, status, error) {
          // Handle any error response
          console.error('Form submission failed', xhr.responseText);
        }
      });
    })
  })
});