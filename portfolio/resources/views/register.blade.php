<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css"/>
    <title>register</title>
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
        <form class="login-form" method="POST" action="{{route('register.post')}}">
            @csrf
            <!-- email --> 
            <div class="username">
                <label><span class="entypo-user"></span></label>
                <input type="text" id="email" name="email" autocomplete="off" placeholder="E-mail"/>
            </div>
            <!-- password -->
            <div class="username">
                <label><span class="entypo-lock"></span></label>
                <input type="password" id="password" name="password" autocomplete="off" placeholder="Password"/>
            </div>
            <!-- password -->
            <div class="username">
                <label><span class="entypo-lock"></span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" placeholder="confirm password"/>
            </div>
            <!-- email --> 
            <div class="username">
                <label><span class="entypo-user"></span></label>
                <input type="text" id="name" name="name" autocomplete="off" placeholder="name"/>
            </div>
            <div class="username">
                <label><span class="entypo-user"></span></label>
                <input type="tel" id="tel" name="tel" autocomplete="off" placeholder="phone-number ex ) 01012345678"/>
            </div>
            
            <!-- button -->
            <button class="btn">Join</button>
            <p>
                <a href="/" class="link">Home <span class="entypo-right-thin"></span></a>
            </p> 
        </form>
        </div> <!-- /login-wrapper -->
    </div>  <!-- /container -->  
</body>
</html>
