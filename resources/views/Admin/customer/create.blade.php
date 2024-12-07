
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.store') }}" method="POST"
                            redirect="{{ route('customer.index') }}" id="formcreate">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="name" name="name" autocomplete="off" autofocus="autofocus"
                                    placeholder="Enter User Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label><span class="text-danger"> * </span>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="off" autofocus="autofocus"
                                    placeholder="Enter User email" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="name">phone Number</label><span class="text-danger"> * </span>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" autocomplete="off" autofocus="autofocus"
                                    placeholder="Enter phone Number" autocomplete="off">
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