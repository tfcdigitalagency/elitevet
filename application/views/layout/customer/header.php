<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css" data-tippy-stylesheet="">
        .tippy-iOS {
            cursor:pointer!important;
            -webkit-tap-highlight-color:transparent
        }
        .tippy-popper {
            transition-timing-function:cubic-bezier(.165, .84, .44, 1);
            max-width:calc(100% - 8px);
            pointer-events:none;
            outline:0
        }
        .tippy-popper[x-placement^=top] .tippy-backdrop {
            border-radius:40% 40% 0 0
        }
        .tippy-popper[x-placement^=top] .tippy-roundarrow {
            bottom:-7px;
            bottom:-6.5px;
            -webkit-transform-origin:50% 0;
            transform-origin:50% 0;
            margin:0 3px
        }
        .tippy-popper[x-placement^=top] .tippy-roundarrow svg {
            position:absolute;
            left:0;
            -webkit-transform:rotate(180deg);
            transform:rotate(180deg)
        }
        .tippy-popper[x-placement^=top] .tippy-arrow {
            border-top:8px solid #333;
            border-right:8px solid transparent;
            border-left:8px solid transparent;
            bottom:-7px;
            margin:0 3px;
            -webkit-transform-origin:50% 0;
            transform-origin:50% 0
        }
        .tippy-popper[x-placement^=top] .tippy-backdrop {
            -webkit-transform-origin:0 25%;
            transform-origin:0 25%
        }
        .tippy-popper[x-placement^=top] .tippy-backdrop[data-state=visible] {
            -webkit-transform:scale(1) translate(-50%, -55%);
            transform:scale(1) translate(-50%, -55%)
        }
        .tippy-popper[x-placement^=top] .tippy-backdrop[data-state=hidden] {
            -webkit-transform:scale(.2) translate(-50%, -45%);
            transform:scale(.2) translate(-50%, -45%);
            opacity:0
        }
        .tippy-popper[x-placement^=top][data-animation=shift-toward][data-state=visible] {
            -webkit-transform:translateY(-10px);
            transform:translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=shift-toward][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(-20px);
            transform:translateY(-20px)
        }
        .tippy-popper[x-placement^=top][data-animation=perspective] {
            -webkit-transform-origin:bottom;
            transform-origin:bottom
        }
        .tippy-popper[x-placement^=top][data-animation=perspective][data-state=visible] {
            -webkit-transform:perspective(700px) translateY(-10px);
            transform:perspective(700px) translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=perspective][data-state=hidden] {
            opacity:0;
            -webkit-transform:perspective(700px) rotateX(60deg);
            transform:perspective(700px) rotateX(60deg)
        }
        .tippy-popper[x-placement^=top][data-animation=fade][data-state=visible] {
            -webkit-transform:translateY(-10px);
            transform:translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=fade][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(-10px);
            transform:translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=shift-away][data-state=visible] {
            -webkit-transform:translateY(-10px);
            transform:translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=shift-away][data-state=hidden] {
            opacity:0
        }
        .tippy-popper[x-placement^=top][data-animation=scale] {
            -webkit-transform-origin:bottom;
            transform-origin:bottom
        }
        .tippy-popper[x-placement^=top][data-animation=scale][data-state=visible] {
            -webkit-transform:translateY(-10px);
            transform:translateY(-10px)
        }
        .tippy-popper[x-placement^=top][data-animation=scale][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(-10px) scale(.5);
            transform:translateY(-10px) scale(.5)
        }
        .tippy-popper[x-placement^=bottom] .tippy-backdrop {
            border-radius:0 0 30% 30%
        }
        .tippy-popper[x-placement^=bottom] .tippy-roundarrow {
            top:-7px;
            -webkit-transform-origin:50% 100%;
            transform-origin:50% 100%;
            margin:0 3px
        }
        .tippy-popper[x-placement^=bottom] .tippy-roundarrow svg {
            position:absolute;
            left:0
        }
        .tippy-popper[x-placement^=bottom] .tippy-arrow {
            border-bottom:8px solid #333;
            border-right:8px solid transparent;
            border-left:8px solid transparent;
            top:-7px;
            margin:0 3px;
            -webkit-transform-origin:50% 100%;
            transform-origin:50% 100%
        }
        .tippy-popper[x-placement^=bottom] .tippy-backdrop {
            -webkit-transform-origin:0 -50%;
            transform-origin:0 -50%
        }
        .tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=visible] {
            -webkit-transform:scale(1) translate(-50%, -45%);
            transform:scale(1) translate(-50%, -45%)
        }
        .tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=hidden] {
            -webkit-transform:scale(.2) translate(-50%);
            transform:scale(.2) translate(-50%);
            opacity:0
        }
        .tippy-popper[x-placement^=bottom][data-animation=shift-toward][data-state=visible] {
            -webkit-transform:translateY(10px);
            transform:translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=shift-toward][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(20px);
            transform:translateY(20px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=perspective] {
            -webkit-transform-origin:top;
            transform-origin:top
        }
        .tippy-popper[x-placement^=bottom][data-animation=perspective][data-state=visible] {
            -webkit-transform:perspective(700px) translateY(10px);
            transform:perspective(700px) translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=perspective][data-state=hidden] {
            opacity:0;
            -webkit-transform:perspective(700px) rotateX(-60deg);
            transform:perspective(700px) rotateX(-60deg)
        }
        .tippy-popper[x-placement^=bottom][data-animation=fade][data-state=visible] {
            -webkit-transform:translateY(10px);
            transform:translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=fade][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(10px);
            transform:translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=shift-away][data-state=visible] {
            -webkit-transform:translateY(10px);
            transform:translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=shift-away][data-state=hidden] {
            opacity:0
        }
        .tippy-popper[x-placement^=bottom][data-animation=scale] {
            -webkit-transform-origin:top;
            transform-origin:top
        }
        .tippy-popper[x-placement^=bottom][data-animation=scale][data-state=visible] {
            -webkit-transform:translateY(10px);
            transform:translateY(10px)
        }
        .tippy-popper[x-placement^=bottom][data-animation=scale][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateY(10px) scale(.5);
            transform:translateY(10px) scale(.5)
        }
        .tippy-popper[x-placement^=left] .tippy-backdrop {
            border-radius:50% 0 0 50%
        }
        .tippy-popper[x-placement^=left] .tippy-roundarrow {
            right:-12px;
            -webkit-transform-origin:33.33333333% 50%;
            transform-origin:33.33333333% 50%;
            margin:3px 0
        }
        .tippy-popper[x-placement^=left] .tippy-roundarrow svg {
            position:absolute;
            left:0;
            -webkit-transform:rotate(90deg);
            transform:rotate(90deg)
        }
        .tippy-popper[x-placement^=left] .tippy-arrow {
            border-left:8px solid #333;
            border-top:8px solid transparent;
            border-bottom:8px solid transparent;
            right:-7px;
            margin:3px 0;
            -webkit-transform-origin:0 50%;
            transform-origin:0 50%
        }
        .tippy-popper[x-placement^=left] .tippy-backdrop {
            -webkit-transform-origin:50% 0;
            transform-origin:50% 0
        }
        .tippy-popper[x-placement^=left] .tippy-backdrop[data-state=visible] {
            -webkit-transform:scale(1) translate(-50%, -50%);
            transform:scale(1) translate(-50%, -50%)
        }
        .tippy-popper[x-placement^=left] .tippy-backdrop[data-state=hidden] {
            -webkit-transform:scale(.2) translate(-75%, -50%);
            transform:scale(.2) translate(-75%, -50%);
            opacity:0
        }
        .tippy-popper[x-placement^=left][data-animation=shift-toward][data-state=visible] {
            -webkit-transform:translateX(-10px);
            transform:translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=shift-toward][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(-20px);
            transform:translateX(-20px)
        }
        .tippy-popper[x-placement^=left][data-animation=perspective] {
            -webkit-transform-origin:right;
            transform-origin:right
        }
        .tippy-popper[x-placement^=left][data-animation=perspective][data-state=visible] {
            -webkit-transform:perspective(700px) translateX(-10px);
            transform:perspective(700px) translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=perspective][data-state=hidden] {
            opacity:0;
            -webkit-transform:perspective(700px) rotateY(-60deg);
            transform:perspective(700px) rotateY(-60deg)
        }
        .tippy-popper[x-placement^=left][data-animation=fade][data-state=visible] {
            -webkit-transform:translateX(-10px);
            transform:translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=fade][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(-10px);
            transform:translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=shift-away][data-state=visible] {
            -webkit-transform:translateX(-10px);
            transform:translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=shift-away][data-state=hidden] {
            opacity:0
        }
        .tippy-popper[x-placement^=left][data-animation=scale] {
            -webkit-transform-origin:right;
            transform-origin:right
        }
        .tippy-popper[x-placement^=left][data-animation=scale][data-state=visible] {
            -webkit-transform:translateX(-10px);
            transform:translateX(-10px)
        }
        .tippy-popper[x-placement^=left][data-animation=scale][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(-10px) scale(.5);
            transform:translateX(-10px) scale(.5)
        }
        .tippy-popper[x-placement^=right] .tippy-backdrop {
            border-radius:0 50% 50% 0
        }
        .tippy-popper[x-placement^=right] .tippy-roundarrow {
            left:-12px;
            -webkit-transform-origin:66.66666666% 50%;
            transform-origin:66.66666666% 50%;
            margin:3px 0
        }
        .tippy-popper[x-placement^=right] .tippy-roundarrow svg {
            position:absolute;
            left:0;
            -webkit-transform:rotate(-90deg);
            transform:rotate(-90deg)
        }
        .tippy-popper[x-placement^=right] .tippy-arrow {
            border-right:8px solid #333;
            border-top:8px solid transparent;
            border-bottom:8px solid transparent;
            left:-7px;
            margin:3px 0;
            -webkit-transform-origin:100% 50%;
            transform-origin:100% 50%
        }
        .tippy-popper[x-placement^=right] .tippy-backdrop {
            -webkit-transform-origin:-50% 0;
            transform-origin:-50% 0
        }
        .tippy-popper[x-placement^=right] .tippy-backdrop[data-state=visible] {
            -webkit-transform:scale(1) translate(-50%, -50%);
            transform:scale(1) translate(-50%, -50%)
        }
        .tippy-popper[x-placement^=right] .tippy-backdrop[data-state=hidden] {
            -webkit-transform:scale(.2) translate(-25%, -50%);
            transform:scale(.2) translate(-25%, -50%);
            opacity:0
        }
        .tippy-popper[x-placement^=right][data-animation=shift-toward][data-state=visible] {
            -webkit-transform:translateX(10px);
            transform:translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=shift-toward][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(20px);
            transform:translateX(20px)
        }
        .tippy-popper[x-placement^=right][data-animation=perspective] {
            -webkit-transform-origin:left;
            transform-origin:left
        }
        .tippy-popper[x-placement^=right][data-animation=perspective][data-state=visible] {
            -webkit-transform:perspective(700px) translateX(10px);
            transform:perspective(700px) translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=perspective][data-state=hidden] {
            opacity:0;
            -webkit-transform:perspective(700px) rotateY(60deg);
            transform:perspective(700px) rotateY(60deg)
        }
        .tippy-popper[x-placement^=right][data-animation=fade][data-state=visible] {
            -webkit-transform:translateX(10px);
            transform:translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=fade][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(10px);
            transform:translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=shift-away][data-state=visible] {
            -webkit-transform:translateX(10px);
            transform:translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=shift-away][data-state=hidden] {
            opacity:0
        }
        .tippy-popper[x-placement^=right][data-animation=scale] {
            -webkit-transform-origin:left;
            transform-origin:left
        }
        .tippy-popper[x-placement^=right][data-animation=scale][data-state=visible] {
            -webkit-transform:translateX(10px);
            transform:translateX(10px)
        }
        .tippy-popper[x-placement^=right][data-animation=scale][data-state=hidden] {
            opacity:0;
            -webkit-transform:translateX(10px) scale(.5);
            transform:translateX(10px) scale(.5)
        }
        .tippy-tooltip {
            position:relative;
            color:#fff;
            border-radius:.25rem;
            font-size:.875rem;
            padding:.3125rem .5625rem;
            line-height:1.4;
            text-align:center;
            background-color:#333
        }
        .tippy-tooltip[data-size=small] {
            padding:.1875rem .375rem;
            font-size:.75rem
        }
        .tippy-tooltip[data-size=large] {
            padding:.375rem .75rem;
            font-size:1rem
        }
        .tippy-tooltip[data-animatefill] {
            overflow:hidden;
            background-color:initial
        }
        .tippy-tooltip[data-interactive], .tippy-tooltip[data-interactive] .tippy-roundarrow path {
            pointer-events:auto
        }
        .tippy-tooltip[data-inertia][data-state=visible] {
            transition-timing-function:cubic-bezier(.54, 1.5, .38, 1.11)
        }
        .tippy-tooltip[data-inertia][data-state=hidden] {
            transition-timing-function:ease
        }
        .tippy-arrow, .tippy-roundarrow {
            position:absolute;
            width:0;
            height:0
        }
        .tippy-roundarrow {
            width:18px;
            height:7px;
            fill:#333;
            pointer-events:none
        }
        .tippy-backdrop {
            position:absolute;
            background-color:#333;
            border-radius:50%;
            width:calc(110% + 2rem);
            left:50%;
            top:50%;
            z-index:-1;
            transition:all cubic-bezier(.46, .1, .52, .98);
            -webkit-backface-visibility:hidden;
            backface-visibility:hidden
        }
        .tippy-backdrop:after {
            content:"";
            float:left;
            padding-top:100%
        }
        .tippy-backdrop+.tippy-content {
            transition-property:opacity;
            will-change:opacity
        }
        .tippy-backdrop+.tippy-content[data-state=hidden] {
            opacity:0
        }
        body {
            overflow-x: hidden !important;
        }
    </style>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title>Disable Veteran Digital Engagements Portal</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="dns-prefetch" href="https://s.w.org/">
    <link rel="alternate" type="application/rss+xml" title=" » Feed" href="https://ncdeliteveterans.org/">
    <link rel="alternate" type="application/rss+xml" title=" » Comments Feed" href="https://ncdeliteveterans.org/">
    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/svg\/",
            "svgExt": ".svg",
            "source": {
                "concatemoji": "https:\/\/ncdeliteveterans.org\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.5.3"
            }
        };
        !function (e, a, t) {
            var r, n, o, i, p = a.createElement("canvas"),
                s = p.getContext && p.getContext("2d");

            function c(e, t) {
                var a = String.fromCharCode;
                s.clearRect(0, 0, p.width, p.height), s.fillText(a.apply(this, e), 0, 0);
                var r = p.toDataURL();
                return s.clearRect(0, 0, p.width, p.height), s.fillText(a.apply(this, t), 0, 0), r === p.toDataURL()
            }
            function l(e) {
                if (!s || !s.fillText) return !1;
                switch (s.textBaseline = "top", s.font = "600 32px Arial", e) {
                    case "flag":
                        return !c([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) && (!c([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !c([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]));
                    case "emoji":
                        return !c([55357, 56424, 8205, 55356, 57212], [55357, 56424, 8203, 55356, 57212])
                }
                return !1
            }
            function d(e) {
                var t = a.createElement("script");
                t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
            }
            for (i = Array("flag", "emoji"), t.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, o = 0; o < i.length; o++) t.supports[i[o]] = l(i[o]), t.supports.everything = t.supports.everything && t.supports[i[o]], "flag" !== i[o] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[i[o]]);
            t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () {
                t.DOMReady = !0
            }, t.supports.everything || (n = function () {
                t.readyCallback()
            }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () {
                "complete" === a.readyState && t.readyCallback()
            })), (r = t.source || {}).concatemoji ? d(r.concatemoji) : r.wpemoji && r.twemoji && (d(r.twemoji), d(r.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <script src="<?=base_url().'assets/customer_assets'?>/wp-emoji-release.min.js" type="text/javascript" defer=""></script>
    <style type="text/css">
        img.wp-smiley, img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>

    <link rel="stylesheet" id="wp-block-library-css" href="<?=base_url().'assets/customer_assets'?>/style.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="pafe-extension-style-free-css" href="<?=base_url().'assets/customer_assets'?>/extension.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="hello-elementor-css" href="<?=base_url().'assets/customer_assets'?>/style.min(1).css" type="text/css" media="all">
    <link rel="stylesheet" id="hello-elementor-theme-style-css" href="<?=base_url().'assets/customer_assets'?>/theme.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-css" href="<?=base_url().'assets/customer_assets'?>/elementor-icons.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-animations-css" href="<?=base_url().'assets/customer_assets'?>/animations.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-frontend-css" href="<?=base_url().'assets/customer_assets'?>/frontend.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="powerpack-frontend-css" href="<?=base_url().'assets/customer_assets'?>/frontend.css"type="text/css" media="all">
    <link rel="stylesheet" id="elementor-pro-css" href="<?=base_url().'assets/customer_assets'?>/frontend.min(1).css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-global-css" href="<?=base_url().'assets/customer_assets'?>/global.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-post-10-css" href="<?=base_url().'assets/customer_assets'?>/post-10.css?v=1" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-post-243-css" href="<?=base_url().'assets/customer_assets'?>/post-243.css?v=1" type="text/css" media="all">
    <link rel="stylesheet" id="google-fonts-1-css" href="<?=base_url().'assets/customer_assets'?>/css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-shared-0-css" href="<?=base_url().'assets/customer_assets'?>/fontawesome.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-fa-solid-css" href="<?=base_url().'assets/customer_assets'?>/solid.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="elementor-icons-fa-brands-css" href="<?=base_url().'assets/customer_assets'?>/brands.min.css" type="text/css" media="all">

    <link
        href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
        rel="stylesheet"  type='text/css'>

    <script type="text/javascript" id="jquery-core-js-extra">
        /* <![CDATA[ */
        var pp = {
            "ajax_url": "https:\/\/ncdeliteveterans.org\/wp-admin\/admin-ajax.php"
        };
        /* ]]> */
    </script>
    <script type="text/javascript" src="<?=base_url().'assets/customer_assets'?>/jquery.js" id="jquery-core-js"></script>
    <script type="text/javascript" src="<?=base_url().'assets/customer_assets'?>/extension.min.js" id="pafe-extension-free-js"></script>

    <!-- Global stylesheets -->
    <link href="<?=base_url(GLOBAL_URL)?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?=base_url(GLOBAL_URL)?>js/main/jquery.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/main/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/loaders/blockui.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/notifications/pnotify.min.js"></script>
    <!-- /core JS files -->
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/validation/validate.min.js"></script>
    <!-- Theme JS files -->
    <script src="<?=base_url(ADMIN_URL)?>js/app.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/tables/datatables/datatables.min.js"></script>
    <!-- /theme JS files -->







    <script src="<?=base_url(CUSTOMER_URL)?>style/8033969.js.download" type="text/javascript" id="hs-analytics"></script>
    <script src="<?=base_url(CUSTOMER_URL)?>style/collectedforms.js.download" type="text/javascript"
            id="CollectedForms-8033969" crossorigin="anonymous" data-leadin-portal-id="8033969"
            data-leadin-env="prod" data-loader="hs-scriptloader" data-hsjs-portal="8033969"
            data-hsjs-env="prod" data-hsjs-hublet="na1"></script>
    <script src="<?=base_url(CUSTOMER_URL)?>style/8033969.js(1).download" type="text/javascript"
            id="cookieBanner-8033969" data-cookieconsent="ignore" data-loader="hs-scriptloader"
            data-hsjs-portal="8033969" data-hsjs-env="prod" data-hsjs-hublet="na1"></script>
    <script type="application/ld+json" class="yoast-schema-graph">
            {
                "@context": "https://schema.org",
                "@graph": [{
                    "@type": "WebSite",
                    "@id": "https://elitesdvob.org/#website",
                    "url": "https://elitesdvob.org/",
                    "name": "Elite SDVOB Network",
                    "description": "Advocacy | Education | Networking | Opportunity",
                    "potentialAction": [{
                        "@type": "SearchAction",
                        "target": "https://elitesdvob.org/?s={search_term_string}",
                        "query-input": "required name=search_term_string"
                    }],
                    "inLanguage": "en-US"
                }, {
                    "@type": "WebPage",
                    "@id": "https://elitesdvob.org/membership/#webpage",
                    "url": "https://elitesdvob.org/membership/",
                    "name": "Membership - Elite SDVOB Network",
                    "isPartOf": {
                        "@id": "https://elitesdvob.org/#website"
                    },
                    "datePublished": "2015-02-20T20:12:45+00:00",
                    "dateModified": "2020-08-12T15:49:51+00:00",
                    "inLanguage": "en-US",
                    "potentialAction": [{
                        "@type": "ReadAction",
                        "target": ["https://elitesdvob.org/membership/"]
                    }]
                }]
            }
        </script>
    <!-- / Yoast SEO plugin. -->
    <link rel="dns-prefetch" href="https://js.hs-scripts.com/">
    <link rel="dns-prefetch" href="https://s.w.org/">
    <link rel="alternate" type="application/rss+xml" title="Elite SDVOB Network » Feed"
          href="https://elitesdvob.org/feed/">
    <link rel="alternate" type="application/rss+xml" title="Elite SDVOB Network » Comments Feed"
          href="https://elitesdvob.org/comments/feed/">
    <link rel="alternate" type="text/calendar" title="Elite SDVOB Network » iCal Feed"
          href="https://elitesdvob.org/events/?ical=1">
    <link rel="alternate" type="application/rss+xml" title="Elite SDVOB Network » Membership Comments Feed"
          href="https://elitesdvob.org/membership/feed/">
    <meta property="og:title" content="Membership">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://elitesdvob.org/membership/">
    <meta property="og:site_name" content="Elite SDVOB Network">
    <meta property="og:description" content="JOIN ELITE A 501(c)19 non-profit veterans organization, the Elite SDVOB Network is an all-volunteer association">
    <meta property="og:image" content="https://elitesdvob.org/wp-content/uploads/2020/07/EliteLogoHeader-225x51-1.png">
    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/",
            "svgExt": ".svg",
            "source": {
                "concatemoji": "https:\/\/elitesdvob.org\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.6.2"
            }
        };
        !
            function (e, a, t) {
                var n, r, o, i = a.createElement("canvas"),
                    p = i.getContext && i.getContext("2d");

                function s(e, t) {
                    var a = String.fromCharCode;
                    p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0);
                    e = i.toDataURL();
                    return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL()
                }
                function c(e) {
                    var t = a.createElement("script");
                    t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
                }
                for (o = Array("flag", "emoji"), t.supports = {
                    everything: !0,
                    everythingExceptFlag: !0
                }, r = 0; r < o.length; r++) t.supports[o[r]] = function (e) {
                    if (!p || !p.fillText) return !1;
                    switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
                        case "flag":
                            return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]);
                        case "emoji":
                            return !s([55357, 56424, 8205, 55356, 57212], [55357, 56424, 8203, 55356, 57212])
                    }
                    return !1
                }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
                t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () {
                    t.DOMReady = !0
                }, t.supports.everything || (n = function () {
                    t.readyCallback()
                }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () {
                    "complete" === a.readyState && t.readyCallback()
                })), (n = t.source || {}).concatemoji ? c(n.concatemoji) : n.wpemoji && n.twemoji && (c(n.twemoji), c(n.wpemoji)))
            }(window, document, window._wpemojiSettings);
    </script>
    <script src="<?=base_url(CUSTOMER_URL)?>style/wp-emoji-release.min.js.download" type="text/javascript"
            defer=""></script>
    <style type="text/css">
        img.wp-smiley, img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel="stylesheet" id="atomic-blocks-fontawesome-css" href="<?=base_url(CUSTOMER_URL)?>style/all.min.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="layerslider-css" href="<?=base_url(CUSTOMER_URL)?>style/layerslider.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="tribe-common-skeleton-style-css" href="<?=base_url(CUSTOMER_URL)?>style/common-skeleton.min.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="tribe-tooltip-css" href="<?=base_url(CUSTOMER_URL)?>style/tooltip.min.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="atomic-blocks-style-css-css" href="<?=base_url(CUSTOMER_URL)?>style/blocks.style.build.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="wc-block-vendors-style-css" href="<?=base_url(CUSTOMER_URL)?>style/vendors-style.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="wc-block-style-css" href="<?=base_url(CUSTOMER_URL)?>style/style.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="bbp-default-css" href="<?=base_url(CUSTOMER_URL)?>style/bbpress.min.css"
          type="text/css" media="all">
    <link rel="stylesheet" id="rs-plugin-settings-css" href="<?=base_url(CUSTOMER_URL)?>style/rs6.css"
          type="text/css" media="all">
    <style id="rs-plugin-settings-inline-css" type="text/css">
        #rs-demo-id {
        }
    </style>
    <style id="woocommerce-inline-inline-css" type="text/css">
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>
    <link rel="stylesheet" id="avada-stylesheet-css" href="<?=base_url(CUSTOMER_URL)?>style/style.min.css"
          type="text/css" media="all">
    <!--[if IE]>
    <link rel='stylesheet' id='avada-IE-css' href='https://elitesdvob.org/wp-content/themes/Avada/assets/css/ie.min.css?ver=7.0.2'
          type='text/css' media='all' />
    <style id='avada-IE-inline-css' type='text/css'>
        .avada-select-parent .select-arrow {
            background-color:#ffffff
        }
        .select-arrow {
            background-color:#ffffff
        }
    </style>
    <![endif]-->
    <link rel="stylesheet" id="fusion-dynamic-css-css" href="<?=base_url(CUSTOMER_URL)?>style/a74962378238acb5da59562438143a5a.min.css"
          type="text/css" media="all">
    <script type="text/javascript" id="jquery-core-js-extra">
        /* <![CDATA[ */
        var slide_in = {
            "demo_dir": "https:\/\/elitesdvob.org\/wp-content\/plugins\/convertplug\/modules\/slide_in\/assets\/demos"
        };
        /* ]]> */
    </script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/jquery.min.js.download"
            id="jquery-core-js"></script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/jquery-migrate.min.js.download"
            id="jquery-migrate-js"></script>
    <script type="text/javascript" id="layerslider-utils-js-extra">
        /* <![CDATA[ */
        var LS_Meta = {
            "v": "6.11.2",
            "fixGSAP": "1"
        };
        /* ]]> */
    </script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/layerslider.utils.js.download"
            id="layerslider-utils-js"></script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/layerslider.kreaturamedia.jquery.js.download"
            id="layerslider-js"></script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/layerslider.transitions.js.download"
            id="layerslider-transitions-js"></script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/rbtools.min.js.download"
            id="tp-tools-js"></script>
    <script type="text/javascript" src="<?=base_url(CUSTOMER_URL)?>style/rs6.min.js.download"
            id="revmin-js"></script>
    <meta name="generator" content="Powered by LayerSlider 6.11.2 - Multi-Purpose, Responsive, Parallax, Mobile-Friendly Slider Plugin for WordPress.">
    <!-- LayerSlider updates and docs at: https://layerslider.kreaturamedia.com -->
    <link rel="https://api.w.org/" href="https://elitesdvob.org/wp-json/">
    <link rel="alternate" type="application/json" href="https://elitesdvob.org/wp-json/wp/v2/pages/16">
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://elitesdvob.org/xmlrpc.php?rsd">
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://elitesdvob.org/wp-includes/wlwmanifest.xml">
    <link rel="shortlink" href="https://elitesdvob.org/?p=16">
    <link rel="alternate" type="application/json+oembed" href="https://elitesdvob.org/wp-json/oembed/1.0/embed?url=https%3A%2F%2Felitesdvob.org%2Fmembership%2F">
    <link rel="alternate" type="text/xml+oembed" href="https://elitesdvob.org/wp-json/oembed/1.0/embed?url=https%3A%2F%2Felitesdvob.org%2Fmembership%2F&amp;format=xml">
    <!-- DO NOT COPY THIS SNIPPET! Start of Page Analytics Tracking for HubSpot
    WordPress plugin v7.44.6-->
    <script type="text/javascript">
        var _hsq = _hsq || [];
        _hsq.push(["setContentType", "standard-page"]);
    </script>
    <!-- DO NOT COPY THIS SNIPPET! End of Page Analytics Tracking
    for HubSpot WordPress plugin -->
    <script>
        (function () {
            var hbspt = window.hbspt = window.hbspt || {};
            hbspt.forms = hbspt.forms || {};
            hbspt._wpFormsQueue = [];
            hbspt.enqueueForm = function (formDef) {
                if (hbspt.forms && hbspt.forms.create) {
                    hbspt.forms.create(formDef);
                } else {
                    hbspt._wpFormsQueue.push(formDef);
                }
            }
            Object.defineProperty(window.hbspt.forms, 'create', {
                get: function () {
                    return hbspt._wpCreateForm;
                },
                set: function (value) {
                    hbspt._wpCreateForm = value;
                    for (var i = 0; i < hbspt._wpFormsQueue.length; i++) {
                        var formDef = hbspt._wpFormsQueue[i];
                        hbspt._wpCreateForm.call(hbspt.forms, formDef);
                    }
                },
            })
        })();
    </script>
    <link rel="manifest" href="https://elitesdvob.org/wp-json/wp/v2/web-app-manifest">
    <meta name="theme-color" content="#fff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="YES">
    <link rel="apple-touch-startup-image" href="https://elitesdvob.org/wp-content/uploads/2020/07/cropped-EliteLogo512x513-192x192.png">
    <meta name="apple-mobile-web-app-title" content="Elite SDVOB Network">
    <meta name="application-name" content="Elite SDVOB Network">
    <meta name="tec-api-version" content="v1">
    <meta name="tec-api-origin" content="https://elitesdvob.org">
    <link rel="https://theeventscalendar.com/" href="https://elitesdvob.org/wp-json/tribe/events/v1/">
    <style type="text/css" id="css-fb-visibility">
        @media screen and(max-width: 850px) {
            body:not(.fusion-builder-ui-wireframe) .fusion-no-small-visibility {
                display:none !important;
            }
            body:not(.fusion-builder-ui-wireframe) .sm-text-align-center {
                text-align:center !important;
            }
            body:not(.fusion-builder-ui-wireframe) .sm-text-align-left {
                text-align:left !important;
            }
            body:not(.fusion-builder-ui-wireframe) .sm-text-align-right {
                text-align:right !important;
            }
            body:not(.fusion-builder-ui-wireframe) .fusion-absolute-position-small {
                position:absolute;
                top:auto;
                width:100%;
            }
        }
        @media screen and(min-width: 851px) and(max-width: 1024px) {
            body:not(.fusion-builder-ui-wireframe) .fusion-no-medium-visibility {
                display:none !important;
            }
            body:not(.fusion-builder-ui-wireframe) .md-text-align-center {
                text-align:center !important;
            }
            body:not(.fusion-builder-ui-wireframe) .md-text-align-left {
                text-align:left !important;
            }
            body:not(.fusion-builder-ui-wireframe) .md-text-align-right {
                text-align:right !important;
            }
            body:not(.fusion-builder-ui-wireframe) .fusion-absolute-position-medium {
                position:absolute;
                top:auto;
                width:100%;
            }
        }
        @media screen and(min-width: 1025px) {
            body:not(.fusion-builder-ui-wireframe) .fusion-no-large-visibility {
                display:none !important;
            }
            body:not(.fusion-builder-ui-wireframe) .lg-text-align-center {
                text-align:center !important;
            }
            body:not(.fusion-builder-ui-wireframe) .lg-text-align-left {
                text-align:left !important;
            }
            body:not(.fusion-builder-ui-wireframe) .lg-text-align-right {
                text-align:right !important;
            }
            body:not(.fusion-builder-ui-wireframe) .fusion-absolute-position-large {
                position:absolute;
                top:auto;
                width:100%;
            }
        }
    </style>
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <style type="text/css">
        .recentcomments a {
            display:inline !important;
            padding:0 !important;
            margin:0 !important;
        }
    </style>
    <meta name="generator" content="Powered by Slider Revolution 6.2.17 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface.">
    <link rel="icon" href="https://elitesdvob.org/wp-content/uploads/2020/07/cropped-EliteLogo512x513-32x32.png"
          sizes="32x32">
    <link rel="icon" href="https://elitesdvob.org/wp-content/uploads/2020/07/cropped-EliteLogo512x513-192x192.png"
          sizes="192x192">
    <link rel="apple-touch-icon" href="https://elitesdvob.org/wp-content/uploads/2020/07/cropped-EliteLogo512x513-180x180.png">
    <meta name="msapplication-TileImage" content="https://elitesdvob.org/wp-content/uploads/2020/07/cropped-EliteLogo512x513-270x270.png">
    <script type="text/javascript">
        function setREVStartSize(e) {
            //window.requestAnimationFrame(function() {
            window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
            window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
            try {
                var pw = document.getElementById(e.c).parentNode.offsetWidth,
                    newh;
                pw = pw === 0 || isNaN(pw) ? window.RSIW : pw;
                e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
                e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
                e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
                e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
                e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
                e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
                e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
                if (e.layout === "fullscreen" || e.l === "fullscreen") newh = Math.max(e.mh, window.RSIH);
                else {
                    e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                    for (var i in e.rl) if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
                    e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
                    e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                    for (var i in e.rl) if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];

                    var nl = new Array(e.rl.length),
                        ix = 0,
                        sl;
                    e.tabw = e.tabhide >= pw ? 0 : e.tabw;
                    e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
                    e.tabh = e.tabhide >= pw ? 0 : e.tabh;
                    e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
                    for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
                    sl = nl[0];
                    for (var i in nl) if (sl > nl[i] && nl[i] > 0) {
                        sl = nl[i];
                        ix = i;
                    }
                    var m = pw > (e.gw[ix] + e.tabw + e.thumbw) ? 1 : (pw - (e.tabw + e.thumbw)) / (e.gw[ix]);
                    newh = (e.gh[ix] * m) + (e.tabh + e.thumbh);
                }
                if (window.rs_init_css === undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
                document.getElementById(e.c).height = newh + "px";
                window.rs_init_css.innerHTML += "#" + e.c + "_wrapper { height: " + newh + "px }";
            } catch (e) {
                console.log("Failure at Presize of Slider:" + e)
            }
            //});
        };
    </script>
    <script type="text/javascript">
        var doc = document.documentElement;
        doc.setAttribute('data-useragent', navigator.userAgent);
    </script>

    <style type="text/css">
        /* Chart.js */
        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity:0.99
            }
            to {
                opacity:1
            }
        }
        @keyframes chartjs-render-animation {
            from {
                opacity:0.99
            }
            to {
                opacity:1
            }
        }
        .chartjs-render-monitor {
            -webkit-animation:chartjs-render-animation 0.001s;
            animation:chartjs-render-animation 0.001s;
        }
    </style>
    <style id="fit-vids-style">
        .fluid-width-video-wrapper {
            width:100%;
            position:relative;
            padding:0;
        }
        .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed {
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
        }
    </style>
    <script>
        var base_url = '<?= base_url() ?>';
    </script>

</head>

<body class="page <?php echo $this->router->fetch_class();?> <?php echo $this->router->fetch_class();?>_<?php echo $this->router->fetch_method();?>">
    <div data-elementor-type="header" data-elementor-id="243" class="elementor elementor-243 elementor-location-header" data-elementor-settings="[]">
		<div class="elementor-inner">
			<div class="elementor-section-wrap">
				<section class="elementor-element elementor-element-9af2c1e elementor-section-full_width elementor-hidden-phone elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="9af2c1e" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
					<div class="elementor-background-overlay"></div>
					<div class="elementor-container elementor-column-gap-default">
						<div class="elementor-row">
							<div class="elementor-element elementor-element-c4d7c8e elementor-column elementor-col-20 elementor-top-column" data-id="c4d7c8e" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-360a46d elementor-icon-list--layout-inline elementor-align-center elementor-widget elementor-widget-icon-list" data-id="360a46d" data-element_type="widget" data-widget_type="icon-list.default">
											<div class="elementor-widget-container">
												<ul class="elementor-icon-list-items elementor-inline-items">
                                                	<li class="elementor-icon-list-item">
														<a href="https://www.facebook.com/elitesdvobnetworkusa/" target="_blank" class="elementor-icon-list-icon"><i class="fa fa-facebook-f"></i></a>
														<span class="elementor-icon-list-text"></span>
													</li>
													<li class="elementor-icon-list-item">
														<a href="https://twitter.com/elitesdvobusa?lang=en" target="_blank" class="elementor-icon-list-icon"><i class="fa fa-twitter"></i></a>
														<span class="elementor-icon-list-text"></span>
													</li>
													<li class="elementor-icon-list-item">
                                                    <a href="https://www.linkedin.com/in/elitesdvob/" target="_blank" class="elementor-icon-list-icon"><i class="fa fa-linkedin-in"></i></a>
														<span class="elementor-icon-list-text"></span>
														</li>
													<li class="elementor-icon-list-item">
                                                    <a href="https://www.youtube.com/channel/UCn0l1CT67W1jU2zYu8FxYbg" target="_blank" class="elementor-icon-list-icon"><i class="fa fa-youtube"></i></a>
														<span class="elementor-icon-list-text"></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="elementor-element elementor-element-4c10ff7 elementor-column elementor-col-20 elementor-top-column" data-id="4c10ff7" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-c9c41f6 elementor-widget elementor-widget-heading" data-id="c9c41f6" data-element_type="widget" data-widget_type="heading.default">
											<div class="elementor-widget-container"><h2 class="elementor-heading-title elementor-size-default">Elite Service Disabled Veteran Owned Business Network - a 501(c)19 Non-Profit Veterans Organization</h2></div>
										</div>
									</div>
								</div>
							</div>
                            <?php if(empty($this->session->userdata('user'))):?>
							<div class="elementor-element elementor-element-acb5425 elementor-column elementor-col-20 elementor-top-column" data-id="acb5425" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-eddc551 elementor-align-right elementor-widget elementor-widget-button" data-id="eddc551" data-element_type="widget" data-widget_type="button.default">
											<div class="elementor-widget-container">
												<div class="elementor-button-wrapper">
													<a href="<?=base_url().'auth/login'?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
														<span class="elementor-button-content-wrapper">
														<span class="elementor-button-icon elementor-align-icon-left">
														<i class="fa fa-lock"></i></span>
														<span class="elementor-button-text">Login</span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="elementor-element elementor-element-6b53945 elementor-column elementor-col-20 elementor-top-column" data-id="6b53945" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-5f51efb elementor-widget elementor-widget-heading" data-id="5f51efb" data-element_type="widget" data-widget_type="heading.default">
											<div class="elementor-widget-container"><h2 class="elementor-heading-title elementor-size-default">/</h2></div>
										</div>
									</div>
								</div>
							</div>
                            <?php endif;?>
							<div class="elementor-element elementor-element-0bcfee7 elementor-column elementor-col-20 elementor-top-column" data-id="0bcfee7" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-5920941 elementor-align-left elementor-widget elementor-widget-button" data-id="5920941" data-element_type="widget" data-widget_type="button.default">
											<div class="elementor-widget-container">
												<div class="elementor-button-wrapper">
													<a href="<?=(!empty($this->session->userdata('user')))?base_url().'auth/logout':base_url().'auth/register'?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
														<span class="elementor-button-content-wrapper">
														<span class="elementor-button-text"><?=!empty($this->session->userdata('user')) ? "Logout": "Register";?></span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="elementor-element elementor-element-d12f52c elementor-section-full_width elementor-section-stretched elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle elementor-section elementor-top-section elementor-sticky" data-id="d12f52c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}" style="width: 1905px; left: 0px;">
					<div class="elementor-container elementor-column-gap-no">
						<div class="elementor-row">
							<div class="elementor-element elementor-element-753ab4a elementor-column elementor-col-20 elementor-top-column" data-id="753ab4a" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-ae87601 elementor-widget elementor-widget-image" data-id="ae87601" data-element_type="widget" data-widget_type="image.default">
											<div class="elementor-widget-container">
												<div class="elementor-image">
													<img width="198" height="68" src="<?=base_url().'assets/customer_assets'?>/Group-9.png" class="attachment-large size-large" alt="" loading="lazy">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="elementor-element elementor-element-0d744b0 elementor-hidden-desktop elementor-hidden-tablet elementor-column elementor-col-20 elementor-top-column" data-id="0d744b0" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-86ec6db elementor-align-right elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="86ec6db" data-element_type="widget" data-widget_type="button.default">
											<div class="elementor-widget-container">
												<div class="elementor-button-wrapper">
													<a href="<?=base_url().'auth/login'?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
														<span class="elementor-button-content-wrapper">
															<span class="elementor-button-icon elementor-align-icon-left"><i class="fa fa-lock"></i></span>
															<span class="elementor-button-text">Login</span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="elementor-element elementor-element-54be085 elementor-hidden-desktop elementor-hidden-tablet elementor-column elementor-col-20 elementor-top-column" data-id="54be085" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-e48b737 elementor-widget elementor-widget-heading" data-id="e48b737" data-element_type="widget" data-widget_type="heading.default">
											<div class="elementor-widget-container"><h2 class="elementor-heading-title elementor-size-default">/</h2></div>
										</div>
									</div>
								</div>
							</div>
							<div class="elementor-element elementor-element-d905062 elementor-hidden-desktop elementor-hidden-tablet elementor-column elementor-col-20 elementor-top-column" data-id="d905062" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-d409aa9 elementor-align-right elementor-mobile-align-right elementor-widget elementor-widget-button" data-id="d409aa9" data-element_type="widget" data-widget_type="button.default">
											<div class="elementor-widget-container">
												<div class="elementor-button-wrapper">
													<a href="<?=base_url().'auth/register'?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
														<span class="elementor-button-content-wrapper">
															<span class="elementor-button-text">Register</span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="elementor-element elementor-element-2473e5f elementor-column elementor-col-20 elementor-top-column" data-id="2473e5f" data-element_type="column">
								<div class="elementor-column-wrap  elementor-element-populated">
									<div class="elementor-widget-wrap">
										<div class="elementor-element elementor-element-c85f928 elementor-nav-menu__align-right elementor-nav-menu--indicator-angle elementor-nav-menu--stretch elementor-nav-menu__text-align-center elementor-nav-menu--dropdown-tablet elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu" data-id="c85f928" data-element_type="widget" data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}" data-widget_type="nav-menu.default">
											<div class="elementor-widget-container">
												<?php include ('nav.php');?>

												<div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle" aria-expanded="false" style="">
													<i class="eicon-menu-bar" aria-hidden="true"></i>
													<span class="elementor-screen-only">Menu</span>
												</div>
												<nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" role="navigation" aria-hidden="true" style="top: 44px; width: 1905px; left: 0px;">
													<ul id="menu-2-c85f928" class="elementor-nav-menu" data-smartmenus-id="1606753235391349">
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item menu-item-82"><a href="<?=base_url().'customer/home'?>" aria-current="page" class="elementor-item <?=($id == 'home')?'elementor-item-active':'elementor-item-anchor'?>">Home</a></li>
														<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/event'?>" class="elementor-item <?=($id == 'event')?'elementor-item-active':'elementor-item-anchor'?>">EVENT</a></li>
														<!-- <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/mailing'?>" class="elementor-item elementor-item-anchor">MAILING</a></li> -->
														<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="<?=base_url().'customer/webinar'?>" class="elementor-item <?=($id == 'webinar')?'elementor-item-active':'elementor-item-anchor'?>">WEBINAR</a></li>
														<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/training'?>" class="elementor-item <?=($id == 'training')?'elementor-item-active':'elementor-item-anchor'?>">TRAINING</a></li>
														<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-88"><a href="<?=base_url().'news'?>" class="elementor-item <?=($id == 'news')?'elementor-item-active':'elementor-item-anchor'?>">NEWS</a></li>
														<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'customer/contact'?>" class="elementor-item <?=($id == 'contact')?'elementor-item-active':'elementor-item-anchor'?>">CONTACT</a></li>
													</ul>
												</nav>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
