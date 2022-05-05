<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sách truyện</title>

        <!-- Styles -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style type="text/css">
            h5{
                font-weight: bold;
                line-height: 25px;
            }
            .switch_color{
                background: #181818;
                color: #fff;
            }
            .switch_color_light{
                background: #181818 !important;
                color: #000;
            }
            .noidung_color{
                color: #fff;
            }
        </style>
       
    </head>
    <body>
        <div class="container">
            <!--------------------------Menu---------------------------->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{url('/')}}">Sachtruyen.com</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home"></i>Trang chủ<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars"></i>Danh mục
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($danhmuc as $key => $danh)
                                <a class="dropdown-item" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tags"></i>Thể loại
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($theloai as $key => $the)
                                <a class="dropdown-item" href="{{url('the-loai/'.$the->slug_theloai)}}">{{$the->tentheloai}}</a>
                            @endforeach
                        </div>
                    </li>
                    </ul>
                    <form autocomplete="off" class="form-inline my-2 my-lg-0" method="POST" action="{{url('tim-kiem')}}">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" id="keywords" name="tukhoa" placeholder="Tìm kiếm tác giả, truyện..."
                         aria-label="Search">
                         <div id="search_ajax"></div>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>

                        <select id="switch_color" class="custom-select mr-sm-2">
                            <option value="xam">Xám</option>
                            <option value="den">Đen</option>
                        </select>
                    </form>
                </div>
            </nav>

            <!--------------------------Slide--------------------------->
            @yield('slide')
            <hr>

            <!-------------------------Sách mới------------------------------>
            @yield('content')

            <footer class="text-muted">
                <div class="container">
                    <p class="float-right">
                    <a href="#">Trang chủ</a>
                    </p>
                    <p>SachTruyen.com - Website đọc truyện nhanh nhất, thân thiện nhất, và luôn cập nhật mới nhất. Đọc truyện online, đọc truyện chữ, truyện full, truyện hay. Hỗ trợ mọi trình duyệt và thiết bị di động.</p>
                    <p>Liên hệ: vongocminhtrang2712@gmail.com</p>
                </div>
            </footer>
        </div>
      <script src="{{asset('js/app.js')}}"></script>
      <script src="{{asset('js/owl.carousel.js')}}"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script type="text/javascript">
          show_wishlist();
        function show_wishlist(){
              if(localStorage.getItem('wishlist_truyen')!=null){
                  var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
                  data.reverse();

                for(i=0;i<data.length;i++){
                      var title = data[i].title;
                      var img = data[i].img;
                      var id = data[i].id;
                      var url = data[i].url;

                      $('#yeuthich').append(
                        `
                        <div class="row mt-2">
                            <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="`+img+`" alt="`+title+`"></div>

                            <div class="col-md-7 sidebar">
                                <a href="`+url+`">
                                    <p>`+title+`</p>
                                </a>
                            </div>
                        </div>
                        `
                      );
                }
            }
          }

          $('.btn-thich_truyen').click(function(){
              $('.fa.fa-heart').css('color','#fac');
              const id = $('.wishlist_id').val();
              const title = $('.wishlist_title').val();
              const img = $('.card-img-top').attr('src');
              const url = $('.wishlist_url').val();

              const item = {
                  'id': id,
                  'title':title,
                  'img': img,
                  'url':url
              }
              if(localStorage.getItem('wishlist_truyen')==null){
                  localStorage.setItem('wishlist_truyen','[]')
              }
              var old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));
              var matches = $.grep(old_data,function(obj){
                  return obj.id == id;
              })
              if(matches.length){
                  alert('Truyện đã có trong danh sách yêu thích');
              }else{
                  if(old_data.length<=5){
                      old_data.push(item);
                  }else{
                      alert('Đã đạt tới giới hạn lưu truyện yêu thích');
                  }
                  $('#yeuthich').append(`
                    <div class="row mt-2>
                        <div class="col-md-5"><img class="img img-responsive" width="50%" class="card-img-top" src="`+img+`" alt="`+title+`"></div>
                        <div class="col-md-7 sidebar">
                            <a href="`+url+`">
                                <p style="color:#666">`+title+`</p>
                            </a>
                        </div>
                    </div>
                `);

                localStorage.setItem('wishlist_truyen',JSON.stringify(old_data));
                alert('Đã lưu vào danh sách truyện yêu thích');
                
              }
              localStorage.setItem('wishlist_truyen',JSON_stringify(old_data));
              
          });
      </script>
      
      <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            dot:true,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })  
      </script>

        <script type="text/javascript">
            $('#keywords').keyup( function() {
                var keywords = $(this).val();
                if(keywords != '')
                {
                    var _token = $('input[name="_token]').val();
                    $.ajax({

                        url:"{{url('/timkiem-ajax')}}",
                        method:"POST",
                        data:{keywords:keywords, _token:_token},
                        success:function(data){
                            $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                        }

                    });
                }
                else{
                    $('#search_ajax').fadeOut();
                }
            });
                $(document).on('click','.li_search_ajax',function(){
                    $('#keywords').val( $(this).text() );
                    $('#search_ajax').fadeOut();
                })
            
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                if(localStorage.getItem('switch_color')!==null){
                    const data = localStorage.getItem('switch_color');
                    const data_obj = JSON.parse(data);
                    $(document.body).addClass(data_obj.class_1);
                    $('.album').addClass('data_obj.class_2');
                    $('.card-body').addClass('data_obj.class_1');
                    $('ul.mucluctruyen > li > a').css('color','#fff');
                    $('.slidebar > a').css('color','#fff');

                    $("select option[value='den']").attr("selected","selected");
                }
            })

            $("#switch_color").change(function(){
                $(document.body).toggleClass('switch_color');
                $('.album').toggleClass('switch_color_light');
                $('.card-body').toggleClass('switch_color');
                $('.noidungchuong').addClass('noidung_color');
                $('ul.mucluctruyen > li > a').css('color','#fff');
                $('.slidebar > a').css('color','#fff');

                if($(this).val() == 'den'){
                    var item = {
                        'class_1':'switch_color',
                        'class_2':'switch_color_light'
                    }
                    localStorage.setItem('switch_color',JSON.stringify(item));

                }else if($(this).val() == 'xam'){
                    localStorage.removeItem('switch_color');
                    $(ul.mucluctruyen > li > a).css('color','#000');
                }
            });
        </script>

       <script>
            $('.select-chapter').on('change',function(){
                var url = $(this).val();
                // alert(url);
                if(url){
                    window.location = url;
                }
                return false;
            });
            current_chapter();

            function current_chapter(){
                var url = window.location.href;
                $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
            }
        </script>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="ftqalIul"></script>
    </body>
</html>
