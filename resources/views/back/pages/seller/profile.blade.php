@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('seller.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('sellerProfilePictureFile').click();" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    <img src="{{ $seller->picture }}" alt="" class="avatar-photo" id="sellerProfilePicture">
                    <input type="file" name="sellerProfilePictureFile" id="sellerProfilePictureFile" class="d-none"
                    style="opacity: 0">
                </div>
                <h5 class="text-center h5 mb-0" id="sellerProfileName">{{ $seller->name }}</h5>
                <p class="text-center text-muted font-14" id="sellerProfileEmail">
                    {{ $seller->email }}
                </p>
            
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                @livewire('seller-profile-tabs')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        window.addEventListener('updateSellerInfo', function(event){
            $('#sellerProfileName').html(event.detail.sellerName);
            $('#sellerProfileEmail').html(event.detail.sellerEmail);
        });

        $('input[type="file"][name="sellerProfilePictureFile"][id="sellerProfilePictureFile"]').ijaboCropTool({
          preview : '#sellerProfilePicture',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("seller.change-profile-picture") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            Livewire.dispatch('updateAdminSellerHeaderInfo');//Livewire.emit('updateAdminSellerHeaderInfo');
             //alert(message);
             toastr.success(message);
          },
          onError:function(message, element, status){
            //alert(message);
            toastr.error(message);
          }
       });

       /*$(document).ready(function(){
        
        $('#payment_method_id').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: '/seller/payment-methods',
                type: 'get',
                dataType: 'json',
                success: function(response){
                    
                    var len = 0;
                    if(response != null){
                        len = response.length;
                    }

                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){

                            var id = response[i].id;
                            var name = response[i].payment_name;

                            var option = "<option value='"+id+"'>"+name+"</option>";

                            $("#payment_method_id").append(option); 
                        }
                    }

                }
            });
        });*/

    </script>
    
@endpush
