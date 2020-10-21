<?php

namespace App\Exports;

use App\Stock;
use App\StockProgress;
use App\StockProgressDetail;
use App\TimeMilestone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockProgressExport implements  Responsable, FromView
{
    use Exportable;

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;


    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $stockProgressData =  StockProgress::where('id',$this->id)->first();
        $stockData =  Stock::where('id',$stockProgressData->stock_id)->first();
        $timeMileStonesOfStock =  TimeMilestone::where('stock_id',$stockProgressData->stock_id)->orderBy( 'minutes' )->get();
        $stockProgressDetailData =  StockProgressDetail::select('last','value', 'minutes', 'hours','date')->where('stock_progress_id',$this->id)->where('last',0)->get();
        $stockProgressDetailHoursData =  StockProgressDetail::select('hours')->where('stock_progress_id',$this->id)->where('last',0)->groupBy('hours')->get();
        $stockProgressDetailLast =  StockProgressDetail::select('value')->where('stock_progress_id',$this->id)->where('last',1)->first();
        return view('exports.stock-progress', [
        'stockProgressData' => $stockProgressData,
        'timeMileStonesOfStock' => $timeMileStonesOfStock,
        'stockProgressDetailData' => $stockProgressDetailData,
        'stockProgressDetailHoursData' => $stockProgressDetailHoursData,
        'stockProgressDetailLast' => $stockProgressDetailLast,
        'stockData' => $stockData,

    ]);
    }
}
