<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Page Not Found :(</title>
        <style>
            ::-moz-selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            ::selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            html {
                padding: 30px 10px;
                font-size: 20px;
                line-height: 1.4;
                color: #737373;
                background: #f0f0f0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            html,
            input {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            body {
                max-width: 500px;
                _width: 500px;
                padding: 30px 40px 40px;
                border: 1px solid #ddd;
                margin: 0 auto;
                background: #fcfcfc;
            }

            .container {
                max-width: 380px;
                _width: 380px;
                margin: 0 auto;
                margin-left: 150px;
            }

            /* google search */

            #goog-fixurl ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #goog-fixurl form {
                margin: 0;
            }

            #goog-wm-qt,
            #goog-wm-sb {
                border: 1px solid #bbb;
                font-size: 16px;
                line-height: normal;
                vertical-align: top;
                color: #444;
                border-radius: 2px;
            }

            #goog-wm-qt {
                width: 220px;
                height: 20px;
                padding: 5px;
                margin: 5px 10px 0 0;
                box-shadow: inset 0 1px 1px #ccc;
            }

            #goog-wm-sb {
                display: inline-block;
                height: 32px;
                padding: 0 10px;
                margin: 5px 0 0;
                white-space: nowrap;
                cursor: pointer;
                background-color: #f5f5f5;
                background-image: -webkit-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -moz-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -ms-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -o-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                *overflow: visible;
                *display: inline;
                *zoom: 1;
            }

            #goog-wm-sb:hover,
            #goog-wm-sb:focus {
                border-color: #aaa;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                background-color: #f8f8f8;
            }

            #goog-wm-qt:hover,
            #goog-wm-qt:focus {
                border-color: #105cb6;
                outline: 0;
                color: #222;
            }

            input::-moz-focus-inner {
                padding: 0;
                border: 0;
            }

            .logo-hold {
                width: 110px;
                height: 100px;
                background: #0f75bc;
                position: absolute;
                top: 0;
            }

            .logo-hold:after {
                content: '';
                position: absolute;
                bottom: -25px;
                left: 0px;
                width: 0;
                height: 0;
                border-top: 25px solid #0f75bc;
                border-left: 55px solid transparent;
            }

            .logo-hold:before {
                content: '';
                position: absolute;
                bottom: -25px;
                right: 0px;
                width: 0;
                height: 0;
                border-top: 25px solid #0f75bc;
                border-right: 55px solid transparent;
            }

            a {
                text-decoration: none;
                background: #0f75bc;
                color: #fff;
                padding: 10px 20px;
                width: 110px;
                text-align: center;
                font-size: 15px;
            }

            @media screen and (max-width: 480px) {
                .container {
                    width: 100%;
                    max-width: 100%;
                    margin: 0 auto;
                }

                .logo-hold {
                    width: 100%;
                    height: 50px;
                    left: 0;
                }

                .logo-hold:after, .logo-hold:before {
                    position: relative;
                }
            }

        </style>
    </head>
    <body>
        <div class="logo-hold"></div>

        <div class="container">
            <h1>Not found <span>:(</span></h1>
            <p>Sorry, but the page you were trying to view does not exist.</p>
            <p>It looks like this was the result of either:</p>
            <ul>
                <li>a mistyped address</li>
                <li>an out-of-date link</li>
            </ul>

        </div>

        <a href="<?= base_url(); ?>">Homepage</a>
    </body>
</html>
