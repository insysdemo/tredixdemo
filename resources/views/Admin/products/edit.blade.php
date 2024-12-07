<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.update', base64_encode($product->id)) }}" method="POST"
                            id="formedit" redirect="{{ route('products.index') }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="name" name="name"
                                    autocomplete="off" autofocus value="{{ $product->name }}"
                                    placeholder="Enter user Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="product_code">product Code</label><span class="text-danger"> * </span>
                                <input type="product_code" class="form-control" name="product_code" autocomplete="off"
                                    autofocus="autofocus" value="{{ $product->name }}" placeholder="Enter product Code"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">descrptione</label><span class="text-danger"> * </span>
                                <input type="description" class="form-control" id="description" name="description"
                                    autocomplete="off" autofocus="autofocus" value="{{ $product->description }}"
                                    placeholder="Enter description" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="name">Price</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="price" name="price"
                                    autocomplete="off" autofocus="autofocus" value="{{ $product->price }}"
                                    placeholder="Enter price" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Select Customer</label><span class="text-danger">*</span>
                                <select class="form-control" id="customer_id" name="customer_id" tabindex="1">
                                    <option value="" disabled>Select Customer</option>
                                    @foreach ($Customer as $Customers)
                                        <option value="{{ $Customers->id }}"
                                            {{ $Customers->id == $product->customer_id ? 'selected' : '' }}>
                                            {{ $Customers->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('admin/formsubmit.js') }}"></script>
<script src="{{ asset('admin/common.js') }}"></script>
