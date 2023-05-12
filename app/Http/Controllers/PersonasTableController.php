<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonasTableController extends Controller
{
    public function table(Request $request) {
        $query = DB::table('personas');

        if ($request->has('sortKey') && $request->has('sortOrder')) {
            if($request->sortKey != '' && $request->sortOrder != ''){
                $query->orderBy($request->sortKey, $request->sortOrder);
            }
        }

        if ($request->has('columnFilters')) {
            if($request->columnFilters != ''){
                foreach ($request->columnFilters as $key => $value) {
                    $query->where($key, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $perPage = $request->input('perPage', 10);
        $currentPage = $request->input('currentPage', 1);

        $total = $query->count();

        if($perPage > 0){
            $data = $query
            ->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();
        }else{
            $data = $query
            ->get();
        }

        return response()->json([
            'data' => $data,
            'total' => $total,
        ]);
    }

    public function tableCumple(Request $request) {
        $now = Carbon::now();
        $month = $now->month;
        $day = $now->day;
        $query = DB::table('personas')
        ->whereMonth('fecha_nacimiento', '=', $month)
        ->whereDay('fecha_nacimiento', '=', $day);

        if ($request->has('sortKey') && $request->has('sortOrder')) {
            if($request->sortKey != '' && $request->sortOrder != ''){
                $query->orderBy($request->sortKey, $request->sortOrder);
            }
        }

        if ($request->has('columnFilters')) {
            if($request->columnFilters != ''){
                foreach ($request->columnFilters as $key => $value) {
                    $query->where($key, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $perPage = $request->input('perPage', 10);
        $currentPage = $request->input('currentPage', 1);

        $total = $query->count();

        if($perPage > 0){
            $data = $query
            ->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();
        }else{
            $data = $query
            ->get();
        }

        return response()->json([
            'data' => $data,
            'total' => $total,
        ]);
    }

}
