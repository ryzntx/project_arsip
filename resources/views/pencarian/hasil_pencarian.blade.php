<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($pencarian as $item)
        <p>{{$item->title}}</p><br>
        <p>{{mb_strimwidth($item->content, 0, 1000, '...')}}</p><br>
        <a href="{{ route('pencarian.detail', str_replace('+','-',urlencode(strtolower($item->title)))) }}">Lihat Selengkapnya</a>
    @endforeach
</body>
</html>
