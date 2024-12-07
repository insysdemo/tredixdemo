<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\ApiResponse;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;



class ProductController extends Controller
{
    use ApiResponse;
    // Display a listing of the resource
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $Customer = Customer::all();
        $html = (string)view('admin.products.create', compact('Customer'));
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|max:255|unique:products',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'customer_id' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());
        return $this->sendResponse('Product created successfully', 200);
    }

    // Display the specified resource
    public function show($id) {}

    // Show the form for editing the specified resource
    public function edit($id)
    {

        $Customer = Customer::all();
        $product = Product::findOrFail($id);
        $html = (string) view('admin.products.edit', compact('product', 'Customer'));
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_code' => 'required|string|max:255|unique:products,product_code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
        ]);
        $id = base64_decode($id);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $this->sendResponse('Product updated successfully.', 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $id = base64_decode($id);

        $product = Product::findOrFail($id);
        $product->delete();
        return $this->sendResponse('Product deleted successfully.', 200);
    }


    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'product_code',
            3 => 'description',
            4 => 'price',
        );
        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;

        $user = new Product();
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
            // dd($row);
            $delete = '';
            $edit = '';
            $sendEmail = '';
            $delete = (string) view("admin.common.deletebtn", ["url" => route('products.destroy', base64_encode($row->id))]);

            $edit = '<a onclick="editProduct( this, ' . $row->id . ')" data-target="commonModal" class="mr-1 shadow btn btn-primary btn-sm sharp" style="width:40px;" >' . '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"style="fill:white; " ><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>' . '</a>';
            $jsonObject = array();
            $sendEmail = '<a href="' . route('products.sendEmail', ['customer_id' => $row->id]) . '" 
            class="mr-1 shadow btn btn-success btn-sm sharp" 
            style="width:40px">
             Send Email
         </a>';



            $jsonObject[] = '<input type="checkbox" class="w-4 h-4 check-item" name="checkid[]" value="' . $row->id . '"/>';
            $jsonObject[] = $row->name;
            $jsonObject[] = $row->product_code;
            $jsonObject[] = $row->description;
            $jsonObject[] = $row->price;
            $jsonObject[] = $delete . $edit . $sendEmail;
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode($jsonArray);
    }


    public function sendEmail(Request $request,$id)
    {
        $Product = Product::with('customer')->find($id);
        if (!$Product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $pdf = PDF::loadView('Admin.emails.attachment-content', compact('Product'));
        $attachmentPath = storage_path('app/public/customer-report-' . $Product->id . '.pdf');
        $pdf->save($attachmentPath);

        try {
            Mail::send([], [], function ($message) use ($Product, $attachmentPath) {
                $message->to($Product->customer->email)
                    ->subject('Your Email Subject')
                    ->attach($attachmentPath);
            });

            return redirect()->back()->with('success', 'Email sent successfully to ' . $Product->customer->email);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
