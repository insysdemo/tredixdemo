<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Caster\CutStub;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.user.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $html = (string)view('admin.user.create');
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $user = new Customer();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        // $user->password = Hash::make('12345678');

        $user->save();
        return $this->sendResponse('Customer create successfully.', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Customer::where('id', $id)->first();
        $html = (string) view('admin.user.edit', compact('user'));
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|max:255',

        ]);
        $id = base64_decode($id);

        $user = Customer::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();
        return $this->sendResponse('Customer updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = base64_decode($id);
        
        Customer::where('id', $id)->delete();
        return $this->sendResponse('Customer deleted successfully.', 200);
    }
    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            1 => 'email',
        );
        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;

        $user = new Customer();
        $jsonArray['recordsTotal'] = $user->count();
        if ($request->search['value']) {
            $search = $request->search['value'];
            $user = $user->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
            });
        }
        $jsonArray['recordsFiltered'] = $user->count();
        $user = $user->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        foreach ($user as $row) {
            $delete = '';
            $edit = '';
            $delete = (string) view("admin.common.deletebtn", ["url" => route('users.destroy', base64_encode($row->id))]);
         
            $edit = '<a onclick="editUser( this, ' . $row->id . ')" data-target="commonModal" class="mr-1 shadow btn btn-primary btn-sm sharp" style="width:40px;" >' . '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"style="fill:white; " ><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>' . '</a>';            $jsonObject = array();
            $jsonObject[] = '<input type="checkbox" class="w-4 h-4 check-item" name="checkid[]" value="' . $row->id . '"/>';
            $jsonObject[] = $row->name;
            $jsonObject[] = $row->email;
            $jsonObject[] = $row->phone_number;
            $jsonObject[] = $delete . $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode($jsonArray);
    }

}
