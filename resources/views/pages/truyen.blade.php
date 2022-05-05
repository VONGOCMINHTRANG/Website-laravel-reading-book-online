@extends('../layout')
{{--@section('slide')
    @include('pages.slide')
@endsection--}}
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('the-loai/'.$truyen->theloai->slug_theloai)}}">{{$truyen->theloai->tentheloai}}</a></li>
    <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li> 
    <li class="breadcrumb-item active" aria-current="page">{{$truyen->tentruyen}}</li>
  </ol>
</nav>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" data-holder-rendered="true">
            </div>
            <div class="col-md-9">
                <style type="text/css">
                    .infotruyen{
                        list-style:none;
                    }
                </style>
                <ul class="infotruyen">
                    <!---------------------------Lấy biến wishlist----------------------------->
                    <input type="hidden" value="{{$truyen->tentruyen}}" class="wishlist_title">
                    <input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
                    <input type="hidden" value="{{$truyen->id}}" class="wishlist_id">
                    <!--------------------------End lấy biến wishlist--------------------------->

                    <li>Tên truyện : {{$truyen->tentruyen}}</li>
                    <li>Ngày đăng : {{$truyen->created_at->diffForHumans()}}</li>
                    <li>Ngày cập nhật : {{$truyen->updated_at->diffForHumans()}}</li>
                    <li>Tác giả : {{$truyen->tacgia}}</li>
                    <li>Danh mục truyện : 
                        <a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a>
                    </li>
                    <li>Thể loại truyện : 
                        <a href="{{url('the-loai/'.$truyen->theloai->slug_theloai)}}">{{$truyen->theloai->tentheloai}}</a>
                    </li>
                    <li>Số chương : 20</li>
                    <li>Số lượt xem : 2712</li>
                    <li><a href="#">Xem mục lục</a></li>
                    @if($chapter_dau)
                        <li>
                            <a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Đọc Online</a>
                            <button class="btn btn-danger btn-thich_truyen">
                                <i class="fa fa-heart" aria-hidden="true"></i>Thích truyện
                            </button>
                        </li>
                        <li><a href="{{url('xem-chapter/'.$chapter_moinhat->slug_chapter)}}" class="btn btn-success mt-2">Đọc chương mới nhất</a></li>
                    @else
                    <li><a class="btn btn-warning">Đang cập nhật</a>
                        <button class="btn btn-danger btn-thich_truyen">
                            <i class="fa fa-heart" aria-hidden="true"></i>Thích truyện
                        </button>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <p>{{$truyen->tomtat}}</p>
        </div>
        <hr>
        <style type="text/css">
            .tagcloud05 ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }
            .tagcloud05 ul li {
                display: inline-block;
                margin: 0 0 .3em 1em;
                padding: 0;
            }
            .tagcloud05 ul li a {
                position: relative;
                display: inline-block;
                height: 30px;
                line-height: 30px;
                padding: 0 1em;
                background-color: #3498db;
                border-radius: 0 3px 3px 0;
                color: #fff;
                font-size: 13px;
                text-decoration: none;
                -webkit-transition: .2s;
                transition: .2s;
            }
            .tagcloud05 ul li a::before {
                position: absolute;
                top: 0;
                left: -15px;
                content: '';
                width: 0;
                height: 0;
                border-color: transparent #3498db transparent transparent;
                border-style: solid;
                border-width: 15px 15px 15px 0;
                -webkit-transition: .2s;
                transition: .2s;
            }
            .tagcloud05 ul li a::after {
                position: absolute;
                top: 50%;
                left: 0;
                z-index: 2;
                display: block;
                content: '';
                width: 6px;
                height: 6px;
                margin-top: -3px;
                background-color: #fff;
                border-radius: 100%;
            }
            .tagcloud05 ul li span {
                display: block;
                max-width: 100px;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
            }
            .tagcloud05 ul li a:hover {
                background-color: #555;
                color: #fff;
            }
            .tagcloud05 ul li a:hover::before {
                border-right-color: #555;
            }

        </style>
        <p>Từ khóa tìm kiếm :
            @php
                $tukhoa = explode(",",$truyen->tukhoa);
            @endphp
            <div class="tagcloud05">
                <ul>
                @foreach($tukhoa as $key => $tu)
                    <li><a href="{{url('tag/'. \Str::slug($tu))}}"><span>{{$tu}}</span></a></li>
                @endforeach
                </ul>
            </div>
        </p>
                    
        <hr>
        <h4>Mục lục</h4>
        <ul class="mucluctruyen">
            @php
                $mucluc = count($chapter);
            @endphp
            @if($mucluc > 0)
                @foreach($chapter as $key => $chap)
                    <li><a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</a></li>
                @endforeach
            @else
                <li><b>Đang cập nhật...</b></li>
            @endif
        </ul>
        <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="5"></div>
        <h4>Sách cùng danh mục</h4>
        <div class="row">
                 @foreach($cungdanhmuc as $key => $value)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" data-holder-rendered="true">
                            <div class="card-body">
                                <h5><b>{{$value->tentruyen}}</b></h5>
                                <p class="card-text">{{$value->tomtat}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                    <a href="" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>2712</a>
                                    </div>
                                    <small class="text-muted">9 mins ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    <div class="col-md-3">
        <style>
            .col-md-7.sidebar a{
                font-size: 15px;
                text-decoration: none;
                color: #000;
            }
            .col-md-7-sidebar{
                padding: 0;
            }
            .card-header{
                background: darkgray !important;
            }
        </style>
        <h3 class="title_truyen card-header">Truyện yêu thích</h3>
        <div id="yeuthich"></div>

        <h3 class="card-header">Truyện nổi bật</h3>
        @foreach($truyen_noibat as $key => $noibat)
            <div class="row mt-2">
                <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" 
                src="{{asset('public/uploads/truyen/'.$noibat->hinhanh)}}" alt="{{$noibat->tentruyen}}"></div>

                <div class="col-md-7 sidebar">
                    <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}"></a>
                    <p>{{$noibat->tentruyen}}</p>
                </div>
            </div>
        @endforeach

        <h3 class="card-header">Truyện xem nhiều</h3>
        @foreach($truyen_xemnhieu as $key => $xemnhieu)
            <div class="row mt-2">
                <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" 
                src="{{asset('public/uploads/truyen/'.$xemnhieu->hinhanh)}}" alt="{{$xemnhieu->tentruyen}}"></div>

                <div class="col-md-7 sidebar">
                    <a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}"></a>
                    <p>{{$xemnhieu->tentruyen}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection