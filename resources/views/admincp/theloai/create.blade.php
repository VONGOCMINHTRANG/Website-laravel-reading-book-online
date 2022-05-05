@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm thể loại Truyện</div>
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
                    <form method="POST" action="{{route('theloai.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thể loại</label>
                            <input type="text" value="{{old('tentheloai')}}" name="tentheloai" class="form-control" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" placeholder="Tên thể loại...">
                           
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug thể loại</label>
                            <input type="text" value="{{old('slug_theloai')}}" name="slug_theloai" class="form-control" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug thể loại...">
                           
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <textarea name="mota" id="" cols="30" rows="5" style="resize: none;" class="form-control" value="{{old('mota')}}"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kích hoạt thể loại</label>
                            <select name="kichhoat" class="custom-select">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="themtheloai">Thêm thể loại</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection