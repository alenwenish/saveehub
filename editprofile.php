<style>
  
</style>

<form action="" method="POST" class="m-2">
     <div class=" mb-3 ">
        <label for="Profile" class="form-label "> Profile Pic: </label> <br>
        <input type="file" name="uploadfile" id="uploadfile" class="form-control border border-dark border-2"  aria-describedby="inputGroupFileAddon04" >
        
      </div>

                <div class="mb-3 ">
                    <label for="username" class="form-label "> Username: </label>
                    <input type="text" class="form-control shadow" id="username" name="username" value="<?php echo $username ?>"  required >
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label"> Name: </label>
                    <input type="text" class="form-control shadow" id="name" name="name"  required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label"> Bio: </label>
                    <textarea class="form-control shadow" id="bio" name="bio" required> </textarea>
                </div>

                <div class="mb-3 ">
                    <label for="link" class="form-label"> Add Link:</label>
                    <input type="text" class="form-control shadow" id="link" name="link"  required>
                </div>

    

                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Update" id="update" name="update" class="btn btn-light btn-outline-primary shadow-sm">
                </div>

               
</form>