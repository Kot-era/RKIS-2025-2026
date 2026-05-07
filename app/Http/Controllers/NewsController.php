<?php
namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NewsController extends Controller {
    public function index() {
        $news = News::where('is_published',1)->latest()->paginate(9);
        return view('news.index',compact('news'));
    }
    public function show(News $news) {
        return view('news.show',compact('news'));
    }
    public function store(Request $request) {
        $request->validate(['title'=>'required|max:255','content'=>'required','category'=>'required']);
        News::create(['title'=>$request->title,'content'=>$request->content,'category'=>$request->category,'image'=>$request->image,'author_id'=>Auth::id(),'is_published'=>1]);
        return back()->with('success','Новость опубликована');
    }
    public function destroy(News $news) {
        $news->delete();
        return back()->with('success','Новость удалена');
    }
}