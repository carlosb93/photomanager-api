<html>
<head>
    {{-- <link href="{{asset('css/style-reports.css')}}" rel="stylesheet"> --}}
    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
         /* @import url(../fonts/font-awesome-4.7.0/css/font-awesome.min.css); */

body {
    background: #fff;
    font-family: "Poppins", sans-serif;
    margin: 0;
    overflow-x: hidden;
    color: #5C585B;
    font-weight: 400;
    margin-top: 3cm;
    margin-left: 1.5cm;
    margin-right: 1.5cm;
    margin-bottom: 2cm;
    font-size: 0.85rem;
    font-weight: normal;
    line-height: 1.5;
}

html {
    position: relative;
    zoom: 0%;
    min-height: 100%;
    background: #ffffff;
}

html body .mdi:before,
html body .mdi-set {

    line-height: initial;
}

/*******************
Headings
*******************/
h1,
h2,
h3,
h4,
h5,
h6 {
    color: #455a64;
    font-family: "Poppins", sans-serif;
    font-weight: 400;
}

h1 {
    line-height: 40px;
    font-size: 36px;
}

h2 {
    line-height: 36px;
    font-size: 24px;
}

h3 {
    line-height: 30px;
    font-size: 21px;
}

h4 {
    line-height: 22px;
    font-size: 13px;
}

h5 {
    line-height: 18px;
    font-size: 16px;
    font-weight: 400;
}

h6 {
    line-height: 16px;
    font-size: 13px;
    font-weight: 400;
}

.display-5 {
    font-size: 3rem;
}

.display-6 {
    font-size: 36px;
}

.box {
    border-radius: 4px;
    padding: 10px;
}

html body .dl {
    display: inline-block;
}

html body .db {
    display: block;
}

.no-wrap td,
.no-wrap th {
    white-space: nowrap;
}

/*******************
Blockquote
*******************/
html body blockquote {
    border-left: 5px solid #32A6A8;
    border: 1px solid rgba(120, 130, 140, 0.13);
    padding: 15px;
}

.clear {
    clear: both;
}

ol li {
    margin: 5px 0;
}

/*******************
Paddings
*******************/
html body .p-0 {
    padding: 0px;
}

html body .p-10 {
    padding: 10px;
}

html body .p-20 {
    padding: 20px;
}

html body .p-30 {
    padding: 30px;
}

html body .p-l-0 {
    padding-left: 0px;
}

html body .p-l-10 {
    padding-left: 10px;
}

html body .p-l-20 {
    padding-left: 20px;
}

html body .p-r-0 {
    padding-right: 0px;
}

html body .p-r-10 {
    padding-right: 10px;
}

html body .p-r-20 {
    padding-right: 20px;
}

html body .p-r-30 {
    padding-right: 30px;
}

html body .p-r-40 {
    padding-right: 40px;
}

html body .p-t-0 {
    padding-top: 0px;
}

html body .p-t-10 {
    padding-top: 10px;
}

html body .p-t-20 {
    padding-top: 20px;
}

html body .p-t-30 {
    padding-top: 30px;
}

html body .p-b-0 {
    padding-bottom: 0px;
}

html body .p-b-5 {
    padding-bottom: 5px;
}

html body .p-b-10 {
    padding-bottom: 10px;
}

html body .p-b-20 {
    padding-bottom: 20px;
}

html body .p-b-30 {
    padding-bottom: 30px;
}

html body .p-b-40 {
    padding-bottom: 40px;
}

/*******************
Margin
*******************/
html body .m-0 {
    margin: 0px;
}

html body .m-l-5 {
    margin-left: 5px;
}

html body .m-l-10 {
    margin-left: 10px;
}

html body .m-l-15 {
    margin-left: 15px;
}

html body .m-l-20 {
    margin-left: 20px;
}

html body .m-l-30 {
    margin-left: 30px;
}

html body .m-l-40 {
    margin-left: 40px;
}

html body .m-r-5 {
    margin-right: 5px;
}

html body .m-r-10 {
    margin-right: 10px;
}

html body .m-r-15 {
    margin-right: 15px;
}

html body .m-r-20 {
    margin-right: 20px;
}

html body .m-r-30 {
    margin-right: 30px;
}

html body .m-r-40 {
    margin-right: 40px;
}

html body .m-t-0 {
    margin-top: 0px;
}

html body .m-t-5 {
    margin-top: 5px;
}

html body .m-t-10 {
    margin-top: 10px;
}

html body .m-t-15 {
    margin-top: 15px;
}

html body .m-t-20 {
    margin-top: 20px;
}

html body .m-t-30 {
    margin-top: 30px;
}

html body .m-t-40 {
    margin-top: 40px;
}

html body .m-b-0 {
    margin-bottom: 0px;
}

html body .m-b-5 {
    margin-bottom: 5px;
}

html body .m-b-10 {
    margin-bottom: 10px;
}

html body .m-b-15 {
    margin-bottom: 15px;
}

html body .m-b-20 {
    margin-bottom: 20px;
}

html body .m-b-30 {
    margin-bottom: 30px;
}

html body .m-b-40 {
    margin-bottom: 40px;
}

/*******************
vertical alignment
*******************/
html body .vt {
    vertical-align: top;
}

html body .vm {
    vertical-align: middle;
}

html body .vb {
    vertical-align: bottom;
}

        @page {
            margin: 0cm 0cm;
        }

        .pagenumber:before {
            content: counter(page);
        }
        .pagecount:before {
            content: counter(pages);
        }

        /** Define now the real margins of every page in the PDF **/

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0.5cm;
            left: 1.5cm;
            right: 1.5cm;
            height: 2cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            color: #5C585B;
            font-weight: 400;
            font-size: 14px;
        }

        .card-no-border .card {
            border-color: #d7dfe3;
            border-radius: 4px;
            -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-header {
            padding: 0px 100px 0px 16px;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border: 1px solid rgba(0, 0, 0, .125);
        }

        h4 {
            line-height: 6px;
            font-size: 14px;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #455a64;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
        }

        .collapse.show {
            display: block;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
            border: 1px solid rgba(0, 0, 0, .125);
        }

        .table {
            width: 100%;
            max-width: 100%;
            background-color: transparent;
        }

        table {
            display: table;
            border-collapse: separate;
            border-spacing: 0px;
            border-color: grey;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table thead th, .table th {
            border: 0px;
        }

        .table thead th, .table th {
            font-weight: 500;
        }

        .table td, .table th {
            padding: 5px;
            vertical-align: top;
            border-top: 1px solid #e9ecef;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .pull-right {
            float: right;
        }

        p {
            text-align: justify;
            text-justify: inter-word;
        }

        .heading {
            font-weight: 600;
            font-size: 14px;
            color: #455a64;
        }

    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    <table id="header" cellspacing="0" style="width: 100%; font-size: 0.8em;">
        <tr align="center">
            <th style="width: 10%"  rowspan="3"><img src="{!! $logo !!}" width="110px"/></th>
            <th style="width: 64%;" rowspan="3">
                <div style="position: relative; top: 0px; font-size: 16px"><strong>{{$empresa->nombre}}</strong></div>
                <div style="position: relative; bottom: 0px;font-size: 16px"><strong>{{$title}}</strong></div>
            </th>
            <th>
                <div style="position: relative; top: 20px; border-left: 2px solid #FDB913; text-align: left ">
                    <div style="padding: 2px 7px"><strong>Código: {{ $codigo }}</strong></div>
                    <div style="padding: 2px 7px"><strong>Versión: 1.0 </strong></div>
                    <div style="padding: 2px 7px"><strong>Fecha: {{date('d/m/Y')}} </strong></div>
                </div>
            </th>
        </tr>
    </table>
</header>
<footer>
    <div>
        © {{ date('Y') }} RN2-AUTOCONTROL
    </div>
    <span> Página <span class="pagenumber"/> </span>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main id="pdf-content" style="position: relative; top: 1cm;float: left">
    @yield('content')
    {{--    <p style="reapage-bk-after: always;">--}}
    {{--        Content Page 1--}}
    {{--    </p>--}}
    {{--    <p style="page-break-after: never;">--}}
    {{--        Content Page 2--}}
    {{--    </p>--}}
</main>

</body>
</html>