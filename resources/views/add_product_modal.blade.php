<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="addProductForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errMsgContainer" class="mb-3"></div>


                    <div class="form-floating">
                        <lable for="name">Product Name</lable>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Product Name">
                    </div>
                    <div class="form-floating my-3">
                        <lable for="name">Product Price</lable>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Product Price">
                    </div>
                    <div class="form-floating my-3">
                        <lable for="name">Product Price</lable>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Product Price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_product">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
