@extends('admin.layouts.app')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" action="{{ route('admin.createBlog') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">Title</label>
                                        <div class="col-md-12">
                                            <input type="text" value="" class="form-control form-control-line" name="title">
                                        </div>
                                        
                                    </div>
                                    @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label for="description" class="col-md-12">Description</label>
                                        <div class="col-md-12">
                                            <input type="text" value="" class="form-control form-control-line" name="description" id="example-email" >
                                        </div>
                                    </div>
                                    @error('description')
                                            <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label for="file">Choose file to upload</label>
                                        <input type="file" id="image" name="image" />
                                    </div>
                                    @error('image')
                                            <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label for="content" class="col-md-12">content</label>
                                        <div class="col-md-12">
                                        <textarea id="" name="content" id="content" style="height: 200px;width: 500px;"></textarea>
                                        <!-- <textarea type="text" value="" class="form-control form-control-line" name="content" id="content" > -->
                                        </div>
                                    </div>
                                    @error('content')
                                            <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Create Blog</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
            <script>
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
</script>
@endsection()


@section('js-custom')

@endsection()