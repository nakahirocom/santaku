<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmallLabel;
use App\Models\LargeLabel;
use App\Models\MiddleLabel;

class NewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $largelabelList = LargeLabel::all();
        $middlelabelList = MiddleLabel::all();
        $smalllabelList = SmallLabel::all();

        return view('santaku.new')
            ->with('largelabelList', $largelabelList)
            ->with('middlelabelList', $middlelabelList)
            ->with('smalllabelList', $smalllabelList);




        return view('santaku.new', ['name' => 'santaku']);
    }
}
