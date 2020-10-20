<?php

namespace App\Exports;

use App\StockProgress;
use App\StockProgressDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockProgressExport implements FromCollection
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StockProgressDetail::where('stock_progress_id',$this->id)->get();
    }
}
