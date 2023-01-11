<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubscriberController extends Controller
{
    public function __construct()
    {
//        $this->middleware(['admin']);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $subscribers = User::query()->where('type', 'subscriber')->select(['name', 'username', 'password', 'status']);
            return DataTables::of($subscribers)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subscribers.index');
    }

    public function create()
    {
        return view('admin.subscribers.create');
    }

    public function store(Request $request)
    {
        
    }

}
