@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Liệt kê truyện</div>
                
                <div class="card-body">
                    <div id="thongbao"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên truyện</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Slug truyện</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Nổi bật</th>
                            <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_truyen as $key => $truyen)
                                <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$truyen->tentruyen}}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" width="200" height="200" alt=""></td>
                                <td>{{$truyen->slug_truyen}}</td>
                                <td>{{$truyen->tomtat}}</td>
                                <td>{{$truyen->danhmuctruyen->tendanhmuc}}</td>
                                <td>{{$truyen->theloai->tentheloai}}</td>
                                <td>
                                    @if($truyen->kichhoat==1)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                        
                                    @endif
                                </td>

                                <td>{{$truyen->created_at}} - {{$truyen->created_at->diffForHumans()}}</td>
                                <td>
                                    @if($truyen->updated_at!='')
                                        {{$truyen->updated_at}} - {{$truyen->updated_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td width="10%">
                                    @if($truyen->truyen_noibat==0)
                                    <form>
                                    @csrf
                                       <select name="truyennoibat" class="custom-select truyennoibat">
                                           @if($truyen->truyen_noibat==0)
                                                <option selected value="0">Truyện mới</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                           @endif
                                       </select>
                                    </form>
                                    @elseif($truyen->truyen_noibat==1)
                                    <form>
                                    @csrf
                                        <select name="truyennoibat" class="custom-select truyennoibat">
                                            @if($truyen->truyen_noibat==1)
                                                <option value="0">Truyện mới</option>
                                                <option selected value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            @endif
                                        </select>
                                    </form>
                                    @else
                                    <form>
                                    @csrf
                                        <select name="truyennoibat" class="custom-select truyennoibat">
                                            @if($truyen->truyen_noibat==2)
                                                <option value="0">Truyện mới</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option selected value="2">Truyện xem nhiều</option>
                                            @endif
                                        </select>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('truyen.destroy',[$truyen->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('truyen.edit',[$truyen->id])}}" class="btn btn-primary">Sửa</a>
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