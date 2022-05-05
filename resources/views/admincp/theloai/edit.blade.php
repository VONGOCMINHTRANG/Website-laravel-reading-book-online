@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật thể loại Truyện</div>
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
                    <form method="POST" action="{{route('theloai.update',[$theloai->id])}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thể loại</label>
                            <input type="text" value="{{$theloai->tentheloai}}" name="tentheloai" class="form-control" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" placeholder="Tên thể loại...">
                           
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug thể loại</label>
                            <input type="text" value="{{$theloai->slug_theloai}}" name="slug_theloai" class="form-control" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug thể loại...">
                           
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <textarea name="mota" id="" cols="30" rows="5" style="resize: none;" class="form-control" value="{{$theloai->mota}}">{{$theloai->mota}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kích hoạt thể loại</label>
                            <select name="kichhoat" class="custom-select">
                                @if($theloai->kichhoat==1)
                                    <option selected value="1">Kích hoạt</option>
                                    <option value="0">Không kích hoạt</option>
                                @else
                                    <option value="1">Kích hoạt</option>
                                    <option selected value="0">Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
           
                        <button type="submit" class="btn btn-primary" name="capnhattheloai">Cập nhật</button>
                   
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
