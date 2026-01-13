<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>
        <style>
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                text-align: center;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                text-align: center;
            }

            body, html {
                color: #2c2b2b;
                background: #FFFFFF;
                font-size: 14px;
                font-family: "Myriad Pro", Arial, Helvetica, sans-serif;
            }

            ul {
                list-style: disc;
                padding-left: 30px;
            }

            ul li {
                margin-bottom: 5px;
            }

            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #14336E;
                text-decoration: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table th,
            table td {
                padding: 10px 0;
                background: #FFFFFF;
                border-bottom: 2px solid #EEEEEE;
            }

            table th {
                white-space: nowrap;
                font-weight: normal;
                color: #9fa2a2;
                text-align: left;
            }

            table td {
                text-align: left;
            }

            table tbody tr:last-child td {
                border: none;
            }
        </style>
    </head>
    <body>
        @yield("content")
    </body>
</html>
