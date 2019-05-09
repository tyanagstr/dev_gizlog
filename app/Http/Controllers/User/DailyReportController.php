<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\DailyReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    protected $report;
    public function __construct(DailyReport $report) {
        $this->middleware('auth');
        $this->report = $report;
    }

    /**
     * 日報一覧画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 日報をすべて取得
        $reports = $this->report
            ->all()
            ->where('user_id', '=', Auth::user()->id);

        return view(
            'user.daily_report.index',
            compact('reports')
        );
    }

    /**
     * 日報作成画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create');
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
