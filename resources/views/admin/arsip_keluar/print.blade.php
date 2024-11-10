<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <iframe id="iframePDF" src="{{ Storage::url($arsip_keluar->lampiran) }}" frameborder="0"></iframe>
    <script>
        var iframe = document.getElementById('iframePDF');
        if (iframe.src) {
            var frm = iframe.contentWindow;

            frm.focus();// focus on contentWindow is needed on some versions
            frm.print();
        }
    </script>
</body>
</html>
