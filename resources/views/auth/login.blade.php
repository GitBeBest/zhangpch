<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
                width: 30%;
                height: 40%;
            }

            .title {
                font-size: 96px;
            }

            form{
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            form div{
                padding: 5px;
            }
            div a{
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="POST" action="/login">
                    {!! csrf_field() !!}

                    <div>
                        Email
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div>
                        Password
                        <input type="password" name="password" id="password">
                    </div>

                    <div>
                        <input type="checkbox" name="remember"> Remember Me
                        <a href="/register">新注册用户</a>
                    </div>

                    <div>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
