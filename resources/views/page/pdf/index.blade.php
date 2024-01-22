<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol, ul {
            list-style: none;
        }

        blockquote, q {
            quotes: none;
        }

        blockquote:before, blockquote:after,
        q:before, q:after {
            content: "";
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /*
        * Base
        */
        body {
            color: #222222;
            font-family: "Helvetica Neue", Arial, Verdana, "Nimbus Sans L", sans-serif;
            font-weight: normal;
            height: 100%;
            line-height: normal;
            text-rendering: optimizeLegibility;
        }

        h1 {
            font-size: 3em;
            font-weight: bold;
            line-height: 1.1em;
            margin: 0px 0px 70px 0;
            min-height: 80px;
            padding: 0px;
            width: 300px;
        }

        strong {
            font-weight: bold;
        }

        /*
    * Base
    */
        body {
            color: #222222;
            font-family: "Helvetica Neue", Arial, Verdana, "Nimbus Sans L", sans-serif;
            font-weight: normal;
            height: 100%;
            line-height: normal;
            text-rendering: optimizeLegibility;
            padding: 2em;
        }

        h1 {
            font-size: 3em;
            font-weight: bold;
            line-height: 1.1em;
            min-height: 80px;
            padding: 0px;
        }

        h2 {
            font-size: 2.5em;
            font-weight: bold;
            line-height: 1.1em;
            min-height: 50px;
            padding: 0px;
        }

        h3 {
            font-size: 2em;
            font-weight: bold;
            line-height: 1.1em;
            min-height: 20px;
            padding: 0px;
        }

        .formatted iframe {
            aspect-ratio: 16 / 9;
            width: 100%;
            height: auto;
        }

        .formatted > *:last-child {
            margin-bottom: 0 !important;
        }

        .formatted em {
            font-style: italic;
        }

        .formatted strong {
            font-weight: bold;
        }

        .formatted blockquote {
            border-left: 3px solid #ccc;
            padding-left: 1rem;
            margin-left: 1rem;
            padding-bottom: 0.5rem;
            padding-top: 0.5rem;
            font-size: 1.2rem;
        }

        .formatted blockquote p:last-child {
            margin-bottom: 0;
        }

        .formatted > *:last-child {
            margin-bottom: 0 !important;
        }

        .formatted details > summary {
            list-style: none;
        }

        .formatted details > summary::-webkit-details-marker {
            display: none;
        }

        .formatted a {
            text-decoration: underline;
        }

        .formatted a:hover {
            text-decoration: none;
            color: #3f83f8;
        }

        .formatted pre {
            margin: 2em 0;
            padding: 1em;
            color: #3f83f8;
            background-color: #f0f4f8;
            border-radius: 10px;
        }

        .formatted pre code {
            padding: 1em 2em;
        }

        .formatted p,
        .formatted ul,
        .formatted ol,
        .formatted blockquote {
            margin-top: 1rem;
            margin-bottom: 30px;
        }

        .formatted p,
        .formatted ul,
        .formatted ol {
            line-height: 1.6;
        }

        .formatted p:first-child {
            margin-top: 0px !important;
        }

        .formatted ul {
            list-style: disc;
            padding-left: 19px;
        }

        .formatted ol {
            list-style: decimal;
            padding-left: 19px;
        }

        .formatted img {
            max-width: 990px;
            width: auto;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }

        @media screen and (max-width: 990px) {
            .formatted img {
                max-width: 100vw;
            }
        }

        .formatted figure {
            padding: 0;
            margin: 30px;
            display: inline-block;
            position: relative;
        }

        .formatted figure.left {
            margin-left: 0;
            margin-top: 0;
        }

        .formatted figure.right {
            margin-right: 0;
            margin-top: 0;
        }

        .formatted figure img {
            border: 4px solid #eeeeee;
            display: block;
        }

        .formatted figure img[src$='.png'],
        .formatted figure img[src$='.svg'] {
            border: none;
        }

        .formatted p > code,
        .formatted li > code {
            display: inline-block;
            padding: 0 0.2em;
            background-color: #f0f4f8;
            color: #3f83f8;
        }

        .message {
            margin-bottom: 1rem;

            padding-left: 2rem;
            padding-bottom: 0.7rem;
            padding-top: 0.7rem;

            font-size: 1rem;

            display: flex;
            align-items: center;
        }

        .message svg {
            margin-right: 2rem;
            width: 1.5rem;
            height: 1.5rem
        }

        .message p:last-child {
            margin-bottom: 0;
        }

        .message-warning {
            border-left: 3px solid #fde047;
            background-color: #fef9c3;
        }

        .message-warning svg {
            color: #fde047;
        }

        .message-danger {
            border-left: 3px solid #ef4444;
            background-color: #fee2e2;
        }

        .message-danger svg {
            color: #ef4444;
        }

        .message-info {
            border-left: 3px solid #3b82f6;
            background-color: #dbeafe;
        }

        .message-info svg {
            color: #3b82f6;
        }
    </style>
</head>
<body class="formatted">
{!! $page->parse_content !!}
</body>
</html>

