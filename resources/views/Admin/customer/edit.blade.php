
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.update',base64_encode($Customer->id)) }}" method="POST" id="formedit"
                            redirect="{{ route('customer.index') }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="name" name="name" autocomplete="off" autofocus
                                    value="{{ $Customer->name }}" placeholder="Enter user Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="Email" name="email" autocomplete="off" autofocus
                                    value="{{ $Customer->email }}" placeholder="Enter user Email" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="name">phone Number</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" autocomplete="off" autofocus="autofocus"
                                value="{{ $Customer->phone_number }}" placeholder="Enter phone Number" autocomplete="off">
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

<script>

</script>