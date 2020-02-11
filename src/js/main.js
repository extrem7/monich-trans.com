function menu() {
    $("#mobile-btn, .menu-container .close-btn").click(() => {
        $('.mobile-btn').toggleClass('open')
        $('body').toggleClass('open-modal')
        $('.menu-container').toggleClass('open-menu')
    })
}

function header() {
    if ($(this).scrollTop() > 60) {
        $(".header").addClass('sticky-header')

    } else {
        $(".header").removeClass('sticky-header')
    }

    let btn = $('.btn-up'),
        tempScrollTop,
        currentScrollTop = 0
    $(window).scroll(function () {
        currentScrollTop = $(window).scrollTop()
        if (tempScrollTop < currentScrollTop || currentScrollTop < 300) {
            /// $(".header").removeClass('sticky-header');
        } else if (tempScrollTop > currentScrollTop && currentScrollTop > 300) {
            /// $(".header").addClass('sticky-header');
        }
        tempScrollTop = currentScrollTop
    })


}

function owlCarousel() {

    let navText = ['<svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 20 23"><g><g><path fill="#ff8400" d="M.002 11.5L19.88.002v22.995L.002 11.5"/></g></g></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 20 23"><g><g><path fill="#ff8400" d="M19.998 11.5L.12.002v22.995L19.998 11.5"/></g></g></svg>']

    $('.owl-about').owlCarousel({
        margin: 30,
        nav: false,
        autoplay: true,
        autoplayTimeout: 6000,
        items: 1,
        loop: true,
        dots: true,
        smartSpeed: 1000
    })

    $('.owl-partner').owlCarousel({
        margin: 30,
        nav: true,
        navText: navText,
        autoplay: true,
        autoplayTimeout: 3000,
        items: 4,
        loop: true,
        dots: false,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            375: {
                items: 2
            },
            768: {
                items: 3
            },
            1199: {
                items: 4
            }
        }
    })
}

function counter() {
    $('div[data-count]').each(function () {
        let $this = $(this),
            countTo = $this.attr('data-count')

        $({countNum: $this.text()}).animate({
                countNum: countTo
            },

            {
                duration: 2000,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.countNum))
                },
                complete: function () {
                    $this.text(this.countNum)
                }

            })

    })
}

function order() {
    $('#order form, .consultation-block, .contact-form').on('submit', e => {
        e.preventDefault()
        const $form = $(e.currentTarget)
        const formData = new FormData($form[0])
        const spinner = $form.find('.spinner-border')

        spinner.animate({opacity: 1})

        $.ajax({
            url: shared().adminAjax,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success(res) {
                res = JSON.parse(res)
                $('#order').modal('hide')
                if (res.status === 'ok') {
                    $('#success').modal('show')
                    $form[0].reset()
                }
                setTimeout(() => {
                    $('#success').modal('hide')
                }, 5000)
            }
        }).done(() => {
            spinner.animate({opacity: 0})
        })
    })
    $('input[type=file]').on('change', function (e) {
        if (e.target.files.length) {
            $(this).next().text(e.target.files[0].name)
        } else {
            $(this).next().text($(this).siblings('span').text())
        }
    })
}

function shared() {
    return window.sharedData
}

$(() => {

    $("#btn-more").click(function () {
        $('html, body').animate({
            scrollTop: $(".section-about").offset().top - 50
        }, 2000)
    })

    if ($('.section-map').length) {
        new Waypoint({
            element: $('.section-map')[0],
            handler: () => {
                setTimeout(() => {
                    counter()
                }, 900)
            },
            offset: '50%'
        })
    }
    if (shared().locale !== 'en') {
        $.datepicker.setDefaults($.datepicker.regional[shared().locale])
    }
    if ($(".date-picker").length)
        $(".date-picker").datepicker()

    header()
    owlCarousel()
    menu()

    order()

    // $('input[type=tel]').inputmask("mask", {"mask": "+38099 999 99 99", "clearIncomplete": true})

    $('.load-items').on('click', function () {
        const selector = '.item-to-load',
            slice = $(this).hasClass('projects-load') ? 3 : 2
        $(selector).slice(0, slice).fadeIn().removeClass('item-to-load')
        if ($(selector).length === 0) {
            $(this).fadeOut()
        }
    })
})

$(window).on('load resize scroll', () => header())

$(window).on('load', () => {
    setTimeout(() => {
        $('.preloader .box').fadeOut(1000)
    }, 1000)
})




