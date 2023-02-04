<?php

namespace App\Http\Controllers;


use App\Actions\StoreSubscriberAction;
use App\Actions\UpdateSubscriberAction;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubscriberController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $subscribers = User::query()->where('type', 'subscriber')->select(['id', 'name', 'username', 'password', 'status']);
            return DataTables::of($subscribers)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $route = url('subscribers/' . $row->id);
                    $btn = '<a href="' . route('subscribers.edit', $row->id) . '"  class="btn-secondary m-1  btn btn-sm edit-subscriber">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" data-url="' . $route . '" class="btn-danger btn btn-sm delete-subscriber">Delete</a>';
                    return $btn;
                })->filter(function ($instance) use ($request) {
                    if ($request->get('status'))
                        $instance->where('status', $request->get('status'));

                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('username', 'LIKE', "%$search%");
                        });
                    }
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

    public function store(StoreSubscriberRequest $storeSubscriberRequest, StoreSubscriberAction $storeSubscriberAction)
    {
        try {
            $storeSubscriberAction->execute($storeSubscriberRequest->toDTO());
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

    public function update(UpdateSubscriberRequest $updateSubscriberRequest, UpdateSubscriberAction $updateSubscriberAction, $subscriber)
    {
        try {
            $updateSubscriberAction->execute($updateSubscriberRequest->toDTO(), $subscriber);
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
