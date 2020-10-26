<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$info->titel}}</title>
</head>
<body>
    <section class="app" id="app">
        <header id="header" class="w-100">
            <div class="d-flex flex-column header-inner w-100">
                <div class="logo m-auto">
                    <img src="{{'/storage/'.$info->logo}}" width="120" alt="">    
                </div>
                <div class="m-auto">
                   <send-message></send-message>
                    @auth
                        <form method="GET" action="/panel">
                            @csrf
                            <button class="btn btn-outline-dark" type="submit">Панель администратора</button>
                        </form> 
                    @endauth
                </div>
            </div>
        </header>
        <section>
            <slider-view></slider-view>
            <plant-list></plant-list>
        </section>
        <footer class="bg-dark text-light p-2">
            <div class="copy text-center">
                {!!$info->footer_text!!}
            </div>
        </footer>
    </section>
    
    <script src="js/app.js"></script>
    <script src="js/nicEdit.js"></script> 
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas();
            var el = $("#con").children();
            el[0].style.width = "100%";
            el[1].style.width = "100%";
            el[2].style.width = "100%";
            $('.nicEdit-main')[0].style.width = "98%"
        });
        
    </script>
</body>
</html>