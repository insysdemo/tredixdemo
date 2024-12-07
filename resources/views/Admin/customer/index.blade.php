@extends('admin.layouts.app')
@section('title', 'Admin | Customer')
@section('nav-link')
    <a href="#" class="nav-link disabled">Customer</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           
                            <h3 class="ml-auto">Customer</h3>
                            
                            <button type="button" class="btn btn-primary ml-auto" onclick="createCustomer(this)" data-target="commonModal">Create</button>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="customer" class="table table-striped display nowrap " style="width:100%">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" overflow-stick" >


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      



    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/customer/index.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>


    
@endsection


