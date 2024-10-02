(function ($) {
  'use strict';

  var Main = {
    initialize: function () {
      this.bindUIActions();
      this.screenEvents();
    },

    bindUIActions: function () {
      this.toggleSideNavigation();
      this.closeMenuOnResize();
      this.preventScrollOnHover();
      this.scrollToTopButton();
      this.smoothScrolling();
      this.selectTwo();
    },

    toggleSideNavigation: function () {
      $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
          $('.sidebar .collapse').collapse('hide');
        }
      });
    },

    closeMenuOnResize: function () {
      $(window).resize(function () {
        console.log('Window resized');
        if ($(window).width() < 768) {
          $('.sidebar .collapse').collapse('hide');
        }

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
          $("body").addClass("sidebar-toggled");
          $(".sidebar").addClass("toggled");
          $('.sidebar .collapse').collapse('hide');
        }
      });
    },

    preventScrollOnHover: function () {
      $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
          var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
          this.scrollTop += (delta < 0 ? 1 : -1) * 30;
          e.preventDefault();
        }
      });
    },

    scrollToTopButton: function () {
      $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
          $('.scroll-to-top').fadeIn();
        } else {
          $('.scroll-to-top').fadeOut();
        }
      });
    },

    smoothScrolling: function () {
      $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
          scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
      });
    },

    screenEvents: function () {
      // Showing password
      $('.btn-show-password').on('click', function () {
        var inputId = $(this).data('target');
        var input = $('#' + inputId);
        var icon = $(this).find('i');

        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
    },

    selectTwo: function () {
      $('.select2').select2({
        language: "pt-BR",
        theme: 'bootstrap',
      });
    },

    // Função auxiliar para exibir alertas SweetAlert2
    showAlert: function (type, title, text) {
      Swal.fire({
        icon: type,
        title: title,
        text: text
      });
    }
  };

  // Certifique-se de que o objeto Main está acessível globalmente
  window.Main = Main;

  $(function () {
    Main.initialize();
  });

})(jQuery);


/* Positions of notifications */
var stack_topleft = { "dir1": "down", "dir2": "right", "push": "top" };
var stack_bottomleft = { "dir1": "right", "dir2": "up", "push": "top" };
var stack_bottomleftup = { "dir1": "up", "dir2": "right", "push": "top" };
var stack_bottomright = { "dir1": "up", "dir2": "left", "firstpos1": 15, "firstpos2": 15 };
var stack_bar_top = { "dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0 };
var stack_bar_bottom = { "dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0 };