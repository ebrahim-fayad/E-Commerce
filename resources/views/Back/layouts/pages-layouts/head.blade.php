<!-- Site favicon -->
{{-- <link rel="apple-touch-icon" sizes="180x180" href="/back/vendors/images/apple-touch-icon.png" />
<link rel="icon" type="image/png" sizes="32x32" href="/back/vendors/images/favicon-32x32.png" /> --}}
{{-- <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/site/SITE_LOGO_17411720264148668925d4244e7.jpg') }}"> --}}
<link rel="icon" type="image/png" sizes="16x16" href="{{ general_setting()->site_favicon }}" />

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
<link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css" />
<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
{{-- <link rel="stylesheet" href="{{ asset('extra-assets/ijabo/ijabo.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.13.2/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css') }}">
<link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css') }}">
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            "gtm.start": new Date().getTime(),
            event: "gtm.js"
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
</script>
{{-- <link rel="stylesheet" href="{{ asset('extra-assets/ijabo') }}"> --}}
<link rel="stylesheet" href="{{ asset('extra-assets/ijaboCropTool/ijaboCropTool.min.css') }}">
@stack('stylesheets')
<!-- End Google Tag Manager -->
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
