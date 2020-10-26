<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
</head>
<body>
    <header class="bg-dark text-light p-3 d-flex flex-row justify-content-between">
        <h2>
            Панель админестратора
        </h2>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Выйти</button>
                </form>
            @endauth
        
    </header>
    <section id="app">
        @auth
            <div class="navbar navbar-dark bg-dark ">
                <ul class="d-flex flex-row justify-content-between">
                    <li class="nav-item active border border-primary rounded"><a class="nav-link" href="/panel">Общие настройки</a></li>
                    <li class="nav-item active border border-primary rounded"><a class="nav-link" href="/slider_reader">Слайдер</a></li>
                    <li class="nav-item active border border-primary rounded"><a class="nav-link" href="/plants_reader">Растения</a></li>
                </ul>
            </div>
        @endauth
        
        <div id="main">
            @yield('main')
        </div>
    </section>
    
    <footer class="bg-dark text-light p-2">
        <div class="copy text-center">
            © 2020 Березин Станислав, Все ошибки защищены
        </div>
    </footer>
    <script src="js/app.js"></script>
    <script src="js/nicEdit.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas();
            var el = $("#con").children();;
            el[0].style.width = "100%";
            el[1].style.width = "100%";
            el[2].style.width = "100%";
            $('.nicEdit-main')[0].style.width = "98%"
        });
    </script>
</body>
</html>