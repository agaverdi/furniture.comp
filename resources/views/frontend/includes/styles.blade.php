<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
<!-- include the site stylesheet -->
<link rel="stylesheet" href="<?=asset('frontend/css/bootstrap.css')?>">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="<?=asset('frontend/css/animate.css')?>">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="<?=asset('frontend/css/icon-fonts.css')?>">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="<?=asset('frontend/css/main.css')?>">
<!-- include the site stylesheet -->
<link rel="stylesheet" href="<?=asset('frontend/css/responsive.css')?>">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />

<style>
    .titulo-alerta
    {
        color: #424242;
        font-size: 18px;
        text-align: left;
        margin-top: 20px;
    }

    .aviso {
        width: 300px;
        padding: 15px;
        background-color: #fff;
        color: #000;
        border-right: 4px solid #4A8333;
        font-family: 'open sans', sans-serif;
        font-style: italic;
        font-size: 14px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        position: fixed;

    }

    .imagen-aviso
    {
        width: 30%;
        display: block;
        margin-left: auto;
        margin-right: auto;

    }

    .boton-cerrar:hover {
        background: orange;
        padding: 12px;
    }


    .boton-cerrar {
        background: #4A8333;
        padding: 8px;
        margin-left: 15px;
        color: #fff;
        font-weight: bold;
        float: right;
        font-size: 30px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }


</style>

<meta name="csrf-token" content="{{ csrf_token() }}">





