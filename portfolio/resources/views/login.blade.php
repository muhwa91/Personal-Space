<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css"/>
    <title>login</title>
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
        <form class="login-form" method="POST" action="{{route('login.post')}}">
            <!-- username --> 
            <div class="username">
            <label><span class="entypo-user"></span></label>
            <input type="text" id="email" name="email" autocomplete="off" placeholder="E-mail"/>
            </div>
            <!-- password -->
            <div class="password">
            <label><span class="entypo-lock"></span></label>
            <input type="password" id="password" name="password" autocomplete="off" placeholder="Password"/>
            </div>
            <!-- button -->
            <button class="btn">Login</button>
            <p>
            아직 회원이 아니신가요? <a href="{{ route('register.get') }}" class="link">지금 참여하세요! <span class="entypo-right-thin"></span></a>
            </p>
        </form>
        </div> <!-- /login-wrapper -->
    </div>  <!-- /container -->  
</body>
</html>
