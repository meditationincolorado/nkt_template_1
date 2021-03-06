/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
;(function($) {
  var body = $('body'),
    _window = $(window),
    nav,
    button,
    menu,
    calendar

  nav = $('#primary-navigation')
  button = nav.find('.menu-toggle')
  menu = nav.find('.nav-menu')
  $calendar = $('body').find('#calendar')

  var $bannerCTA = $('#banner-cta'),
    $bannerCTAclose = $bannerCTA.find('a#close'),
    $bannerCTAopen = $('#reveal-cta'),
    $mainNav = $('nav#main-nav'),
    $scrollToTop = $('#scroll-to-top'),
    $locations = $('.locations-header'),
    navCloseDelay = 10000,
    closeNav = function() {
      $bannerCTA.addClass('hidden')
      $mainNav.removeClass('banner-cta')
      $subNav.removeClass('with-banner')
      $bannerCTAopen.removeClass('retracted')
      clearTimeout(autoHideBannerCTA)
    },
    openNav = function() {
      $bannerCTA.removeClass('hidden')
      $mainNav.addClass('banner-cta')
      $subNav.addClass('with-banner')
      $bannerCTAopen.addClass('retracted')
    }

  var autoHideBannerCTA = setTimeout(closeNav, navCloseDelay)
  $bannerCTAclose.click(function() {
    closeNav()
  })
  $bannerCTAopen.click(function() {
    openNav()
  })

  var $hero = $('#hero'),
    $heroScrollCTA = $hero.find('.scroll-cta'),
    $bannerAd = $('#banner-cta'),
    $subNav = $('#sub-nav'),
    $subNavLinks = $subNav.find('a')

  $heroScrollCTA.click(function() {
    $('html,body').animate(
      {
        scrollTop: $hero.height(),
      },
      500
    )
  })
  $subNavLinks.click(function() {
    var $id = $(this).attr('id'),
      $destination = $('article#' + $id + ' h2')
    $('html,body').animate(
      {
        scrollTop: $destination.offset().top - 120,
      },
      500
    )
  })
  $('.cta').click(function() {
    var $cta = $(this).attr('data-cta'),
      $destination = $('[data-cta-destination="' + $cta + '"]')
    $('html,body').animate(
      {
        scrollTop: $destination.offset().top - 60,
      },
      1000
    )
  })

  $scrollToTop.on('click', function() {
    $('html,body').animate(
      {
        scrollTop: 0,
      },
      500
    )
  })

  var $hero = $('#hero, #subpage-hero')

  _window.on('scroll', function() {
    var $bannerCTAhidden = $bannerCTA.hasClass('hidden'),
      $bannerOffsetHeight = $bannerCTAhidden ? 0 : $bannerCTA.outerHeight()

    if (_window.scrollTop() > $hero.outerHeight() - $bannerOffsetHeight) {
      $subNav.addClass('fixed')
      $scrollToTop.removeClass('retracted')
      if (!$bannerCTAhidden) {
        $subNav.addClass('with-banner')
      }

      if (
        $locations.length != 0 &&
        _window.scrollTop() > $locations.offset().top
      ) {
        $scrollToTop.addClass('white')
      } else {
        $scrollToTop.removeClass('white')
      }
    } else {
      $subNav.removeClass('fixed with-banner')
      $bannerAd.removeClass('fixed')
      $scrollToTop.addClass('retracted')
    }

    if (_window.scrollTop() > 0) {
      $bannerAd.addClass('fixed')
    } else {
      $bannerAd.removeClass('fixed')
    }
  })

  var $locations = $('ul.locations'),
    $locItems = $locations.find('li')

  $locItems.click(function() {
    $('ul.locations li#active-location').removeAttr('id')
    $(this).attr('id', 'active-location')

    $('html,body').animate(
      {
        scrollTop: $locations.offset().top - 120,
      },
      250
    )
    initMap()
  })

  var setCookie = function(cname, cvalue, exdays) {
    var expires = ''

    if (exdays != null) {
      var d = new Date()
      d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000)
      expires = 'expires=' + d.toUTCString()
    }

    document.cookie = cname + '=' + cvalue + '; ' + expires
  }
  var getCookie = function(cname) {
    var name = cname + '='
    var ca = document.cookie.split(';')
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i]
      while (c.charAt(0) == ' ') c = c.substring(1)
      if (c.indexOf(name) === 0) return c.substring(name.length, c.length)
    }
    return ''
  }
  var deleteCookie = function(cname) {
    document.cookie = cname + '=; expires=Thu, 18 Dec 2013 12:00:00 '
  }
  var hideMe = function(me) {
    var $me = me

    $me.animate(
      {
        opacity: 0,
      },
      250,
      function() {
        $me.removeClass('show')
        $me.remove()
      }
    )
  }
  var $stickyAd = $('#sticky-blurb'),
    $stickyAdCookieName =
      'user-closed-sticky-blurb-' + $stickyAd.attr('data-name'),
    $close = $stickyAd.find('#close'),
    hideStickyAd = getCookie($stickyAdCookieName),
    closeCookieDuration = 1 / 24 //hour
  hideStickyAd ? $stickyAd.remove() : $stickyAd.addClass('show')

  $(
    '#sticky-blurb #close, #sticky-copy a.sticky-cta, #hero, .feature-section, #footer-contact, footer'
  ).on('click', function(e) {
    e.stopPropagation()

    if ($(this).attr('id') == 'close') {
      setCookie($stickyAdCookieName, true, closeCookieDuration) //don't bother user for a day
    } else if ($(this).hasClass('sticky-cta')) {
      setCookie($stickyAdCookieName, true, 365) //don't bother user for a day
    }
    hideMe($stickyAd)
  })

  var $vimeos = $('.vimeo_video').find('iframe'),
    aspectRatio = 0.5625

  if ($vimeos.length) {
    $(document).ready(function() {
      $vimeos.css({
        height: $vimeos.outerWidth() * aspectRatio,
      })
    })
    $(window).resize(function() {
      $vimeos.css({
        height: $vimeos.outerWidth() * aspectRatio,
      })
    })
  }

  var $multipleItems = $('.multiple_items .slide')

  $multipleItems.each(function() {
    $(this).css({
      'background-color': $(this).attr('data-bkg-color'),
    })
  })

  var playingMeditation = false,
    meditationDurationInMinutes = 10,
    meditationDurationInSeconds = 60 * meditationDurationInMinutes

  $('.start-meditation').on('click', function() {
    if (!playingMeditation) {
      var $timer = $('#timer'),
        timeElapsed = 0
      $(this)
        .find('hgroup')
        .append($timer)

      var interval = setInterval(function() {
        var timeLeftinSeconds = meditationDurationInSeconds - timeElapsed,
          seconds = timeLeftinSeconds % 60,
          minutes = Math.floor(timeLeftinSeconds / 60).toFixed(0)

        document.getElementById('timer').innerHTML =
          minutes + ' min ' + seconds + ' sec'
        timeElapsed++
      }, 1000)
    } else {
      clearInterval(interval)
      document.getElementById('timer').innerHTML = 0
    }

    playingMeditation = !playingMeditation
  })

  /* TABS */
  var $navSections = $('.nav-section')

  $navSections.each(function() {
    var $navSection = $(this),
      $headers = $navSection.find('h4'),
      $subHeaders = $navSection.find('h5'),
      $eventsSection = $(this).find('#Events-and-Retreats')

    if ($headers.length > 0) {
      var headerCt = 0

      $navSection
        .find('h2')
        .after('<div class="content"></div>')
        .after('<span class="tabs"></span>')

      if ($eventsSection.length) {
        var tabText =
          '<a class="tab" data-num="' + 0 + '">' + 'Tara Empowerment' + '</a>' //headerCt
        $navSection.find('span.tabs').append(tabText)
      }

      $headers.each(function() {
        var $header = $(this),
          $contentDiv = $navSection.find('.content'),
          $sectionContent = $header.next('section'),
          $subHeaders = $sectionContent.find('h5'),
          tabText =
            '<a class="tab" data-num="' +
            headerCt +
            '">' +
            $header.text() +
            '</a>'

        $header.hide()
        $sectionContent.attr('data-num', headerCt)
        if (headerCt == 0) $sectionContent.addClass('active')
        $sectionContent.append($sectionContent)

        $header
          .parents('.nav-section')
          .find('span.tabs')
          .append(tabText)

        if ($subHeaders.length > 0) {
          var subHeaderCt = 0

          $subHeaders.each(function() {
            var $subHeader = $(this),
              $articleContent = $subHeader.next('article'),
              $articleParent = $subHeader.closest('section[data-num]'),
              isActive = subHeaderCt == 0 ? ' active' : '',
              bullet = subHeaderCt == $subHeaders.length - 1 ? '' : ' &bull; ',
              subTabText =
                '<a class="sub-tab' +
                isActive +
                ' " data-num="' +
                subHeaderCt +
                '">' +
                $subHeader.text() +
                '</a>' // + bullet;

            if ($articleParent.find('.sub-tabs').length == 0) {
              $articleParent.prepend('<span class="sub-tabs"></span>')
            }

            $subHeader.hide()
            $articleParent.find('.sub-tabs').append(subTabText)

            $articleContent
              .addClass(!subHeaderCt ? 'active' : '')
              .addClass('sub-section')
              .attr('data-num', subHeaderCt++)
          })

          $subHeaders.remove()
        }

        headerCt++
      })

      $navSection.find('a.tab[data-num="0"]').addClass('active')

      var $tabs = $(this).find('a.tab'),
        $subTabs = $(this).find('a.sub-tab')

      $tabs.on('click', function() {
        var $tab = $(this),
          $tabNum = $tab.attr('data-num'),
          $content = $navSection.find('section[data-num="' + $tabNum + '"]'),
          $allContent = $navSection.find('section[data-num]')

        $allContent.removeClass('active')
        $content.addClass('active')

        $tabs.removeClass('active')
        $tab.addClass('active')
      })

      $subTabs.on('click', function() {
        var $tab = $(this),
          $tabNum = $tab.attr('data-num'),
          $article = $navSection.find('article[data-num="' + $tabNum + '"]'),
          $allArticles = $navSection.find('article[data-num]'),
          $siblingTabs = $tab.siblings('.sub-tab')

        $allArticles.removeClass('active')
        $article.addClass('active')
        $siblingTabs.removeClass('active')
        $tab.addClass('active')
      })

      $headers.remove()
    }
  })

  function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href
    }
    name = name.replace(/[\[\]]/g, '\\$&')
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url)
    if (!results) return null
    if (!results[2]) return ''
    return decodeURIComponent(results[2].replace(/\+/g, ' '))
  }

  /* CALENDAR */
  if ($calendar.length) {
    $(document).ready(function() {
      var dayOfWeek = getParameterByName('dayOfWeek'),
        className = getParameterByName('className'),
        $destination = $('article#' + dayOfWeek + ' h2')

      if ($destination.length) {
        $('html,body').animate(
          {
            scrollTop: $destination.offset().top - 120,
          },
          500
        )
      }

      var $dayLinks = $('[data-day] li')

      $dayLinks.on('click', function() {
        var $day = $(this)
            .closest('[data-day]')
            .attr('data-day'),
          $destination = $('article#' + $day + ' h2')

        if ($destination.length) {
          var $className = $(this)
            .find('span')
            .text()

          $('html,body').animate(
            {
              scrollTop: $destination.offset().top - 120,
            },
            500
          )
        }
      })
    })

    var days = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
      ],
      months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
      ],
      abbreviations = {
        'Offering to the Spiritual Guide': 'OSG',
        'Wishfulfilling Jewel': 'WFJ',
        'Capitol Hill': 'CH',
      },
      pujas = [
        'Offering to the Spiritual Guide',
        'Heart Jewel',
        'Wishfulfilling Jewel',
      ],
      offset = 0,
      monthHeader = $calendar.siblings('h2#month')

    var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth(),
      d = date.getDate()
    var firstDay = new Date(y, m, 1)
    var lastDay = new Date(y, m + 1, 0),
      year = date.getFullYear(),
      todaysMonth = months[m],
      daysInMonth = new Date(year, date.getMonth() + 1, 0).getDate(),
      daysInPreviousMonth =
        date.getMonth() != 0
          ? new Date(year, date.getMonth(), 0).getDate()
          : new Date(year - 1, 12, 0).getDate()

    monthHeader.text(todaysMonth + ' ' + year)

    //console.log('days in month');
    //console.log(new Date(year, date.getMonth()+1, 0).getDate());
    /* finding offset if 1st doesn't fall on Sunday */
    for (i = 0; i < 7; i++) {
      if (firstDay.toString().substring(0, 3) == days[i].substring(0, 3)) {
        offset = i
        break
      }
    }

    for (i = 0; i < 42; i++) {
      var dayNum =
        i < offset
          ? daysInPreviousMonth - (offset - i - 1)
          : (i - offset) % 31 + 1
      var otherClass = i < offset || i - offset > daysInMonth - 1 ? 'other' : ''

      //if we have a full week of an upcoming month no need to display/add it to calendar
      if (
        dayNum == 1 &&
        i > 0 &&
        days[i % 7] == 'Sunday' &&
        otherClass == 'other'
      ) {
        break
      }

      $calendar.append(
        '<div class="day ' +
          otherClass +
          '" data-num="' +
          dayNum +
          '" data-month="' +
          todaysMonth +
          '" data-day="' +
          days[i % 7] +
          '"><span class="date">' +
          dayNum +
          ' <span class="dayOfWeek">- ' +
          days[i % 7] +
          '</span></span><ul></ul></div>'
      )
    }

    var $today = $calendar
      .find('[data-num="' + d + '"][data-month="' + todaysMonth + '"]')
      .first()

    $today
      .addClass('today')
      .find('.dayOfWeek')
      .text(' - today')

    /* Getting information from Google API generated section */
    var $data = $('#google-api-output')
    $data.find('article').each(function() {
      var $title = $(this)
          .find('.title')
          .text(),
        $month = $(this)
          .find('.month')
          .text(),
        $dayNum = $(this)
          .find('.dayNum')
          .text(),
        $time = $(this)
          .find('.time')
          .text(),
        $endTime = $(this)
          .find('.endTime')
          .text(),
        location = $(this)
          .find('.location')
          .text(),
        liClass = '',
        classType = ''
      classLocation = ''

      if ($title.includes(' - Puja')) {
        $title = $title.replace(' - Puja', '')
        classType = 'puja'
      } else if ($title.includes(' - Beginner')) {
        $title = $title.replace(' - Beginner', '')
        classType = 'beginner'
      } else if ($title.includes(' - FP/TTP')) {
        $title = $title.replace(' - FP/TTP', '')
        classType = 'fp-ttp'
      } else if ($title.includes(' - Retreat')) {
        $title = $title.replace(' - Retreat', '')
        classType = 'retreat'
      }

      if (location.includes('Glenarm')) {
        classLocation = 'downtown'
      } else if (location.includes('Marion')) {
        classLocation = 'cap-hill'
      } else if (location.includes('Aurora')) {
        classLocation = 'aurora'
      } else if (location.includes('Colorado Springs')) {
        classLocation = 'colorado-springs'
      }

      var $dayList = $calendar.find(
          '[data-month="' +
            $month +
            '"][data-num="' +
            $dayNum +
            '"]:not(.other) ul'
        ),
        $day = $dayList.closest('.day')

      $day.addClass('isClass')
      $dayList.append(
        '<li data-location="' +
          classLocation +
          '" data-type="' +
          classType +
          '"><span><strong>' +
          $title +
          '</strong></span><br/>' +
          $time +
          '-' +
          $endTime +
          '</li>'
      )
    })

    /* Handle user's filtration */
    var $filter = $('#filter'),
      $options = $filter.find('input'),
      $all = $filter.find('input#all'),
      $pujas = $filter.find('input#pujas'),
      $beginner = $filter.find('input#beginner'),
      $fp_ttp = $filter.find('input#fp-ttp'),
      $retreats = $filter.find('input#retreats'),
      $downtown = $filter.find('input#downtown'),
      $day = $('.day'),
      $listing = $day.find('li')

    $options.on('click', function() {
      var typeSelection = [],
        locationSelection = []

      $options.each(function() {
        if ($(this).is(':checked') && $(this).hasClass('type')) {
          typeSelection.push($(this).attr('id'))
        } else if ($(this).is(':checked') && $(this).hasClass('location')) {
          locationSelection.push($(this).attr('id'))
        }
      })

      $listing.each(function() {
        if (
          (!locationSelection.length &&
            typeSelection.includes($(this).attr('data-type'))) ||
          (locationSelection.length &&
            typeSelection.includes($(this).attr('data-type')) &&
            locationSelection.includes($(this).attr('data-location')))
        ) {
          $(this)
            .addClass('showing')
            .show()
        } else {
          $(this)
            .removeClass('showing')
            .hide()
        }
      })
      /*for(i = 0; i < typeSelection.length; i++) {
				$listing.each(function() {
					if($(this).hasClass(typeSelection[i])) {
						$(this).show().addClass('showing');
					} else {
						$(this).hide().removeClass('showing');
					}
				});
			}*/
    })

    /*$all.on('click', function() {
			($pujas.is(':checked')) ? $('li.puja').addClass('showing').show() : $('li.puja').removeClass('showing').hide();
			($beginner.is(':checked')) ? $('li.beginner').addClass('showing').show() : $('li.beginner').removeClass('showing').hide();
			($fp_ttp.is(':checked')) ? $('li.fp-ttp').addClass('showing').show() : $('li.fp-ttp').removeClass('showing').hide();
			($retreats.is(':checked')) ? $('li.retreat').addClass('showing').show() : $('li.retreat').removeClass('showing').hide();

			($downtown.is(':checked')) ? $('li.downtown').addClass('showing').show() : $('li.downtown').removeClass('showing').hide();

			($(this).is(':checked')) ? $('li').not('.showing').show() : $('li').not('.showing').hide();
		});
		$pujas.on('click', function() {
			if(!$all.is(':checked')){
				($(this).is(':checked')) ? $('li.puja').addClass('showing').show() : $('li.puja').removeClass('showing').hide();
			}
		});
		$beginner.on('click', function() {
			if(!$all.is(':checked')){
				($(this).is(':checked')) ? $('li.beginner').addClass('showing').show() : $('li.beginner').removeClass('showing').hide();
			}
		});
		$fp_ttp.on('click', function() {
			if(!$all.is(':checked')){
				($(this).is(':checked')) ? $('li.fp-ttp').addClass('showing').show() : $('li.fp-ttp').removeClass('showing').hide();
			}
		});
		$retreats.on('click', function() {
			if(!$all.is(':checked')){
				($(this).is(':checked')) ? $('li.retreat').addClass('showing').show() : $('li.retreat').removeClass('showing').hide();
			}
		});
		$downtown.on('click', function() {
			if(!$all.is(':checked')){
				($(this).is(':checked')) ? $('li.downtown').addClass('showing').show() : $('li.downtown').removeClass('showing').hide();
			}
		});*/
  }

  /* FOOTER CONTACT */
  var $footerContact = $('#footer-contact'),
    $homeForms = $('[data-tier]'),
    $convertedUser = 'signed-up-for-tier-0',
    foundCorrectForm = false

  if (getCookie($convertedUser) == 'true') {
    $('#locations-section').after($footerContact)
  }
  if (getCookie('user-tier') == '0') {
    var $form = $footerContact.find('[data-tier="1"]')
    $form.find('p').prepend(getCookie('user-firstname') + ', ')
  }
  if (parseInt(getCookie('user-tier')) >= 2) {
    $footerContact.remove()
  }
  //show form according to tier
  $homeForms.each(function() {
    var cookieName =
      'signed-up-for-tier-' +
      $(this)
        .closest('[data-tier]')
        .attr('data-tier')
    if (foundCorrectForm || getCookie(cookieName) == 'true') {
      $(this).remove()
    } else {
      foundCorrectForm = true
      $(this).show()
    }
  })
  //submit form and set cookies
  $homeForms.submit(function() {
    var tier = $(this)
        .closest('[data-tier]')
        .attr('data-tier'),
      cookieName = 'signed-up-for-tier-' + tier
    setCookie(cookieName, true)
    setCookie('user-tier', parseInt(tier))

    /*if(parseInt(tier) >= 2) {
				tier = parseInt(tier) + 1;
				setCookie('user-tier', tier);
			}*/

    if (cookieName == $convertedUser) {
      setCookie('user-firstname', $homeForms.find('[name=firstname]').val())
      setCookie('user-lastname', $homeForms.find('[name=lastname]').val())
      setCookie('user-email', $homeForms.find('[name=email]').val())
    }
  })
})(jQuery)
