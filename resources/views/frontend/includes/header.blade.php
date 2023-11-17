<header id="mt-header" class="style4">
    <!-- mt bottom bar start here -->
    <div class="mt-bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <!-- mt logo start here -->
{{--
                    <div class="mt-logo"><a href="#"><img src="<?=asset('frontend/images/mt-logo.png')?>" alt="schon"></a></div>
--}}
                    <div style="width: 100px; height: 100px; float: left" >
                        <a href="{{route('frontend.index')}}">
                        <div class="col-logo" style="background-color: rgb(0, 195, 137);">
                            <div class="svg-outer-container"><div class="bg-layer"></div>
                                <div class="svg-container"><svg xmlns:mydata="http://www.w3.org/2000/svg" mydata:contrastcolor="00C389" mydata:template="Contrast" mydata:presentation="2.5" mydata:layouttype="undefined" mydata:specialfontid="undefined" mydata:id1="291" mydata:id2="071" mydata:companyname="Adil" mydata:companytagline="Backend developer" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 550 470"><g fill="#101820" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                            <g data-paper-data="{&quot;isGlobalGroup&quot;:true,&quot;bounds&quot;:{&quot;x&quot;:67.31760120751609,&quot;y&quot;:165.66958923869933,&quot;width&quot;:415.36479758496785,&quot;height&quot;:138.66082152260137}}"><g data-paper-data="{&quot;isSecondaryText&quot;:true}">
                                                    <path d="M265.18356,281.51637c0,-1.31313 -0.81057,-2.13992 -1.99401,-2.51278c0.843,-0.34044 1.24829,-1.08617 1.24829,-1.92917c0,-2.30203 -2.33446,-2.80459 -3.84212,-2.80459h-3.84212c-0.32423,0 -0.59983,0.25938 -0.59983,0.58361v9.14328c0,0.32423 0.2756,0.58361 0.59983,0.58361h4.21499c2.04265,0 4.21499,-0.64846 4.21499,-3.06397zM260.5957,275.32358c1.00511,0 2.65869,0.35665 2.65869,1.75084c0,1.18344 -1.21586,1.5563 -2.61005,1.5563h-3.30715v-3.30715zM257.33719,279.68447h4.11772c1.4104,0 2.51278,0.55119 2.51278,1.8319c0,1.63736 -1.57252,2.01023 -2.99913,2.01023h-3.63138z" data-paper-data="{&quot;glyphName&quot;:&quot;B&quot;,&quot;glyphIndex&quot;:0,&quot;firstGlyphOfWord&quot;:true,&quot;word&quot;:1}"></path>
                                                    <path d="M277.42864,280.83549h-5.10662l2.56142,-5.10662zM277.9312,281.85681l1.2645,2.51278c0.30802,0.63225 1.50767,0.22696 1.08617,-0.47013l-4.87966,-9.59721c-0.11348,-0.21075 -0.30802,-0.30802 -0.51877,-0.30802c-0.21075,0 -0.43771,0.09727 -0.53498,0.30802l-4.89587,9.64584c-0.29181,0.64846 0.77815,1.06996 1.06996,0.47013l1.31313,-2.56142z" data-paper-data="{&quot;glyphName&quot;:&quot;A&quot;,&quot;glyphIndex&quot;:1,&quot;word&quot;:1}"></path>
                                                    <path d="M293.84008,282.73223c0.4215,-0.59983 -0.5674,-1.19965 -0.94027,-0.64846c-0.34044,0.43771 -0.82679,0.82679 -1.32934,1.08617c-0.61604,0.30802 -1.28071,0.47013 -1.88053,0.47013c-2.23719,0 -4.13393,-1.88053 -4.13393,-4.34468c0,-2.35067 1.4104,-3.76107 3.40441,-4.06909c1.42661,-0.16211 2.70732,0.01621 3.8097,1.18344c0.45392,0.48634 1.32934,-0.17833 0.843,-0.72952c-1.28071,-1.34555 -2.93428,-1.81569 -4.83103,-1.5563c-2.49657,0.38908 -4.39332,2.49657 -4.39332,5.15526c0,3.20988 2.49657,5.47949 5.26874,5.47949c0.77815,0 1.65357,-0.22696 2.43172,-0.58361c0.69709,-0.34044 1.31313,-0.82679 1.75084,-1.44282z" data-paper-data="{&quot;glyphName&quot;:&quot;C&quot;,&quot;glyphIndex&quot;:2,&quot;word&quot;:1}"></path>
                                                    <path d="M301.91881,278.25786l-1.57252,1.58873v-5.15526c0,-0.72952 -1.18344,-0.74573 -1.18344,0v9.43509c0,0.76194 1.18344,0.72952 1.18344,0v-2.9667l1.71842,-1.50767l4.57164,4.83103c0.59983,0.58361 1.47525,-0.04863 0.85921,-0.76194l-4.60407,-4.7986l4.29605,-3.8097c0.58361,-0.51877 -0.22696,-1.37798 -0.85921,-0.81057z" data-paper-data="{&quot;glyphName&quot;:&quot;K&quot;,&quot;glyphIndex&quot;:3,&quot;word&quot;:1}"></path>
                                                    <path d="M313.88829,279.99249h6.09552c0.68088,0 0.64846,-1.03754 0,-1.03754h-6.09552v-3.64759h6.40354c0.68088,0 0.71331,-1.03754 0.01621,-1.03754h-6.84125c-0.45392,0 -0.74573,0.32423 -0.74573,0.69709v8.90011c0,0.38908 0.29181,0.71331 0.74573,0.71331h6.82504c0.77815,0 0.68088,-1.06996 0,-1.06996h-6.40354z" data-paper-data="{&quot;glyphName&quot;:&quot;E&quot;,&quot;glyphIndex&quot;:4,&quot;word&quot;:1}"></path>
                                                    <path d="M333.76899,280.39778l0.16211,2.44794l-6.24143,-8.34892c-0.40529,-0.59983 -1.31313,-0.47013 -1.31313,0.34044v9.28919c0,0.81057 1.23207,0.79436 1.23207,0v-5.72266l-0.12969,-2.23719l6.0631,8.12196c0.34044,0.5674 1.45903,0.48634 1.45903,-0.32423v-9.3054c0,-0.71331 -1.23207,-0.68088 -1.23207,0z" data-paper-data="{&quot;glyphName&quot;:&quot;N&quot;,&quot;glyphIndex&quot;:5,&quot;word&quot;:1}"></path>
                                                    <path d="M341.78288,275.30737h3.11261c2.43172,0 3.64759,2.07507 3.64759,4.11772c0,2.04265 -1.21586,4.10151 -3.64759,4.10151h-3.11261zM344.89548,284.58034c3.22609,0 4.83103,-2.57763 4.83103,-5.15526c0,-2.57763 -1.60494,-5.15526 -4.83103,-5.15526h-3.53411c-0.40529,0 -0.74573,0.30802 -0.74573,0.68088v8.93253c0,0.37286 0.34044,0.69709 0.74573,0.69709z" data-paper-data="{&quot;glyphName&quot;:&quot;D&quot;,&quot;glyphIndex&quot;:6,&quot;lastGlyphOfWord&quot;:true,&quot;word&quot;:1}"></path>
                                                    <path d="M363.61436,275.30737h3.11261c2.43172,0 3.64759,2.07507 3.64759,4.11772c0,2.04265 -1.21586,4.10151 -3.64759,4.10151h-3.11261zM366.72697,284.58034c3.22609,0 4.83103,-2.57763 4.83103,-5.15526c0,-2.57763 -1.60494,-5.15526 -4.83103,-5.15526h-3.53411c-0.40529,0 -0.74573,0.30802 -0.74573,0.68088v8.93253c0,0.37286 0.34044,0.69709 0.74573,0.69709z" data-paper-data="{&quot;glyphName&quot;:&quot;D&quot;,&quot;glyphIndex&quot;:7,&quot;firstGlyphOfWord&quot;:true,&quot;word&quot;:2}"></path>
                                                    <path d="M378.24253,279.99249h6.09552c0.68088,0 0.64846,-1.03754 0,-1.03754h-6.09552v-3.64759h6.40354c0.68088,0 0.71331,-1.03754 0.01621,-1.03754h-6.84125c-0.45392,0 -0.74573,0.32423 -0.74573,0.69709v8.90011c0,0.38908 0.29181,0.71331 0.74573,0.71331h6.82504c0.77815,0 0.68088,-1.06996 0,-1.06996h-6.40354z" data-paper-data="{&quot;glyphName&quot;:&quot;E&quot;,&quot;glyphIndex&quot;:8,&quot;word&quot;:2}"></path>
                                                    <path d="M394.44322,284.32096c0.2756,0.5674 0.85921,0.47013 1.08617,0.04863l4.66891,-9.4513c0.24317,-0.72952 -0.85921,-1.08617 -1.11859,-0.4215l-4.06909,8.26786l-4.16635,-8.30029c-0.32423,-0.69709 -1.44282,-0.24317 -1.1348,0.45392z" data-paper-data="{&quot;glyphName&quot;:&quot;V&quot;,&quot;glyphIndex&quot;:9,&quot;word&quot;:2}"></path>
                                                    <path d="M406.44513,279.99249h6.09552c0.68088,0 0.64846,-1.03754 0,-1.03754h-6.09552v-3.64759h6.40354c0.68088,0 0.71331,-1.03754 0.01621,-1.03754h-6.84125c-0.45392,0 -0.74573,0.32423 -0.74573,0.69709v8.90011c0,0.38908 0.29181,0.71331 0.74573,0.71331h6.82504c0.77815,0 0.68088,-1.06996 0,-1.06996h-6.40354z" data-paper-data="{&quot;glyphName&quot;:&quot;E&quot;,&quot;glyphIndex&quot;:10,&quot;word&quot;:2}"></path>
                                                    <path d="M426.2772,284.58034c0.82679,0 0.82679,-1.06996 0,-1.06996h-6.0631v-8.83527c0,-0.76194 -1.19965,-0.76194 -1.19965,0v9.3054c0,0.38908 0.17833,0.59983 0.61604,0.59983z" data-paper-data="{&quot;glyphName&quot;:&quot;L&quot;,&quot;glyphIndex&quot;:11,&quot;word&quot;:2}"></path>
                                                    <path d="M435.68527,284.75867c2.75595,0 5.18768,-2.13992 5.18768,-5.51191c0,-2.65869 -1.92917,-4.73376 -4.42574,-5.12283c-0.5674,-0.06485 -1.11859,-0.08106 -1.71842,0c-2.57763,0.40529 -4.29605,2.57763 -4.29605,5.12283c0,3.43684 2.33446,5.51191 5.25252,5.51191zM434.89091,275.2101c0.45392,-0.06485 0.92406,-0.06485 1.4104,0c1.99401,0.32423 3.37199,1.99401 3.37199,4.0853c0,2.72353 -1.79948,4.34468 -3.98803,4.34468c-2.28582,0 -4.03666,-1.686 -4.03666,-4.34468c0,-2.20476 1.28071,-3.77728 3.2423,-4.0853z" data-paper-data="{&quot;glyphName&quot;:&quot;O&quot;,&quot;glyphIndex&quot;:12,&quot;word&quot;:2}"></path>
                                                    <path d="M447.68718,275.30737h2.9667c1.88053,0 2.93428,1.34555 2.95049,2.6749c0.03242,1.23207 -0.85921,2.49657 -3.01534,2.49657h-2.90186zM450.58904,281.53258c2.83701,0 4.16635,-1.60494 4.16635,-3.55032c0,-1.86432 -1.31313,-3.72864 -4.11772,-3.72864h-3.51789c-0.32423,0 -0.59983,0.22696 -0.59983,0.5674v9.33782c0,0.71331 1.16723,0.72952 1.16723,-0.01621v-2.61005z" data-paper-data="{&quot;glyphName&quot;:&quot;P&quot;,&quot;glyphIndex&quot;:13,&quot;word&quot;:2}"></path>
                                                    <path d="M461.43993,279.99249h6.09552c0.68088,0 0.64846,-1.03754 0,-1.03754h-6.09552v-3.64759h6.40354c0.68088,0 0.71331,-1.03754 0.01621,-1.03754h-6.84125c-0.45392,0 -0.74573,0.32423 -0.74573,0.69709v8.90011c0,0.38908 0.29181,0.71331 0.74573,0.71331h6.82504c0.77815,0 0.68088,-1.06996 0,-1.06996h-6.40354z" data-paper-data="{&quot;glyphName&quot;:&quot;E&quot;,&quot;glyphIndex&quot;:14,&quot;word&quot;:2}"></path>
                                                    <path d="M475.19269,275.33979h3.27472c1.88053,0 2.99913,1.06996 3.01534,2.3993c0.03242,1.21586 -0.89163,2.20476 -3.01534,2.20476h-3.27472zM478.33772,280.96518l3.27472,3.55032c0.53498,0.55119 1.42661,-0.16211 0.81057,-0.77815l-2.62626,-2.83701c1.99401,-0.34044 2.88565,-1.52388 2.88565,-3.16124c0,-1.89675 -1.42661,-3.48547 -4.2312,-3.48547h-3.84212c-0.35665,0 -0.59983,0.22696 -0.59983,0.5674v9.3054c0,0.72952 1.18344,0.72952 1.18344,-0.01621v-3.14503z" data-paper-data="{&quot;glyphName&quot;:&quot;R&quot;,&quot;glyphIndex&quot;:15,&quot;lastGlyphOfWord&quot;:true,&quot;word&quot;:2}"></path>
                                                </g>
                                                <g data-paper-data="{&quot;isPrimaryText&quot;:true}">
                                                    <path d="M309.97872,258.47258h20.01654l-26.4853,-73.23124h-20.8709l-26.4853,73.23124h20.13859l4.02772,-12.81547h25.63094zM285.08009,230.52265l8.05544,-25.87504l8.17749,25.87504z" data-paper-data="{&quot;glyphName&quot;:&quot;A&quot;,&quot;glyphIndex&quot;:0,&quot;firstGlyphOfWord&quot;:true,&quot;word&quot;:1}"></path>
                                                    <path d="M334.63323,258.47258h25.38683c20.13859,0 36.61562,-16.35498 36.61562,-36.61562c0,-20.26064 -16.47703,-36.61562 -36.61562,-36.61562h-25.38683zM353.3072,242.23965v-40.76539h6.71286c10.13032,0 18.06371,8.9098 18.06371,20.3827c0,11.47289 -7.93338,20.3827 -18.06371,20.3827z" data-paper-data="{&quot;glyphName&quot;:&quot;D&quot;,&quot;glyphIndex&quot;:1,&quot;word&quot;:1}"></path>
                                                    <path d="M408.10858,258.47258h18.67397v-73.23124h-18.67397z" data-paper-data="{&quot;glyphName&quot;:&quot;I&quot;,&quot;glyphIndex&quot;:2,&quot;word&quot;:1}"></path>
                                                    <path d="M459.37045,242.23965v-56.99832h-18.67397v73.23124h41.98591v-16.23293z" data-paper-data="{&quot;glyphName&quot;:&quot;L&quot;,&quot;glyphIndex&quot;:3,&quot;lastGlyphOfWord&quot;:true,&quot;word&quot;:1}"></path>
                                                </g>
                                                <g data-paper-data="{&quot;isIcon&quot;:&quot;true&quot;,&quot;iconType&quot;:&quot;icon&quot;,&quot;rawIconId&quot;:&quot;6cadb909-b9ed-4067-832c-6edbc7e85a86&quot;,&quot;selectedEffects&quot;:{&quot;container&quot;:&quot;&quot;,&quot;transformation&quot;:&quot;&quot;,&quot;pattern&quot;:&quot;&quot;},&quot;isDetailed&quot;:false,&quot;fillRule&quot;:&quot;nonzero&quot;,&quot;bounds&quot;:{&quot;x&quot;:67.31760120751609,&quot;y&quot;:165.66958923869933,&quot;width&quot;:111.2259861930744,&quot;height&quot;:138.66082152260137},&quot;iconStyle&quot;:&quot;standalone&quot;,&quot;suitableAsStandaloneIcon&quot;:true}">
                                                    <path d="M173.83293,165.66959h-38.03416c0,0 -2.09363,4.88512 -5.93193,12.38727c-1.04681,1.57022 -3.48937,1.39575 -2.61703,5.05959c7.32768,9.59577 -8.02556,-5.583 -1.57022,2.61703c-2.26809,-1.22128 0.34894,3.14044 -1.22128,2.7915c-6.45534,-5.23406 -0.34894,2.96597 -1.57022,2.96597c14.4809,18.84261 0,3.14044 -1.57022,3.14044c0.34894,2.44256 -8.3745,-6.28087 -1.39575,3.14044c7.67662,12.38727 -8.72343,-5.75747 -1.74469,3.48937c-22.85539,-25.12348 -5.05959,-1.57022 -1.91916,3.48937c2.26809,4.71065 2.61703,6.97874 -1.57022,3.48937c1.91916,4.53618 -7.85109,-4.88512 -1.91916,3.48937c-7.15321,-7.15321 1.22128,5.40853 -1.57022,3.48937c1.57022,4.01278 6.1064,10.81706 -1.91916,3.83831c-5.05959,-4.36171 5.05959,9.42131 -2.09363,3.66384c-8.02556,-8.3745 6.1064,10.46812 -1.74469,3.66384c-1.39575,0.69787 -1.91916,0.69787 -1.57022,3.83831c0,2.44256 -2.44256,1.74469 -2.26809,3.48937c-3.83831,-1.74469 -5.23406,-1.39575 -1.57022,3.66384c7.15321,9.07237 -11.34046,-8.20003 -2.09363,3.83831c3.66384,5.93193 -4.18724,0 -1.74469,3.66384c7.50215,10.64259 -6.62981,-2.61703 -1.74469,3.48937c5.05959,7.67662 -12.91068,-10.11918 -1.74469,3.48937c5.05959,7.67662 -8.3745,-7.50215 -1.91916,3.48937c0.87234,1.57022 -13.95749,-13.43408 -1.39575,3.48937c1.04681,2.7915 -8.72343,-5.75747 -1.91916,2.96597c-3.83831,-2.96597 9.59577,14.13196 -1.57022,3.48937c6.62981,9.42131 -5.40853,-3.66384 -1.39575,2.96597c-8.02556,-6.80427 1.04681,5.75747 -1.74469,3.14044c-2.44256,-2.26809 9.07237,13.43408 -1.04681,2.61703c-3.3149,-3.48937 -21.28518,-20.93624 -1.57022,3.14044c3.3149,5.40853 1.39575,6.80427 -2.61703,4.71065c-1.04681,0.17447 -3.3149,-0.17447 -1.91916,4.36171c-7.50215,-6.28087 -4.71065,-2.26809 -1.74469,3.48937c1.39575,1.74469 -6.45534,-5.93193 -1.74469,1.74469c1.04681,0.34894 2.61703,1.22128 4.71065,2.96597c1.74469,-0.17447 -5.93193,-10.46812 5.05959,0c-1.39575,-5.23406 7.85109,4.53618 5.75747,0c9.07237,6.1064 21.80858,18.84261 6.28087,0c8.3745,8.72343 0.17447,-4.36171 5.23406,0c-3.48937,-8.20003 10.99153,6.1064 5.23406,0c1.91916,1.39575 1.39575,1.22128 0.5234,-1.74469c2.44256,1.57022 6.45534,4.18724 1.91916,-4.36171c-0.87234,-3.3149 2.7915,-1.74469 2.44256,-5.583c-1.04681,-4.18724 1.91916,-2.7915 2.44256,-5.05959c4.01278,0.87234 -6.45534,-13.25961 2.26809,-4.71065c-2.96597,-4.71065 -7.50215,-11.51493 0.5234,-1.57022c4.53618,4.88512 -4.36171,-8.54897 5.05959,0h26.6937v23.02986h32.2767zM124.63278,253.25284c-1.39575,0 -1.04681,0.5234 -1.74469,0c0,0 0.5234,-1.57022 1.74469,-4.01278c5.40853,-12.56174 22.50645,-50.42143 22.50645,-50.42143l-0.5234,54.43422zM71.41984,294.42744c-0.5234,-1.22128 -1.39575,-3.66384 0.34894,-2.96597c-8.72343,-9.24684 -2.26809,-0.69787 -0.34894,2.96597zM72.46665,291.98488c-0.34894,-0.17447 -0.34894,-0.34894 -0.34894,-0.5234h-0.34894c0.17447,0.17447 0.17447,0.34894 0.69787,0.5234zM72.46665,291.98488c0,0 0.17447,0.17447 0.34894,0.17447c-0.17447,0 -0.34894,-0.17447 -0.34894,-0.17447z" data-paper-data="{&quot;isPathIcon&quot;:true}"></path>
                                                </g>
                                                <path d="M209.58765,304.33041v-138.66082h3.72016v138.66082z" data-paper-data="{&quot;isShapeTextSeparator&quot;:true}"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- mt icon list start here -->
                    <ul class="mt-icon-list">
                        <li class="hidden-lg hidden-md">
                            <a href="#" class="bar-opener mobile-toggle">
                                <span class="bar"></span>
                                <span class="bar small"></span>
                                <span class="bar"></span>
                            </a>
                        </li>
                        <li><a href="#" class="icon-magnifier"></a></li>
                        @if(auth()->check())
                            <li class="drop">
                                <a href="" class="icon-heart cart-opener">
                                    <span style="margin-bottom: -3px;" class="num wish_num">{{count($user_wishes)}}</span>
                                </a>
                                <!-- mt drop start here -->
                                <div class="mt-drop">
                                    <!-- mt drop sub start here -->
                                    <div class="mt-drop-sub">
                                        <!-- mt side widget start here -->
                                        <div class="mt-side-widget wishes_list">
                                            @if(count($user_wishes)>0)
                                                @foreach($user_wishes as $wishes)
                                                    <div class="cart-row card-body-wishes" id="wish-item-{{$wishes->wish_product->id}}">
                                                        <a href="{{ route('frontend.product.index', ['level1'=>$wishes->wish_product->category->slug, 'level2'=>$wishes->wish_product->subCategory->slug, 'level3'=>$wishes->wish_product->slug]) }}" class="img">
                                                            <img src="{{ asset($wishes->wish_product->path1) }}" alt="image" class="img-responsive">
                                                        </a>
                                                        <div class="mt-h">
                                                            <span class="mt-h-title">
                                                                <a href="{{ route('frontend.product.index', ['level1'=>$wishes->wish_product->category->slug, 'level2'=>$wishes->wish_product->subCategory->slug, 'level3'=>$wishes->wish_product->slug]) }}">{{$wishes->wish_product->name}}</a>
                                                            </span>
                                                            <span class="price">
                                                                <i class="fa fa-eur" aria-hidden="true"></i> {{$wishes->wish_product->price}}
                                                            </span>
                                                        </div>
                                                        <a href="#" data-product-id="{{$wishes->wish_product->id}}" data-user-id="{{auth()->id()}}" class="close fa fa-times wish-iks"></a>
                                                    </div><!-- cart row end here -->
                                                @endforeach
                                                    <div class="cart-row-total">
                                                        <span class="mt-total">Hamisini elave et</span>
                                                        <span  class="mt-total-txt"><a href="#" data-user-id="{{auth()->id()}}" class="btn-type2 cart_add_wishes">Karta elave et</a></span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                    <div class="cart-row-total">
                                                        <span class="mt-total">istek siyahisina bax</span>
                                                        <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                                                    </div>
                                            @else
                                                <div class="cart-row card-body-wishes">
                                                    <h3>istek siyahiniz hal hazirda bosdur</h3>
                                                </div>
                                                <div class="cart-row-total">
                                                    <span class="mt-total">istek siyahisina bax</span>
                                                    <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                                                </div>
                                            @endif

                                            <!-- cart row total end here -->
                                        </div><!-- mt side widget end here -->
                                    </div>
                                    <!-- mt drop sub end here -->
                                </div><!-- mt drop end here -->
                                <span class="mt-mdropover"></span>
                            </li>
                            <li class="drop">
                                <a href="#" class="cart-opener">
                                    <span class="icon-handbag"></span>
                                    <span class="num cart_num">{{count($user_carts)}}</span>
                                </a>
                                <!-- mt drop start here -->
                                <div class="mt-drop">
                                    <!-- mt drop sub start here -->
                                    <div class="mt-drop-sub">
                                        <!-- mt side widget start here -->
                                        <div class="mt-side-widget card-wishes" >
                                            @if(count($user_carts)>0)
                                                @foreach($user_carts as $carts)
                                                <div class="cart-row cart-wishes" id="card-item-{{$carts->wish_product->id}}">
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$carts->wish_product->category->slug, 'level2'=>$carts->wish_product->subCategory->slug, 'level3'=>$carts->wish_product->slug]) }}" class="img">
                                                        <img src="{{ asset($carts->wish_product->path1) }}" alt="image" class="img-responsive">
                                                    </a>
                                                    <div class="mt-h">
                                                        <span class="mt-h-title">
                                                            <a href="{{ route('frontend.product.index', ['level1'=>$carts->wish_product->category->slug, 'level2'=>$carts->wish_product->subCategory->slug, 'level3'=>$carts->wish_product->slug]) }}">
                                                                {{$carts->wish_product->name}}
                                                            </a>
                                                        </span>
                                                        <span class="price"><i class="fa fa-eur" aria-hidden="true"></i> {{$carts->wish_product->price}}</span>
                                                        <span class="mt-h-title">Qty: 1</span>
                                                    </div>
                                                    <a href="#" data-product-id="{{$carts->wish_product->id}}" data-user-id="{{auth()->id()}}" class="close fa fa-times card-iks"></a>
                                                </div>

                                                @endforeach
                                                <div class="cart-row-total">
                                                    <span class="mt-total">Sub Total</span>
                                                    <span class="mt-total-txt card-total-sum"><i class="fa fa-eur" aria-hidden="true"></i>{{ $total_price }}</span>
                                                </div>
                                                <!-- cart row total end here -->
                                                <div class="cart-btn-row">
                                                    <a href="{{ route('frontend.user.cart') }}" class="btn-type3">VIEW CART</a>

                                                </div>
                                            @else
                                                <div class="cart-row card-body-wishes">
                                                    <h3>cart siyahiniz hal hazirda bosdur</h3>
                                                </div>
                                                <div class="cart-btn-row">
                                                    <a href="{{ route('frontend.user.cart') }}" class="btn-type3">VIEW CART</a>

                                                </div>
                                            @endif
                                        </div><!-- mt side widget end here -->
                                    </div>
                                    <!-- mt drop sub end here -->
                                </div><!-- mt drop end here -->
                                <span class="mt-mdropover"></span>
                            </li>
                        @endif


                    </ul><!-- mt icon list end here -->
                    <!-- navigation start here -->
                    @include('frontend.components.nav')
                    @include('frontend.includes.sidebar')
                    <!-- mt icon list end here -->
                </div>
            </div>
        </div>
    </div>
    <!-- mt bottom bar end here -->
    <span class="mt-side-over"></span>
</header>
