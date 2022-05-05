@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật truyện</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{route('truyen.update',[$truyen->id])}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->tentruyen}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug" 
                            aria-describedby="emailHelp" placeholder="Tên truyện...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tác giả</label>
                            <input type="text" class="form-control" value="{{$truyen->tacgia}}" name="tacgia" 
                            aria-describedby="emailHelp" placeholder="Tên truyện...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" 
                            aria-describedby="emailHelp" placeholder="Slug truyen...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tóm tắt truyện</label>
                            <textarea name="tomtat" id="" cols="30" rows="5" style="resize: none;" class="form-control" >{{$truyen->tomtat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục truyện</label>
                                <select name="danhmuc" class="custom-select">
                                    @foreach($danhmuc as $key => $muc)
                                        <option {{$muc->danhmuc_id==$truyen->danhmuc_id ? 'selected' : ''}} value="{{$muc->danhmuc_id}}">{{$muc->tendanhmuc}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thể loại truyện</label>
                                <select name="theloai" class="custom-select">
                                    @foreach($theloai as $key => $the)
                                        <option {{$the->id==$truyen->theloai_id ? 'selected' : ''}} value="{{$the->id}}">{{$the->tentheloai}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh truyện</label>
                            <input type="file" class="form-control-file" name="hinhanh">
                            <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" alt="" height="200" width="200">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kích hoạt truyện</label>
                                <select name="kichhoat" class="custom-select">
                                    @if($truyen->kichhoat==1)
                                        <option selected value="1">Kích hoạt</option>
                                        <option value="0">Không kích hoạt</option>
                                    @else
                                        <option value="1">Kích hoạt</option>
                                        <option selected value="0">Không kích hoạt</option>
                                    @endif
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Truyện nổi bật/hot</label>
                                <select name="truyennoibat" class="custom-select">
                                    @if($truyen->truyen_noibat==0)
                                        <option selected value="0">Truyện mới</option>
                                        <option value="1">Truyện nổi bật</option>
                                        <option value="2">Truyện xem nhiều</option>
                                    @elseif($truyen->truyen_noibat==1)
                                        <option value="0">Truyện mới</option>
                                        <option selected value="1">Truyện nổi bật</option>
                                        <option value="2">Truyện xem nhiều</option>
                                    @else
                                        <option value="0">Truyện mới</option>
                                        <option value="1">Truyện nổi bật</option>
                                        <option selected value="2">Truyện xem nhiều</option>
                                    @endif

                                </select>
                        </div>

                        <button type="submit" name="capnhattruyen" class="btn btn-primary">Cập nhật truyện</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
