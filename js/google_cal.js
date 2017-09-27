// Setting up dates
function convertDate(date) {
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

function prettyTime(timeStr) {
    var ampm = 'am',
        startOfTimeIndex = timeStr.indexOf('T') + 1,
        hour = timeStr.substring(startOfTimeIndex, startOfTimeIndex + 2),
        minute = timeStr.substring(startOfTimeIndex + 3, timeStr.length - 9)

    if (parseInt(hour) > 12) {
        hour = (parseInt(hour) % 12).toString()
        ampm = 'pm'
    } else if (parseInt(hour) === 12) {
        ampm = 'pm'
    } else {
        hour = hour.substring(1, hour.length)
    }

    return hour
        .concat(':')
        .concat(minute)
        .concat(ampm)
}

var now = new Date(),
    week = new Date(),
    time = '00:00:00Z', //now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds(),
    today = convertDate(now) + 'T' + time

week.setDate(week.getDate() + 7)
var weekFromToday = convertDate(week) + 'T' + time

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
        console.log(result.items)

        for (var i = 0; i < result.items.length; i++) {
            var title = result.items[i].summary,
                location = result.items[i].location,
                start = prettyTime(result.items[i].start.dateTime),
                end = prettyTime(result.items[i].end.dateTime)

            // console.log(result.items[0])
            // $('#special-events').append(
            //     '<li class="cta_wrapper">' +
            //         '<a href="./classes?dayOfWeek=' +
            //         '$dayOfWeekToday' +
            //         '&className=' +
            //         '$hyphenatedClassName' +
            //         '" class="cta">' +
            //         '$cleanClassName' +
            //         '</a> <span class="info"><b>' +
            //         '$time' +
            //         ' to ' +
            //         '$endTime' +
            //         '</b> | <span class="address">' +
            //         '$event->location' +
            //         '</span></span></li>'
            // )
            $('#special-events').append(
                '<a class="class-btn">'.concat(title).concat('</a> ') +
                    '<span>'.concat(start).concat('</span> to ') +
                    '<span>'.concat(end).concat('</span>') +
                    '<p>At <a class="location">'
                        .concat(location)
                        .concat('</a></p>')
            )
        }
    },
})

// var special_events =
// apiString +
// 'meditationincolorado.org_l19o5o3uhcb4r7stv9affdjdg0%40group.calendar.google.com' +
// getEvents +
// apiKeyParam
