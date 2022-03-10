<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">

        <style>
            @import url('https://fonts.googleapis.com/css?family=Raleway:300,400,600,700');
            
            body{ background: #f1f4f7; font-family: 'Raleway', sans-serif; padding:10px 20px; font-weight: 400; }
            div.panel{ padding: 20px 50px; background-color: white; }
            div.block{ padding:20px; background: #efefef; margin: 22px 0; }
            h2{ width: 100%; text-align: center; color:#cc051c; margin: 5px; font-weight: 600; }
            a.link{ 
                display:block; width:220px; padding:10px 15px; margin:0 auto; 
                background-color:#cc051c; color:#fff; text-align: center; border-radius:2px; text-decoration: none;
            }
            .content{ font-size:16px; }
            .text-little{ font-size:12px; } .text-medium{ font-size:14px; } .text-big{ font-size:18px; }
            p.justify{ text-align:justify; }
            a.logo img{ max-width: 230px; max-height: 130px; }
            hr.header { border: 1px solid #cc051c; }
            b { font-weight: 600; }
            .blue{ color: #cc051c; }
            .text-center{ text-align: center; }
            .text-uppercase{ text-transform: uppercase; }
            .text-thin{ font-weight: 300; } .text-normal{font-weight: 500; }
        </style>
    </head>

    <body>
        <br>
        <div style="text-align:center">
            <img src="{{ asset(config('paths.logo')) }}" alt="{{config('app.name')}}" width="150">
        </div>
        <hr class="header">
        <br>
        <h2>{{$title}}</h2><br>
        
        <div class="content">
            <br>
            <div class="panel">
            
                @yield('content')
                <br><br>
            </div>
        </div>

    </body>
</html>
