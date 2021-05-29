<?php

namespace App\Http\Controllers;


use App\Models\Aarshbook;
use App\Models\AarshDesc;
use App\Models\Aarshgranth;
use App\Models\Aarshchapter;
use Illuminate\Http\Request;

class AarshGranthController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

      public function index()
    {
        $allLanguages = Aarshbook::select('languages.id', 'languages.name')
            ->join('languages', 'aarshbooks.language_id', 'languages.id')
            ->get();

        return view('front.arsh.arsh', [
            'allLanguages' => $allLanguages,
        ]);

    }

   public function granths($languageId)
    {
        if (!$languageId) {
            $allChapters = Aarshbook::select('languages.id', 'languages.name')
                ->orderBy('aarshbooks.id', 'asc')
                ->join('languages', 'aarshbooks.language_id', 'languages.id')
                ->first();
            $languageId = $allChapters->id;
        }
        $granths = Aarshgranth::select('id', 'arshbook_title')
            ->orderBy('aarshgranths.id', 'asc')
            ->where('aarsh_book_id', '=', $languageId)
            ->get();
        return response()->json(array(
            'granths' => $granths,
        ));
    }

     public function chapters($granthId)
    {
        $chapters = Aarshchapter::select('id', 'arshchapter_no')
            ->orderBy('aarshchapters.id', 'asc')
            ->where('granth_title_id', '=', $granthId)
            ->get();
        return response()->json(array(
            'chapters' => $chapters,
        ));
    }
   
    public function chapter($chapterkId)
    {        
        $chapter = Aarshchapter::where('id', '=', $chapterkId)->first();   
        $granth = AarshGranth::where('id', '=', $chapterkId)->first();   
        $aarshdec = AarshDesc::where('chapter_title_id', '=', $chapterkId)->get();
      

       
        return view('front.arsh.arsh_details', [
           
            'chapter' => $chapter,           
            'granth' => $granth,    
            'aarshdec' => $aarshdec,          
             
        ]);
    } 

}
