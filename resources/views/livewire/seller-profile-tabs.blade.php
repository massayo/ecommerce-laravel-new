<div>
    <div class="profile-tab height-100-p">
        <div class="tab height-100-p">
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("personal_details")' class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab" href="#personal_details" role="tab">Personal details</a>
                </li>
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("update_password")' class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" data-toggle="tab" href="#update_password" role="tab">Update password</a>
                </li>
               <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                </li>
               -->
            </ul>
            <div class="tab-content">
                <!-- Timeline Tab start -->
                <div class="tab-pane fade  {{ $tab == 'personal_details' ? 'active show' : '' }}" id="personal_details" role="tabpanel">
                    <div class="pd-20">
                       <!--Pers. details-->
                       <form id="form1" wire:submit.prevent='updateSellerPersonalDetails()'>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" wire:model='name' placeholder="Enter full name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" wire:model='email' placeholder="Enter email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" wire:model='username' placeholder="Enter username">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" wire:model='address' placeholder="Enter full address">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" wire:model='phone' placeholder="Enter phone number">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select class="form-control" wire:model='seller_gender' id="seller_gender"><option value="0">Select gender</option>
                                        @foreach($genders as $id => $gender)
                                            @if($id == $seller_gender)
                                               <option value='{{ $id }}' selected>{{ $gender }}</option>
                                            @else
                                               <option value='{{ $id }}'>{{ $gender }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                    
                                    @error('seller_gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--<div>Payment_method_id: @json($payment_method_id)</div>
                                <div>Payments: {{ $payment_methods }}</div>
                                -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Payment email</label>
                                    <input type="text" class="form-control" wire:model='payment_email' placeholder="Enter payment email">
                                    @error('payment_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Payment method</label>
                                    <select class="form-control" wire:model='payment_method_id' id="payment_method_id"><option value="0">Select payment method</option>
                                        @foreach($payment_methods as $payment)
                                            @if($payment->id == $payment_method_id)
                                               <option value='{{ $payment->id }}' selected>{{ $payment->payment_name }}</option>
                                            @else
                                               <option value='{{ $payment->id }}'>{{ $payment->payment_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                    
                                    @error('payment_method_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Card number</label>
                                    <input type="text" class="form-control" wire:model='card_number' id="card_number" placeholder="Enter card number">
                                    @error('card_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Cvc</label>
                                    <input type="text" class="form-control" wire:model='cvc' id="cvc" placeholder="Enter cvc">
                                    @error('cvc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Expiration month</label>
                                    <select class="form-control" wire:model='exp_month'><option value="0">Select month</option>
                                        @foreach($months as $id => $month)
                                            @if($id == $exp_month)
                                               <option value='{{ $id }}' selected>{{ $month }}</option>
                                            @else
                                               <option value='{{ $id }}'>{{ $month }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                    
                                    @error('exp_month')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Expiration year</label>
                                    <select class="form-control" wire:model='exp_year'><option value="0">Select year</option>
                                        @foreach($years as $id => $year)
                                            @if($id == $exp_year)
                                               <option value='{{ $id }}' selected>{{ $year }}</option>
                                            @else
                                               <option value='{{ $id }}'>{{ $year }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                    
                                    @error('exp_year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                       </form> 
                    </div>
                </div>
                <!-- Timeline Tab End -->
                <!-- Update password Tab start -->
                <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="update_password" role="tabpanel">
                    <div class="pd-20 profile-task-wrap">
                        <form wire:submit.prevent='updatePassword()'>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Current password</label>
                                        <input type="password" class="form-control" wire:model.defer='current_password' placeholder="Enter current password">
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">New password</label>
                                        <input type="password" class="form-control" wire:model.defer='new_password' placeholder="Enter new password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Confirm new password</label>
                                        <input type="password" class="form-control" wire:model.defer='new_password_confirmation' placeholder="New password confirmation">
                                        @error('new_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Update password</button>
                        </form>
                    </div>
                </div>
                <!-- Update password Tab End -->
                <!-- Setting Tab start 
                <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                    <div class="profile-setting">
                        <form>
                            <ul class="profile-edit-list row">
                                <li class="weight-500 col-md-6">
                                    <h4 class="text-blue h5 mb-20">
                                        Edit Your Personal Setting
                                    </h4>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control form-control-lg" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Date of birth</label>
                                        <input class="form-control form-control-lg date-picker" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio mb-5 mr-20">
                                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-5">
                                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="dropdown bootstrap-select form-control form-control-lg"><select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" tabindex="-98"><option class="bs-title-option" value=""></option>
                                            <option>United States</option>
                                            <option>India</option>
                                            <option>United Kingdom</option>
                                        </select><button type="button" class="btn dropdown-toggle btn-outline-secondary btn-lg bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" title="Not Chosen"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Not Chosen</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                    </div>
                                    <div class="form-group">
                                        <label>State/Province/Region</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Visa Card Number</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Paypal ID</label>
                                        <input class="form-control form-control-lg" type="text">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                            <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification
                                                emails</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" class="btn btn-primary" value="Update Information">
                                    </div>
                                </li>
                                <li class="weight-500 col-md-6">
                                    <h4 class="text-blue h5 mb-20">
                                        Edit Social Media links
                                    </h4>
                                    <div class="form-group">
                                        <label>Facebook URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Dribbble URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Dropbox URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Google-plus URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Pinterest URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Skype URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group">
                                        <label>Vine URL:</label>
                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" class="btn btn-primary" value="Save &amp; Update">
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                 Setting Tab End -->
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('success-password', (event)=>{
            toastr.success('Password updated successfully!')
        })
    });
    document.addEventListener('livewire:initialized',()=>{
        @this.on('error-password', (event)=>{
            toastr.error('Something went wrong!')
        })
    });
    document.addEventListener('livewire:initialized',()=>{
        @this.on('success-seller-details', (event)=>{
            toastr.success('Seller details updated successfully!');
            $('#sellerProfileName').html(event.details.sellerName);
            $('#sellerProfileEmail').html(event.details.sellerEmail);
            $('#user-name').html(event.details.sellerName);
        })
    });

    document.addEventListener('livewire:initialized',()=>{
        @this.on('payment-methods', (event)=>{
            alert("Qui");
            //var payments = (event.details.payments);
            //alert(payments);
            //console.log(payments);
        })
    });


    function formSubmit(){
        if($('#cvc').val() == '')
        {
            $('#cvc').val('0');
        }
        if($('#card_number').val() == '')
        {
            $('#card_number').val('0');
        }
        $('#form1').submit();
    }
</script>