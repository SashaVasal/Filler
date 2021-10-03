<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        .diamond-shape {
            height: 60px;
            text-align: center;
            transform:rotate(45deg);
            width:60px;
            background: red;
            position: absolute;
        }
        .tools{
            bottom:70px;
            position: absolute;
            width: 100%;
        }
    </style>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body style="background:#636b6f">
<h1 id="mytext"> Ход игрока номер: 1</h1>
<div class="flex-center position-ref full-height" id="color_field" style="text-align: center">

    @foreach($cells as $cell)
        <div class="container diamond-shape" style="top:{{$cell->y *45 +200}}px; left:{{$cell->x *45 + 50}}px; background: {{$cell->color}}" id="{{$cell->id}}" ></div>
    @endforeach
</div>
<div class="tools">
    <button style="width:13%; height:50px; background: blue" id="blue">blue </button>
    <button style="width:13%; height:50px; background: green" id="green">green</button>
    <button style="width:13%; height:50px; background: cyan" id="cyan">cyan </button>
    <button style="width:13%; height:50px; background: red" id="red">red </button>
    <button style="width:13%; height:50px; background: magenta" id="magenta">magenta </button>
    <button style="width:13%; height:50px; background: yellow" id="yellow">yellow </button>
    <button style="width:13%; height:50px; background: white" id="white">white </button>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function refresh_mypage(argument){
        if(argument[4] != 0){
            alert("победил " + argument[4] + " игрок");
            return;
        }
        $('#color_field').empty();
        arg = argument[0];

        text = argument[1];


        $("#mytext").empty();
        $("#mytext").text("Ход игрока номер:" + text + ". Процент захваченной клеток первым игроком = " + argument[2].toFixed(2) + "и процент захваченной клеток вторым игроком = " + argument[3].toFixed(2) );
        for (key in arg) {
            console.log(arg[key]);
            $('#color_field').append("<div class='container diamond-shape' style='top:"+(arg[key].y*45+200) +"px; left:"+(arg[key].x*45+ 50)+"px; background: "+arg[key].color+"' id='"+arg[key].id+"'> </div>");

        }
    }
    $('#blue').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'blue',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#green').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'green',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#cyan').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'cyan',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#red').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'red',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#magenta').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'magenta',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#yellow').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'yellow',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })
    $('#white').click(function(){
        $.ajax({
            method: 'get',
            url: '/turn/',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'color' : 'white',
                'game' : {{$game->id}}
            },
            success: function(arg) {
                refresh_mypage(arg);
            }
        })
    })

</script>
</html>
