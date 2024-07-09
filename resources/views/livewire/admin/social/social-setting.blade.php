 <form wire:submit='updateSocialNetworks()'>
     <div class="row">
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>Facebook URL</b></label>
                 <input type="text" class="form-control" wire:model='facebook_url' placeholder="Enter facebook URL">
                 @error('facebook_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>Twitter URL</b></label>
                 <input type="text" class="form-control" wire:model='twitter_url' placeholder="Enter twitter URL">
                 @error('twitter_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>Instagram URL</b></label>
                 <input type="text" class="form-control" wire:model='instagram_url'
                     placeholder="Enter instagram URL">
                 @error('instagram_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>YouTube URL</b></label>
                 <input type="text" class="form-control" wire:model='youtube_url' placeholder="Enter YouTube URL">
                 @error('youtube_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>GitHub URL</b></label>
                 <input type="text" class="form-control" wire:model='github_url' placeholder="Enter GitHub URL">
                 @error('github_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for=""><b>Linkedin URL</b></label>
                 <input type="text" class="form-control" wire:model='linkedin_url' placeholder="Enter Linkedin URL">
                 @error('linkedin_url')
                     {{ $message }}
                 @enderror
             </div>
         </div>
     </div>
     <div class="form-group">
         <button type="submit" class="btn btn-primary">Save changes</button>
     </div>
 </form>
