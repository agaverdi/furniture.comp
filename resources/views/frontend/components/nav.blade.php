<nav style="margin: 38px -12px 0 0;display: flex;justify-content: center; font-size: medium; float: none" id="nav">
    <ul style="float: right;">
        <li>
            <a  href="{{ route('frontend.index') }}">Ana səhifə <i class="fa fa-angle-down hidden-lg hidden-md" ></i></a>
        </li>
        <li class="drop">
            <a href="">MƏHSULLAR <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <!-- mt dropmenu start here -->
            <div class="mt-dropmenu text-left">
                <!-- mt frame start here -->
                <div class="mt-frame">
                    <!-- mt f box start here -->
                    <div class="mt-f-box">
                        <!-- mt col3 start here -->
                        @foreach($categories as $category)
                        <div class="mt-col-3">
                            <div class="sub-dropcont">


                                <strong style="display: block;color: #241f1f; margin: 0 0 18px;padding: 0 0 4px;position: relative;font: 16px/20px 'Montserrat', sans-serif;"><a href="{{ route('frontend.product.index',['level1' => $category->slug]) }}"  style="color: #171414">{{ $category->category_name }}</a></strong>
                                <div class="sub-drop">
                                    <ul>
                                        @foreach($category->sub_categories as $subCategory)
                                        <li><a href="{{ route('frontend.product.index',['level1' => $category->slug,'level2'=> $subCategory->slug]) }}">{{ $subCategory->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- mt f box end here -->
                </div>
                <!-- mt frame end here -->
            </div>
            <!-- mt dropmenu end here -->
            <span class="mt-mdropover"></span>
        </li>
        <li><a href="{{route('frontend.about')}}">Haqqımda</a></li>
        <li>
            <a  href="{{route('frontend.contact')}}">Əlaqə <i class="fa fa-angle-down hidden-lg hidden-md" ></i></a>
        </li>
        <li>
            <a class="drop-link" href="blog-right-sidebar.html">Hesabım <i class="fa fa-angle-down hidden-lg hidden-md" aria-hidden="true"></i></a>
            <div class="s-drop">
                @if(auth()->check())
                    <ul>
                        <li><a href="{{ route('frontend.account') }}">Hesab məlumatlarım</a></li>
                        <li><a href="{{ route('frontend.user.change_password_view') }}">Şifrəni dəyiş</a></li>
                        <li><a href="{{ route('frontend.user.wish') }}">Arzu siyahısı</a></li>
                        <li><a href="{{ route('frontend.user.checkout_list') }}">Sifariş tarixcəsi</a></li>
                        <form action="{{ route('frontend.logout') }}" method="post">
                            @csrf
                            <li><input type="submit"  class="btn" style="background-color: #FFFFFF; border: none" value="Çıxış"></li>
                        </form>
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('frontend.login') }}">Daxil ol</a></li>
                        <li><a href="{{ route('frontend.register') }}">Qeydiyyatdan kec</a></li>
                    </ul>
                @endif
            </div>
        </li>
    </ul>
</nav>
<div class="aviso aviso-login" style="display: none">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Siz giriş etdikdən sonra </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>istek siyahisina</strong>  Əlavələr edə bilərsiniz
</div>

<div class="aviso aviso-success" style="display: none; float: right; background-color: #07833f">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Sizin arzunuz </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>istek siyahisina</strong>  elave edildi
</div>

<div class="aviso aviso-delete" style="display: none; float: right; background-color: #07833f">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Sizin arzunuz </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>istek siyahisindan</strong>   silindi
</div>

<div class="aviso aviso-in-cart" style="display: none; float: right; background-color: #07833f">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Siz bu mebeli artiq </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>Kart  siyahisina</strong>   elave etmisiniz
</div>

<div class="aviso aviso-ship-price" style="display: none; float: right; background-color: #07833f">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Siz Gedis ucun seheri ve  </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>Unvani </strong>   qeyd etmemisiniz
</div>

<div class="aviso aviso-exist-cart" style="display: none; float: right; background-color: #07833f">
    <span class="boton-cerrar" onclick="this.parentElement.style.display='none';">&times;</span>
    <h1 class="titulo-alerta">Siz artiq bu mehsulu   </h1>

    <img src="" alt="" class="imagen-aviso">

    <strong>Karta  </strong>   elave etmisiniz
</div>
