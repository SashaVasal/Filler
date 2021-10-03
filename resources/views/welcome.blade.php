<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            .shape-section {
                background: #222;
                border-bottom: 2px solid #555;
                border-top: 2px solid #555;
                margin-top: 30px;
                padding: 40px 0;
            }
            .diamond-shape {
                background: #fff;
                height: 60px;
                text-align: center;
                transform:rotate(45deg);
                width:60px;
            }
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @for($i = 0; $i <$field->height; $i++)
                @for($j = 0; $j <$field->width; $j++)
                    <div class="container diamond-shape">
                        <div class="item-count">99</div><!-- .item-count -->
                    </div><!-- .container .diamond-shape-->
                @endfor
            @endfor
        </div>
    </body>
    <script>

    </script>
</html>
