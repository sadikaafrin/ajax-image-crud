<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="post" id="updateProductForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errMsgContainer" class="mb-3"></div>


                    <div class="form-floating">
                        <lable for="name">Product Name</lable>
                        <input type="text" class="form-control" name="up_name" id="up_name" placeholder="Product Name">
                    </div>
                    <div class="form-floating my-3">
                        <lable for="name">Product Price</lable>
                        <input type="text" class="form-control" name="up_price" id="up_price" placeholder="Product Price">
                    </div>
                    <div class="form-floating my-3">
                        <lable for="name">Product Image</lable>
                        <input type="file" class="form-control" name="up_image" id="up_image" placeholder="Product Price">
                    </div>
                    <div class="form-floating my-3">
                        <div class="img" style="margin: auto; text-align: center; vertical-align: middle; border: 1px solid #ddd; border-radius: 4px; padding: 4px; height: 250px; overflow: hidden;">
                            <img id="current_image" class="img-fluid" style="height: 240px; width: auto;" src="" alt="Product Image">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_product">Update changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
