<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreSubscriber;
use App\Http\Requests\UpdateSubscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubscriberController extends Controller
{

    public function __construct()
    {
//        $this->middleware(['auth']);
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
        $storeRequest = new StoreSubscriber();
        $validator = Validator::make($request->all(), $storeRequest->rules(), $storeRequest->messages());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {
            $user = User::create([
                'name' => $request["name"],
                'username' => $request["username"],
                'password' => Hash::make($request["password"]),
                'status' => $request["status"],
                'type' => 'subscriber',
            ]);
            $user->refresh();

            return response()->json("Subscriber added successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function edit($subscriber)
    {
        $subscriber = User::find($subscriber);
        return view('admin.subscribers.edit', compact('subscriber'));
    }

    public function update(Request $request, $subscriber)
    {
        $updateRequest = new UpdateSubscriber();
        $validator = Validator::make($request->all(), $updateRequest->rules(), $updateRequest->messages());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {

            User::find($subscriber)->update([
                'name' => $request["name"],
                'username' => $request["username"],
                'password' => Hash::make($request["password"]),
                'status' => $request["status"],
                'type' => 'subscriber',
            ]);

            return response()->json("Subscriber updated successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function destroy($subscriber)
    {
        try {
            User::find($subscriber)->delete();
            return response()->json("Subscriber deleted successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
