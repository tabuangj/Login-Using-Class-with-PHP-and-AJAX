<script src="js/jquery-3.5.1.min.js"></script>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .buttonlogin {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .buttonRegister
    {
        background-color: cornflowerblue;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }


    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 100px) {
        span.psw {
            display: block;
            float: none;
        }

    }
</style>

<body>

<h2>Register Form</h2>
<div style="border: 3px solid #f1f1f1;">
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" id="regisusername">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="regispassword">

        <label for="psw"><b>Confirm Password</b></label>
        <input type="password" placeholder="Enter Confirm Password" id="regisconfirmpass">

        <button class="buttonRegister" id="regissub" type="submit">Register</button>
        <p id="regisresult"></p>
    </div>
</div>


<h2>Login Form</h2>
<div style="border: 3px solid #f1f1f1;">
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" id="username">
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="password">
        <button type="submit" class="buttonlogin" id="loginsub">Login</button>
        <p id="login"></p>
    </div>
</div>

<script type="text/javascript" >
    $(document).ready(function () {
        $('#regissub').click(function () {
            var username = $('#regisusername').val();
            var password = $('#regispassword').val();
            var confirmpass = $('#regisconfirmpass').val();
            if (username === '' || username.match(/^ *$/) !== null) {
                document.getElementById('regisresult').innerHTML="<span style='color: red'>Username can not blank or space</span>"
            } else {
                if (password === '' || password.match(/^ *$/) !== null){
                    document.getElementById('regisresult').innerHTML="<span style='color: red'>Password can not blank or space</span>"
                }else{
                    if(password === confirmpass){
                        var datapack;
                        datapack={
                            username:username,
                            password:password
                        }
                        $.ajax({
                            url:'usingCLASS.php',
                            type:'POST',
                            data:{
                                datapack:datapack,
                            },
                            success:function (result) {
                                if(result === '0'){
                                    document.getElementById('regisresult').innerHTML="<span style='color: #4CAF50'>Register Success</span>";
                                    alert('Register Success');
                                    window.location='index.php'
                                }else{
                                    document.getElementById('regisresult').innerHTML="<span style='color: red'>Username is already exit</span>"
                                }
                            }
                        })
                    }else{
                        document.getElementById('regisresult').innerHTML="<span style='color: red'>Password doesn't match</span>"
                    }
                }
            }

        });

        $('#loginsub').click(function () {
            var username = $('#username').val();
            var password = $('#password').val();
            var datalogin = {
                username:username,
                password:password
            }
            $.ajax({
                url:'usingCLASS.php',
                type:'POST',
                data:{
                    datalogin:datalogin,
                },
                success:function (result) {
                    if(result === '0'){
                        document.getElementById('login').innerHTML="<span style='color: #4CAF50'>Login Success</span>";
                    }else if(result === '1'){
                        document.getElementById('login').innerHTML="<span style='color: red'>Username is not register</span>"
                    }else{
                        document.getElementById('login').innerHTML="<span style='color: red'>Wrong password</span>"
                    }
                }
            })
        })
    })
</script>