<style>
    .search-button{
        border: 0;
        top: 19px;
        right: 5px;
        padding: 0;
        outline: none;
        color: #9d9d9d;
        font-size: 23px;
        position: absolute;
        background: transparent;
        -webkit-transition: all .4s linear;
        transition: all .4s linear;
    }
</style>
<div class="mt-search-popup">
    <div class="mt-holder">
        <a href="#" class="search-close"><span></span><span></span></a>
        <div class="mt-frame">
            <form action="{{ route('frontend.search') }}"  method="post">
                @csrf
                <fieldset>
                    <input type="text" name="search" value="{{ old('search') }}" placeholder="Search...">
                    <span class="icon-microphone"></span>
                    <button class="search-button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
