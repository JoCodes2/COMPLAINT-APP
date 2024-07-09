<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
<link rel="icon" href="{{ asset('Image/SIPS.png') }}" type="image/png"/>
<style>
    /* page */

    .page {
        width: 178mm;
        min-height: 355.6mm;
        padding: 20mm;
        margin: 10mm auto;
    }
    /* header */
    .garis-tipis {
        border: 1px solid black;
        margin: 3px 0;
    }
    .garis-tebal {
        border: 3px solid black;
        margin: 3px 0;
    }
    .garis-antar {
        border: 1px solid black;
        margin: 3px 0;
    }

    /* title surat */
    .title-surat {
        text-align: center;
        margin: 0;
        color: black;
    }

    .title-letter {
        margin-bottom: 0;
        padding-bottom: 0;
        font-size: 14pt;
        font-weight: bold;
    }

    .no-letter {
        margin-top: 0;
        padding-top: 0;
        font-size: 14pt;
        font-weight: bold;
    }

    .underline {
        position: relative;
        display: inline-block;
    }

    .underline::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        height: 3px;
        width: 100%;
        background: black;
    }

    .title-letter, .no-letter {
        line-height: 1.5;
    }

    .header-logo{
        height: 120px;
        width: 120px;
    }
    .header-desc{
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }
    .header-desc .fn-1 {
        font-size: 18pt;
    }

    .header-desc .fn-2 {
        font-size: 20pt;
    }

    .header-desc .fn-3 {
        font-size: 15pt;
    }

    .header-desc .fn-4 {
        font-size: 12pt;
    }

    /* body letter */
    .acc-letter{
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        font-size: 12pt;

    }
    .biodata-acc-letter{
        width: 100%;
        border-collapse: collapse;
        margin-left: 30px;
        font-family: Arial;
        color: black !important;
        font-size: 12pt;
    }
    .text td:first-child {
        width: 153px;
    }

    .text td:nth-child(2) {
        width: 10px;
    }
    .table-form {
        width: 100%;
        border-collapse: collapse;
        margin-left: 30px;
    }
    .desc-footer-content{
        color: black !important;
        font-size: 12pt;
        font-family: Arial, Helvetica, sans-serif;
        padding-top: 2px;
    }
    p.font {
        line-height: 23px;
        font-size: 12pt;
    }

    p.indent {
        line-height: 23px;
        text-indent: 2em;
        font-size: 12pt;
    }

    /* footer letter */
    .footer-letter {
        right: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: black;

    }

    .date-letter,
    .tanda-tangan-letter {
        text-align: center;
    }

    .ket-out{
        font-size: 12pt;
        margin-top: 0;
        padding-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .ket-ttd{
        font-size: 12pt;
        margin-top: 0;
        padding-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }

</style>
<style>
    @page {
        size: legal;
        margin: 0;
    }
    @media print {
        /* Styles for the PDF output */
        .page-letter {
            width: 210mm; /* F4 width */
            height: 330mm; /* F4 height */
            padding: 20mm; /* Adjust padding to fit content */
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        .title-letter, .no-letter, .acc-letter, .desc-footer-content, .ket-ttd, .ket-out {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
            color: black;
        }

        .header-desc {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
        }

        .header-logo {
            height: 100px;
            width: 100px;
        }

        .body-letter .table-form td {
            font-size: 12pt;
        }

        .desc-footer-content p.indent {
            line-height: 23px;
            text-indent: 2em;
        }

        .footer-letter {
            bottom: 0; /* Position at the bottom */
            left: 0; /* Align to the left */
            right: 0; /* Align to the right */
            padding: 0; /* Remove padding */
            margin: 0; /* Remove margin */
        }
    }

    /* Print-specific styles */
    .print-mode body{
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Arial";
        text-align: justify;
        color: black !important;
    }
    .print-mode .page-letter{
        width: 210mm; /* F4 width */
        height: 330mm; /* F4 height */
        padding: 20mm; /* Adjust padding to fit content */
        margin: 0; /* Remove margins */
        position: relative; /* Set position to relative */
    }
    .print-mode .garis-tipis {
        border: 0.5px solid black;
        margin: 1px 0;
    }
    .print-mode .garis-tebal {
        border: 2px solid black;
        margin: 1px 0;
    }
    .print-mode  .garis-antar {
        border: 0.5px solid black;
        margin: 1px 0;
    }
    .print-mode .underline {
        position: relative;
        display: inline-block;
    }

    .print-mode .underline::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        height: 3px;
        width: 100%;
        background: black;
    }

    .print-mode .title-letter, .no-letter {
        line-height: 1.5;
    }

    .print-mode .title-letter, .print-mode .no-letter, .print-mode .acc-letter, .print-mode .desc-footer-content, .print-mode .ket-ttd, .print-mode .ket-out {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12pt;
        color: black;
    }

    .print-mode .header-desc {
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        margin: 0;
        padding: 0;
    }

   .print-mode  .header-desc h4, .header-desc h5, .header-desc p {
        margin: 0;
        padding: 0;
    }

    .print-mode .header-logo {
        height: 100px;
        width: 90px;
    }

    .print-mode .body-letter .table-form td {
        font-size: 12pt;
    }

    .print-mode .desc-footer-content p.indent {
        line-height: 23px;
        text-indent: 2em;
        margin: 0;
        padding: 0;
    }

    .print-mode .footer-letter {
        bottom: 0; /* Position at the bottom */
        left: 0; /* Align to the left */
        right: 0; /* Align to the right */
        padding: 0; /* Remove padding */
        margin: 0; /* Remove margin */
    }

    .print-mode .date-letter {
        margin: 0;
        padding: 0;
        line-height: 1;
    }

    .print-mode .date-letter p {
        margin: 0;
        padding: 0;
    }
    .print-mode .tanda-tangan-letter p {
        margin: 0 !important;
        padding: 0 !important;
    }
    .print-mode .ket-out{
        font-size: 12pt;
        margin-top: 0;
        padding-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .print-mode .ket-ttd{
        font-size: 12pt;
        margin-top: 0;
        padding-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }
</style>




