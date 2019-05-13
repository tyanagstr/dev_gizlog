<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\DailyReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DailyReportController extends Controller
{
    protected $report;
    public function __construct(DailyReport $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }

    /**
     * 日報一覧画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->query('search-month');
        if (!empty($date)) {
            $search_date = new Carbon(substr($date, 0, 7));
            $reports = $this->report->fetchUserReportsFilterdByDate(Auth::id(), $search_date);
        } else {
            $reports = $this->report->fetchAllUserReportsOfUser(Auth::id());
        }
        
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
     * 新たに日報を作成する
     *
     * @param  \App\Http\Requests\User\DailyReportRequest
     * @return \Illuminate\Http\Response
     */
    public function store(DailyReportRequest $request)
    {
        $this->report
             ->fill($request->all())
             ->save();
        return redirect()->route('report.index');
    }

    /**
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * 日報編集画面を表示する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * 日報の更新をする
     *
     * @param  \App\Http\Requests\User\DailyReportRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        $this->report
             ->find($id)
             ->fill($request->all())
             ->save();
        return redirect()->route('report.index');
    }

    /**
     * 日報を削除する(ただし論理削除)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = $this->report->destroy($id);
        return redirect()->route('report.index');
    }
}
