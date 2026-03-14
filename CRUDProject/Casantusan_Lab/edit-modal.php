
<!-- Modal -->



<div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Information</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>



            <div class="modal-body">

                <form id="edit_data">

                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Name: </label>

                        <input type="text" name="fullname" class="form-control" id="fullname" aria-describedby="emailHelp">

                    </div>



                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Email address:</label>

                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">

                    </div>



                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Phone: </label>

                        <input type="text" name="phone" class="form-control" id="phone" aria-describedby="emailHelp">

                    </div>



                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Address: </label>

                        <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp">

                    </div>

                    <div class="mb-3">
                    <br>
                        <input type="file" name="image" id="fileToUpload">
                        
                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Update changes</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>