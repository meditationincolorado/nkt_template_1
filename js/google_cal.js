function prettyTime(timeStr, meridian) {
  if (meridian === undefined) meridian = true

  var ampm = '',
    startOfTimeIndex = timeStr.indexOf('T') + 1,
    hour = timeStr.substring(startOfTimeIndex, startOfTimeIndex + 2),
    minute = timeStr.substring(startOfTimeIndex + 3, timeStr.length - 9)

  if (parseInt(hour) > 12) {
    hour = (parseInt(hour) % 12).toString()
    if (meridian) ampm = 'pm'
  } else if (parseInt(hour) === 12 && meridian) {
    ampm = 'pm'
  }

  if (hour.charAt(0) === '0') {
    hour = hour.substring(1, hour.length)
  }

  if (ampm !== null && !ampm) amppm = ''

  return hour
    .concat(':')
    .concat(minute)
    .concat(ampm)
}

var now = new Date(),
  week = new Date(),
  time = '01:00:0Z', //now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds(),
  today = convertDateForURLParam(now) + 'T' + time

week.setDate(week.getDate() + 5)
var weekFromToday = convertDateForURLParam(week) + 'T' + time

// API Implementation
var apiString = 'https://www.googleapis.com/calendar/v3/calendars/',
  apiKeyParam = '?key=AIzaSyDKwlYvY8MyAiFQUb7GMZWW1vMzYWIKlFo',
  getEvents = '/events',
  singleEvents = '&singleEvents=true',
  orderBy = '&orderBy=startTime',
  timeMin = '&timeMin='.concat(today),
  timeMax = '&timeMax='.concat(weekFromToday)

var glenarm_classes = apiString
  .concat('media@meditationincolorado.org')
  .concat(getEvents)
  .concat(apiKeyParam)
  .concat(singleEvents)
  .concat(orderBy)
  .concat(timeMin)
  .concat(timeMax)

$.ajax({
  url: glenarm_classes,
  success: function(result) {
    for (var i = 0; i < result.items.length; i++) {
      var title = result.items[i].summary,
        location = result.items[i].location,
        start = result.items[i].start.dateTime,
        end = result.items[i].end.dateTime,
        locationLink = setLocationLink(location)

      $('#calender-events').append(
        '<li>' +
          '<a class="class-btn" href="/classes?day='.concat(getDayName(start)) +
          '&class='.concat(title) +
          '">'.concat(getDayName(start)).concat('</a> ') +
          '<div class="info"><span>'.concat(title).concat(' | ') +
          prettyTime(start, false).concat(' to ') +
          prettyTime(end).concat(' @ ') +
          locationLink.concat('</span></div></li>')
      )
    }
  },
})

// Setting up location
var setLocationLink = function(location) {
  var tempLoc = '',
    tempAnchor = ''

  if (location.includes('Glenarm')) {
    tempLoc = 'Glenarm'
    tempAnchor = 'Downtown'
  } else if (location.includes('Marion')) {
    tempLoc = 'Cap Hill'
    tempAnchor = 'Cap-Hill'
  } else {
    tempLoc = location
  }

  return (
    '<a class="location" href="/contact#' +
    tempAnchor +
    '">'.concat(tempLoc).concat('</a>')
  )
}

// Setting up dates
var getDayName = (function() {
  return function(str) {
    var daysNames = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
      ],
      d = new Date(str)
    return daysNames[d.getDay()]
  }
})()
getDayName(new Date())

var getTravelDateFormatted = (function() {
  // Example  Mon Jan 23
  return function(str) {
    var daysNames = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
      ],
      monthNames = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'Septempber',
        'October',
        'November',
        'December',
      ],
      d = new Date(str),
      day = d.getDate(),
      month = monthNames[d.getMonth()],
      year = d
        .getFullYear()
        .toString()
        .substr(2, 2),
      hours = d.getHours(),
      minutes = d.getMinutes(),
      dayName = daysNames[d.getDay()]

    return hours > 12
      ? dayName +
          ' ' +
          month +
          ' ' +
          day +
          ' ' +
          (hours - 12) +
          ':' +
          minutes +
          ' PM'
      : dayName + ' ' + month + ' ' + day + ' ' + hours + ':' + minutes + ' AM'
  }
})()

var formatedDate = getTravelDateFormatted(new Date())

function convertDateForURLParam(date) {
  var yyyy = date.getFullYear().toString(),
    mm = (date.getMonth() + 1).toString(),
    dd = date.getDate().toString(),
    mmChars = mm.split(''),
    ddChars = dd.split('')

  return (
    yyyy +
    '-' +
    (mmChars[1] ? mm : '0' + mmChars[0]) +
    '-' +
    (ddChars[1] ? dd : '0' + ddChars[0])
  )
}
