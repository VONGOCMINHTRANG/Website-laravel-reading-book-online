@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Liệt kê chapter</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên chapter</th>
                            <th scope="col">Slug chapter</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Thuộc truyện</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapter as $key => $chap)
                                <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$chap->tieude}}</td>
                                <td>{{$chap->slug_chapter}}</td>
                                <td>{{$chap->tomtat}}</td>
                                <td>{{$chap->truyen->tentruyen}}</td>
                                <td>
                                    @if($chap->kichhoat==1)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                        
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('chapter.destroy',[$chap->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('chapter.edit',[$chap->id])}}" class="btn btn-primary">Sửa</a>
                                        <button onclick="return confirm('Bạn chắc chắn muốn xóa truyện này ?')" class="btn btn-danger">Xóa</button>

                                    </form>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection