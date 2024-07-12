<!-- js -->
<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script>
			if( navigator.userAgent.indexOf("Firefox") != -1 ){
				history.pushState(null, null, document.URL);
				window.addEventListener('popstate', function(){
					history.pushState(null, null, document.URL);
				});
			}
		</script>
		{{-- <script src="{{ asset('extra-assets/ijabo/ijabo.min.js') }}"></script>
		<script src="{{ asset('extra-assets/ijabo/jquery.ijaboViewer.min.js') }}"></script> --}}
		<script src="{{ asset('extra-assets/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
		<script src="{{ asset('extra-assets/jquery-ui-1.13.2/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('extra-assets/summernote/summernote-bs4.min.js') }}"></script>

@kropifyScripts
<script>
    window.addEventListener('updateAdminInfo', event => {
        $('#adminProfileName').html(event.detail[0].adminName);
        $('#adminProfileEmail').html(event.detail[0].adminEmail);
    });
		window.addEventListener('showToastr', function(event){
                  toastr.remove();
				  if( event.detail[0].type === 'info' ){ toastr.info(event.detail[0].message); }
				  else if( event.detail[0].type === 'success' ){ toastr.success(event.detail[0].message); }
				  else if( event.detail[0].type === 'error' ){ toastr.error(event.detail[0].message); }
				  else if( event.detail[0].type === 'warning' ){ toastr.warning(event.detail[0].message); }
				  else{ return false; }
			});

    // window.addEventListener('successFlash', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "Your Password has been updated  successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('settingsUpdating', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "Settings Updated Successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('socialNetworkUpdate', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "SocialNetwork Updated Successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('updateCategoriesOrderingSuccess', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "Categories ordering have been successfully updated.",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('c', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "Category  has been Deleted successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('deleteSubCategorySuccess', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "success",
    //         title: "SubCategory  has been Deleted successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });
    // window.addEventListener('updateSellerPassword', event => {
    //     Swal.fire({
    //         position: "top-end",
    //         icon: "error",
    //         title: "Seller Password  has been Updated successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });

</script>

@stack('scripts')
