<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use App\Storage;
use App\Article;
use App\Provider;
use App\ArticleIncome;
use App\ArticleIncomeItem;
use App\ArticleRequest;
use App\ArticleRequestItem;
use App\Stock;
use App\User;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Auth::user()->usr_usuario;
        $title = "Reporte ";
        $date =Carbon::now();
        $storage = Auth::user()->getStorage()->name;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('layouts.print', compact('username','date','title','storage'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));

        // $pdf = new TCPDF();
        // $pdf::SetTitle('Hello World');
        // $pdf::AddPage();
        // $pdf::writeHTML($html_content, true, false, true, false, '');
        // $pdf::Output('hello_world.pdf');

        // $username = Auth::user()->usr_usuario;
        // $title = "Reporte ";
        // $date =Carbon::now();
        // $html = view('layouts.test')->render();
        // // return view('layouts.print',compact('username','date','title'));


        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // // PDF::writeHTML(view('layouts.print',compact('username','date','title'))->render(), true, false, true, false, '');
        // PDF::writeHTML($html, true, false, true, false, '');

        // PDF::Output('hello_world.pdf');
    }

    public function income_note($article_income_id)
    {
        $article_income = ArticleIncome::find($article_income_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE INGRESO ";
        $date =Carbon::now();
        $persona = Auth::user()->getFullName();
        $gerencia = Auth::user()->getGerencia();
        $storage = Auth::user()->getStorage()->name;//cambiar esto no me acuerdo por que lo deje estatico XD
        $code =  $article_income->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_income->created_at)->year;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('report.income_note', compact('username','date','title','storage','article_income','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function request_note($article_request_id)
    {
        $article_request = ArticleRequest::find($article_request_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SOLICITUD ";
        $date =Carbon::now();
        $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        $persona = $user->getFullName(); //esto esta mal tambien
        $gerencia = $user->getGerencia();
        $storage = $article_request->storage_destiny->name;
        $code =  $article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.request_note', compact('username','date','title','storage','article_request','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function out_note($article_request_id)
    {
        $article_request = ArticleRequest::find($article_request_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SALIDA ";
        $date =Carbon::now();
        $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        $persona = $user->getFullName(); //esto esta mal tambien
        $gerencia = $user->getGerencia();
        $storage = $article_request->storage_destiny->name;
        $code =  $article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.out_note', compact('username','date','title','storage','article_request','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}