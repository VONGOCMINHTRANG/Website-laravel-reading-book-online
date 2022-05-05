<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;

class IndexController extends Controller
{
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $truyen = Truyen::where('tinhtrang',1)->where('tentruyen','LIKE','%'.$data['keywords'].'%')->get();
            $output = '
                <ul class="dropdown-menu" style="display:block;">'
            ;

            foreach($truyen as $key => $tr){
                $output.= '
                    <li class="li_search_ajax"><a href="#">'.$tr->tentruyen.'</a></li>'; 
            }

            $output .='</ul>';
            echo $output;
       
        }
    }
    public function home(){
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->get();
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        return view('pages.home')->with(compact('danhmuc','truyen','theloai','slide_truyen'));
    }
    public function danhmuc($slug){
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $tendanhmuc = $danhmuc_id->tendanhmuc;
        $theloai = Theloai::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->where('danhmuc_id', $danhmuc_id->danhmuc_id)->get();
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','theloai','tendanhmuc','slide_truyen'));
    }
    public function theloai($slug){
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $tentheloai = $theloai_id->tentheloai;
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->where('theloai_id', $theloai_id->id)->get();
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        return view('pages.theloai')->with(compact('danhmuc','truyen','theloai','tentheloai','slide_truyen'));
    }
    public function xemtruyen($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('slug_truyen',$slug)->where('kichhoat',1)->first();   
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        $chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_moinhat = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();
        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->where('danhmuc_id',$truyen->danhmuctruyen->danhmuc_id)->whereNotIn('id',[$truyen->id])->get();
        $truyen_noibat = Truyen::where('truyen_noibat',1)->take(10)->get();
        $truyen_xemnhieu = Truyen::where('truyen_noibat',2)->take(10)->get();
        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','chapter_moinhat','theloai'
        ,'slide_truyen','truyen_noibat','truyen_xemnhieu'));
    }
    public function xemchapter($slug){
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $truyen = Chapter::where('slug_chapter',$slug)->first();
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        //breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();   
        //end breadcrumb
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $all_chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();

        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');

        $max_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('id','ASC')->first();

        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','next_chapter','previous_chapter','min_id'
        ,'max_id','theloai','truyen_breadcrumb','slide_truyen'));
    }
    public function timkiem(Request $request){
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();

        $tukhoa = $data['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orwhere('tomtat','LIKE','%'.$tukhoa.'%')
        ->orwhere('tacgia','LIKE','%'.$tukhoa.'%')
        ->get();
        return view('pages.timkiem')->with(compact('danhmuc','truyen','theloai','slide_truyen','tukhoa'));
    }
    public function tag($tag){
        $slide_truyen = Truyen::with('danhmuctruyen','theloai')->orderBy('id','DESC')->where('kichhoat',1)->take(8)->get();
        $danhmuc = DanhmucTruyen::orderBy('danhmuc_id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $tags = explode("-", $tag);
        $truyen = Truyen::with('danhmuctruyen','theloai')->where(
            function($query) use($tags){
                for($i = 0; $i < count($tags); $i++){
                    $query->orwhere('tukhoa','LIKE','%'.$tags[$i].'%');
                }
            })->paginate(12);

        return view("pages.tag")->with(compact('danhmuc','theloai','slide_truyen','tag','truyen'));
    }
}
