<!-- <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/misc.js') }}"></script> -->

    <script src="{{ asset('boostrap-admin-2/vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('boostrap-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('boostrap-admin-2/vendor/jquery-easing/jquery.easing.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('boostrap-admin-2/js/sb-admin-2.min.js') }} "></script>

    
    <!-- Page level plugins
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/datatables-demo.js"></script> --> -->
   
    <script>
        $(document).ready(function(){
            var url = location.pathname;
            var arr =url.split('/');
            var id = arr[1];
            $('.collapse').removeClass('show');
            $('.collapse-item').removeClass('active');
            @foreach(App\Models\Feature::orderBy('feature_name','asc')->get() as $menuItem)
            
                if(id == '{{ strtolower($menuItem->feature_name) }}')
                {
                 $('#collapse_{{ $menuItem->feature_group_id }}').addClass('show');
                 $('#collapse_item_'+id).addClass('active');
                }

            @endforeach
         });  
         $('.nav-item').click(function(e) {  
            $('.collapse').removeClass('show');
            
        });
    </script>
        

