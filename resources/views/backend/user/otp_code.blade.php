<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        .title {
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: "Poppins", sans-serif;
        }
        .title h3 {
            font-weight: bold;
        }
        .title p {
            font-size: 12px;
            color: #118a44;
        }
        .title p.msg {
            color: initial;
            text-align: initial;
            font-weight: bold;
        }

        .otp-input-fields {
            margin: auto;
            background-color: white;
            box-shadow: 0px 0px 8px 0px #02025044;
            max-width: 400px;
            width: auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 40px;
        }
        .otp-input-fields input {
            height: 40px;
            width: 40px;
            background-color: transparent;
            border-radius: 4px;
            border: 1px solid #2f8f1f;
            text-align: center;
            outline: none;
            font-size: 16px;
            /* Firefox */
        }
        .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .otp-input-fields input[type=number] {
            -moz-appearance: textfield;
        }
        .otp-input-fields input:focus {
            border-width: 2px;
            border-color: #287a1a;
            font-size: 20px;
        }

        .result {
            max-width: 400px;
            margin: auto;
            padding: 24px;
            text-align: center;
        }
        .result p {
            font-size: 24px;
            font-family: "Antonio", sans-serif;
            opacity: 1;
            transition: color 0.5s ease;
        }
        .result p._ok {
            color: green;
        }
        .result p._notok {
            color: red;
            border-radius: 3px;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<form action="javascript: void(0)" class="otp-form" name="otp-form">

    <div class="title">
        <h3>OTP VERIFICATION</h3>
        <p class="info">An otp has been sent to {{ session('hiddenEmail') }}</p>
        <p class="msg">Please enter OTP to verify</p>
    </div>
    <div class="otp-input-fields">
        <input type="number" class="otp__digit otp__field__1">
        <input type="number" class="otp__digit otp__field__2">
        <input type="number" class="otp__digit otp__field__3">
        <input type="number" class="otp__digit otp__field__4">
        <input type="number" class="otp__digit otp__field__5">
        <input type="number" class="otp__digit otp__field__6">
    </div>

    <div class="result"><p id="_otp" class="_notok"></p></div>
</form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    let digitValidate = function(ele){
        console.log(ele.value);
        ele.value = ele.value.replace(/[^0-9]/g,'');
    }

    let tabChange = function(val){
        let ele = document.querySelectorAll('input');
        if(ele[val-1].value != ''){
            ele[val].focus()
        }else if(ele[val-1].value == ''){
            ele[val-2].focus()
        }
    }
    var otp_inputs = document.querySelectorAll(".otp__digit")
    var mykey = "0123456789".split("")
    otp_inputs.forEach((_)=>{
        _.addEventListener("keyup", handle_next_input)
    })
    function handle_next_input(event){

        let current = event.target
        let index = parseInt(current.classList[1].split("__")[2])
        current.value = event.key

        if(event.keyCode == 8 && index > 1){
            current.previousElementSibling.focus()
        }
        if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
            var next = current.nextElementSibling;
            next.focus()
        }
        var _finalKey = ""
        for(let {value} of otp_inputs){
            _finalKey += value
        }
        if(_finalKey.length == 6){
            document.querySelector("#_otp").classList.replace("_notok", "_ok")
            document.querySelector("#_otp").innerText = _finalKey
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: 'otp-code/check',
                method: "POST",
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {
                    _finalKey:_finalKey,
                },
                success:function (response){
                    if (response.status === 200) {

                        window.location.href = '{{ route('backend.user.recover_password') }}'
                    }
                    else{
                        alert('yanlis kodu daxil etdiniz')
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error:", error);
                },
            })
            console.log(_finalKey)
            console.log({{ session('otp') }})
        }else{
            document.querySelector("#_otp").classList.replace("_ok", "_notok")
            document.querySelector("#_otp").innerText = _finalKey
        }
    }
</script>
</html>
