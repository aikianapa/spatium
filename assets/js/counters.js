(async function() {

    // Yandex.Metrika counter

    (function(m, e, t, r, i, k, a) {
        m[i] = m[i] || function() {
            (m[i].a = m[i].a || []).push(arguments)
        };

        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode
            .insertBefore(k, a)
    })

    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");



    ym(86835257, "init", {

        clickmap: true,

        trackLinks: true,

        accurateTrackBounce: true,

        webvisor: true

    });

    // Facebook Pixel Code

    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?

                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };

        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';

        n.queue = [];
        t = b.createElement(e);
        t.async = !0;

        t.src = v;
        s = b.getElementsByTagName(e)[0];

        s.parentNode.insertBefore(t, s)
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '590247188715538');

    fbq('track', 'PageView');
})