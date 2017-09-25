;(function($) {
    var hostname = window.location.hostname,
        gaLiveID = 'UA-106895575-1',
        gaStageID = 'UA-106895575-2',
        activeID = 'UA-106895575-3' // Local

    if (hostname === 'meditationincolorado.org') {
        activeID = gaLiveID
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=UA-106895575-1"
        />
    } else if (hostname.includes('staging')) {
        activeID = gaStageID
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=UA-106895575-2"
        />
    } else {
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=UA-106895575-3"
        />
    }

    console.log(activeID)

    window.dataLayer = window.dataLayer || []
    function gtag() {
        dataLayer.push(arguments)
    }
    gtag('js', new Date())
    gtag('config', activeID)
})(jQuery)
