@extends('../layout')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('the-loai/'.$truyen_breadcrumb->theloai->slug_theloai)}}">{{$truyen_breadcrumb->theloai->tentheloai}}</a></li>
    <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen_breadcrumb->danhmuctruyen->slug_danhmuc)}}">{{$truyen_breadcrumb->danhmuctruyen->tendanhmuc}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$truyen_breadcrumb->tentruyen}}</li>
  </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <h4>{{$chapter->truyen->tentruyen}}</h4>
        <p>Chương hiện tại : {{$chapter->tieude}}</p>
        <div class="col-md-5">
           <style>
                .isDisabled{
                    color: currentColor;
                    pointer-events: none;
                    opacity: 0.5;
                    text-decoration: none;
                }
           </style>
            <div class="form-group">
                <label for="exampleInputEmail1">Chọn chương :</label>
                <p><a href="{{url('xem-chapter/'.$previous_chapter)}}" class="btn btn-primary {{$chapter->id==$min_id->id ? 'isDisabled' : ''}}">Chương trước</a></p>
                <select name="kichhoat" class="custom-select select-chapter">
                    @foreach($all_chapter as $key => $all)
                    <option value="{{url('xem-chapter/'.$all->slug_chapter)}}">{{$all->tieude}}</option>
                    @endforeach
                </select>
                <p class="mt-4"><a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-primary {{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">Chương sau</a></p>
            </div>      
        </div>
       
        <div class="noidungchuong">
            <p>{{$chapter->noidung}}</p>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Chọn chương :</label>
                    <select name="kichhoat" class="custom-select select-chapter">
                        @foreach($all_chapter as $key => $all)
                        <option value="{{url('xem-chapter/'.$all->slug_chapter)}}">{{$all->tieude}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
           
        </div>
       
        <h5><strong>Lưu và chia sẻ truyện</strong></h5>
                <div class="fb-share-button" data-href="{{\URL::current()}}"
                 data-layout="button_count" data-size="large"><a target="_blank" 
                 href="{{\URL::current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>

                    </div>
                </div>
    </div>
</div>
@endsection