@extends('../layout')
{{--@section('slide')
    @include('pages.slide')
@endsection--}}
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
    </ol>
</nav>
<h3>Từ khóa : {{$tag}}</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
            @php 
                 $count = count($truyen);
            @endphp
            @if($count==0)
                
                <div class="col-md-12">
                        <div class="card mb-12 box-shadow">
                            <div class="card-body">
                                <p>Không tìm thấy truyện...</p>
                            </div>
                            </a>
                        </div>
                        
                </div>
            @else

                @foreach($truyen as $key => $value)
                    <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" >
                            <div class="card-body">
                            <h7><strong>{{$value->tentruyen}}</strong></h7>
                            @php
                                $tomtat = substr($value->tomtattruyen,0,150);
                            @endphp                        
                            {{$tomtat.'......'}}
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                <a class="btn btn-sm btn-outline-secondary"><i class="far fa-eye">2712</i></a>
                                </div>
                                <small class="text-muted">9 mins ago</small>
                            </div>
                            </div>
                            </a>
                        </div>
                        
                    </div>
                @endforeach
            @endif
            
            </div>
            
        </div>
      
    </div>
@endsection