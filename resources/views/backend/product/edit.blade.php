@extends('layouts.backend')
@section('title','Product Edit')

@section('styles')
    <style>

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Edit</h1>
                        @include('backend.includes.success')
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
        <!-- Main content -->
        <form action="{{ route('backend.product.update', $product->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section class="content">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product edit</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Product Name *</label>
                                    <input type="text" id="inputName" value="{{ $product->name }}"  name="name" class="form-control">
                                </div>
                                @error('parent_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Category Name*</label>
                                    <select class="custom-select rounded-0" id="category" name="parent_category_id">
                                        <option>...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('sub_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Sub Category Name*</label>
                                    <select class="custom-select rounded-0" id="sub_category" name="sub_category_id" >

                                        @foreach($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}" {{ $product->sub_category_id == $sub_category->id ? 'selected' : '' }}>
                                                {{ $sub_category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="set_product">

                                    @if($product->subCategory->is_set && $product->subCategory->id)
                                    {{--@dd($product->set_products()->where('set_product_id',$product->id)->get())--}}

                                        @foreach($product->set_products as $set_product)
                                            <label for="">Set Product {{ $set_product->set_key }}</label>
                                            @error('set_name1')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" name="set_name{{ $set_product->set_key }}"  value="{{ $set_product->set_name}}" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" step="any" name="set_price{{ $set_product->set_key }}" value="{{$set_product->set_price}}" class="form-control" placeholder="Price">
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" step="any" name="set_discount{{ $set_product->set_key }}" value="{{ $set_product->set_discount}}" class="form-control" placeholder="Discount">
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" step="any" name="count{{ $set_product->set_key }}" value="{{$set_product->count}}" class="form-control" placeholder="Count">
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif
                                </div>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label for="inputName">Description*</label>
                                <div   class="form-group">
                                    <textarea id="editor"  name="description">{{ $product->description }}</textarea>
                                </div>
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Price*</label>
                                    <input disabled  id="inputName"  value="{{ $product->price }}" name="price" class="form-control price-enabled">
                                </div>
                                @error('discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Discount Price</label>
                                    <input disabled  id="inputName" value="{{ $product->discount_price }}" name="discount" class="form-control discount-enabled">
                                </div>

                                @error('is_stock')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Is Stock</label>
                                    <select class="custom-select rounded-0"  name="is_stock">
                                        <option {{ $product->is_stock==1? 'selected' : ''}} value="1">Yes</option>
                                        <option {{ $product->is_stock==0? 'selected' : ''}} value="0">No </option>
                                    </select>
                                </div>
                                @error('stars')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Stars</label>
                                    <select class="custom-select rounded-0" id="stars" name="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option {{ $product->stars == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Images</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @error('path1')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">image 1 (first)*</label>
                                    <input type="file" value="{{ old('path1') }}"  id="inputName" name="path1" class="form-control">
                                    <img src="{{  asset($product->path1)  }}" width="80" height="100" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">image 2</label>
                                    <input type="file" value="{{ old('path2') }}"  id="inputName" name="path2" class="form-control">
                                    @if(isset($product->path2))
                                        <img src="{{ asset($product->path2) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">image 3</label>
                                    <input type="file" value="{{ old('path3') }}"  id="inputName" name="path3" class="form-control">
                                    @if(isset($product->path3))
                                        <img src="{{ asset($product->path3) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">image 4</label>
                                    <input type="file" value="{{ old('path4') }}"  id="inputName" name="path4" class="form-control">
                                    @if(isset($product->path4))
                                        <img src="{{ asset($product->path4) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">image 5</label>
                                    <input type="file" value="{{ old('path5') }}"  id="inputName" name="path5" class="form-control">
                                    @if(isset($product->path5))
                                        <img src="{{ asset($product->path5) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label  for="inputName">image 6</label>
                                    <input type="file" value="{{ old('path6') }}"  id="inputName" name="path6" class="form-control">
                                    @if(isset($product->path6))
                                        <img src="{{ asset($product->path6) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label  for="inputName">image 6</label>
                                    <input type="file" value="{{ old('path6') }}"  id="inputName" name="path6" class="form-control">
                                    @if(isset($product->path6))
                                        <img src="{{ asset($product->path6) }}" width="80" height="100" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="sale_product" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $product_details->slider==1?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Satış Məhsulları </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="featured" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $product_details->feature_items==1?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Seçilmiş Məhsullar </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="hot_sale"  type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $product_details->hot_sale_items == 1 ? "checked" : "" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Hot Sale</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="rated"  type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $product_details->new_items==1?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Ən yüksək qiymətləndirilən məhsullar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="best_seller"  type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $product_details->discount_items==1?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Cox satilan</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-8 ">
                        <a href="{{ route('backend.product.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit  Product" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>
        </section>
    </div>
@endsection

@section('scripts')

    <script>
        // Set the alert to automatically close after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 4000);
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
    <script>
        $(document).on('change','#category' , function (){
            let value = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/product/sub_category',
                data: {'value': value},
                success: function(data){
                    $("#sub_category option").remove();
                    $("#set_product").empty();
                    console.log(data.sub_category)
                    console.log(data.success)
                    $("#sub_category").append('<option  value=0">Seçiniz</option>');
                    $.each(data.sub_category, function (index, value) {
                        let subcategory_name = value.category_name;
                        let sub_category_id = value.id;
                        $("#sub_category").append('<option value="'+sub_category_id+'">'+subcategory_name+'</option>');

                    });
                }
            });
        })
        $(document).on('change','#sub_category' , function (){
            let value = $(this).val();
            let html1 = `
                         <label for="">set product 1</label>
                            @error('set_name1')
            <span class="text-danger">{{$message}}</span>
                            @enderror
            <div class="row">
               <div class="col-6">
               <input type="text" name="set_name1" value="{{ old('set_name1') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price1" value="{{ old('set_price1') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount1" value="{{ old('set_discount1') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count1" value="{{ old('count1') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>
                        <label for="">set product 2</label>
                        <div class="row">
                            <div class="col-6">
                            <input type="text" name="set_name2" value="{{ old('set_name2') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price2" value="{{ old('set_price2') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount2" value="{{ old('set_discount2') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count2" value="{{ old('count2') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>
                        <label for="">set product 3</label>
                        <div class="row">
                            <div class="col-6">
                            <input type="text" name="set_name3" value="{{ old('set_name3') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price3" value="{{ old('set_price3') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount3" value="{{ old('set_discount3') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count3" value="{{ old('count3') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>
                        <label for="">set product 4</label>
                        <div class="row">
                            <div class="col-6">
                            <input type="text" name="set_name4" value="{{ old('set_name4') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price4" value="{{ old('set_price4') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount4" value="{{ old('set_discount4') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count4" value="{{ old('count4') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>
                        <label for="">set product 5</label>
                        <div class="row">
                            <div class="col-6">
                            <input type="text" name="set_name5" value="{{ old('set_name5') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price5"  value="{{ old('set_price5') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount5" value="{{ old('set_discount5') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count5" value="{{ old('count5') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>
                        <label for="">set product 6</label>
                        <div class="row">
                            <div class="col-6">
                            <input type="text" name="set_name6" value="{{ old('set_name6') }}" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_price6" value="{{ old('set_price6') }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="set_discount6" value="{{ old('set_discount6') }}" class="form-control" placeholder="Discount">
                            </div>
                            <div class="col-2">
                            <input type="number" step="any" name="count6" value="{{ old('count6') }}" class="form-control" placeholder="Count">
                            </div>
                        </div>`;
            let html2 = `@foreach($product->set_products as $set_product)

                            <label for="">Set Product {{ $set_product->set_key }}</label>
                                @error('set_name1')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="set_name{{ $set_product->set_key }}"  value="{{ $set_product->set_name}}" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" step="any" name="set_price{{ $set_product->set_key }}" value="{{$set_product->set_price}}" class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" step="any" name="set_discount{{ $set_product->set_key }}" value="{{ $set_product->set_discount}}" class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" step="any" name="count{{ $set_product->set_key }}" value="{{$set_product->count}}" class="form-control" placeholder="Count">
                                    </div>
                                </div>
                                @endforeach`
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/product/set_product',
                data: {'value': value},
                success: function(data){

                    $("#set_product").empty();


                    $.each(data.set_product, function (index, value) {
                        let set_product_is_set = value.is_set;
                        let set_category_id = value.id;
                        let set_prod_id = {{ $product->sub_category_id }};
                        console.log(set_prod_id);
                        console.log({{ $product->id }})
                        if(set_product_is_set==1 && set_category_id!=set_prod_id ){
                            $("#set_product").append(html1);
                            $('.price-enabled').prop('disabled', true);
                            $('.discount-enabled').prop('disabled', true);
                        }
                        if(set_product_is_set==1 && set_category_id==set_prod_id )
                        {
                            $("#set_product").append(html2);
                            $('.price-enabled').prop('disabled', true);
                            $('.discount-enabled').prop('disabled', true);
                        }
                        if(set_product_is_set!=1){
                            $('.price-enabled').prop('disabled', false);
                            $('.discount-enabled').prop('disabled', false);
                        }

                    });
                }
            });
        })
        $(document).ready(function (){
            value=$('#category').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/product/set_product',
                data: {'value': value},
                success: function(data){


                    console.log(data.success)

                    $.each(data.set_product, function (index, value) {
                        let set_product_id = value.is_set;
                        console.log(set_product_id)
                        if(set_product_id){

                            $('.price-enabled').prop('disabled', true);
                            $('.discount-enabled').prop('disabled', true);
                        }
                        else{
                            $('.price-enabled').prop('disabled', false);
                            $('.discount-enabled').prop('disabled', false);
                        }

                    });
                }
            });

        })
    </script>
    <script>
        // This sample still does not showcase all CKEditor 5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Description',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
