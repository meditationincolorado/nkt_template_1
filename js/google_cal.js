var apiString = 'https://www.googleapis.com/calendar/v3/calendars/',
    apiKeyParam = '?key=AIzaSyDKwlYvY8MyAiFQUb7GMZWW1vMzYWIKlFo',
    getEvents = '/events',
    singleEvents = '&singleEvents=true',
    orderBy = '&orderBy=startTime',
    timeMin = '&timeMin=2017-09-26T00:00:00Z',
    timeMax = '&timeMax=2017-10-1T23:59:59Z'

var glenarm_classes = apiString
    .concat('media@meditationincolorado.org')
    .concat(getEvents)
    .concat(apiKeyParam)
    .concat(singleEvents)
    .concat(orderBy)
    .concat(timeMin)
    .concat(timeMax)

var special_events =
    apiString +
    'meditationincolorado.org_l19o5o3uhcb4r7stv9affdjdg0%40group.calendar.google.com' +
    getEvents +
    apiKeyParam

$.ajax({
    url: glenarm_classes,
    success: function(result) {
        console.log(result.items)

        for (var i = 0; i < result.items.length; i++) {
            var title = result.items[i].summary,
                location = result.items[i].location,
                start = result.items[i].start.dateTime,
                end = result.items[i].end.dateTime

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
