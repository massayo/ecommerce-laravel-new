<div>
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click.prevent='selectTab("general_settings")' 
                class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab" href="#general_settings" role="tab" aria-selected="true">General settings</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("logo_favicon")' 
                class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}" data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("social_networks")' 
                class="nav-link {{ $tab == 'social_networks' ? 'active' : '' }}" data-toggle="tab" href="#social_networks" role="tab" aria-selected="false">Social networks</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("payment_methods")' 
                class="nav-link {{ $tab == 'payment_methods' ? 'active' : '' }}" data-toggle="tab" href="#payment_methods" role="tab" aria-selected="false">Payment methods</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'general_settings' ? 'show active' : '' }}" id="general_settings" role="tabpanel">
                <div class="pd-20">
                    <form wire:submit.prevent='updateGeneralSettings()'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter site name" 
                                    wire:model.defer='site_name'>
                                    @error('site_name')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site email</b></label>
                                    <input type="text" class="form-control" placeholder="Enter site email" 
                                    wire:model.defer='site_email'>
                                    @error('site_email')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site phone</b></label>
                                    <input type="text" class="form-control" placeholder="Enter site phone" 
                                    wire:model.defer='site_phone'>
                                    @error('site_phone')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site meta keywords</b><small> Separated by comma (a,b,c)</small></label>
                                    <input type="text" class="form-control" placeholder="Enter site meta keywords" 
                                    wire:model.defer='site_meta_keywords'>
                                    @error('site_meta_keywords')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Site meta description</b></label>
                            <textarea cols="4" rows="4" placeholder="Site meta description ..." class="form-control"
                            wire:model.defer='site_meta_description'></textarea>
                            @error('site_meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'show active' : '' }}" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Site logo</h5>
                            <div class="mb-2 mt-1" style="max-width: 200px;">
                                <img wire:ignore src="" class="img-thumbnail" data-ijabo-default-img="/images/site/{{ $site_logo }}" id="site_logo_image_preview">  
                            </div>
                            <form action="{{ route('admin.change-logo') }}" method="POST" enctype="multipart/form-data" 
                            id="change_site_logo_form">
                            @csrf
                                <div class="mb-2">
                                    <input type="file" name="site_logo" id="site_logo" class="form-control">
                                    <span class="text-danger error-text site_logo_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change logo</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Site favicon</h5>
                            <div class="mb-2 mt-1" style="max-width: 100px;">
                                <img wire:ignore src="" class="img-thumbnail" data-ijabo-default-img="/images/site/{{ $site_favicon }}" id="site_favicon_image_preview">  
                            </div>
                            <form action="{{ route('admin.change-favicon') }}" method="POST" enctype="multipart/form-data" 
                            id="change_site_favicon_form">
                            @csrf
                                <div class="mb-2">
                                    <input type="file" name="site_favicon" id="site_favicon" class="form-control">
                                    <span class="text-danger error-text site_favicon_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change favicon</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'social_networks' ? 'show active' : '' }}" id="social_networks" role="tabpanel">
                <div class="pd-20">
                    <form wire:submit.prevent='updateSocialNetworks()'>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Facebook URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='facebook_url'
                                    placeholder="Enter facebook URL">
                                    @error('facebook_url'){{ $message }}@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Twitter URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='twitter_url'
                                    placeholder="Enter twitter URL">
                                    @error('twitter_url'){{ $message }}@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Instagram URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='instagram_url'
                                    placeholder="Enter instagram URL">
                                    @error('instagram_url'){{ $message }}@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Youtube URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='youtube_url'
                                    placeholder="Enter youtube URL">
                                    @error('youtube_url'){{ $message }}@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Github URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='github_url'
                                    placeholder="Enter github URL">
                                    @error('github_url'){{ $message }}@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><b>Linkedin URL</b></label>
                                    <input type="text" class="form-control" wire:model.defer='linkedin_url'
                                    placeholder="Enter linkedin URL">
                                    @error('linkedin_url'){{ $message }}@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'payment_methods' ? 'show active' : '' }}" id="payment_methods" role="tabpanel">
                <div class="pd-20">
                    ---payment_methods---
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('success-general-settings', (event)=>{
           toastr.success('General settings updated successfully!')
        })
    });
    document.addEventListener('livewire:initialized',()=>{
        @this.on('success-social-networks', (event)=>{
           toastr.success('Social networks updated successfully!')
        })
    });
</script>