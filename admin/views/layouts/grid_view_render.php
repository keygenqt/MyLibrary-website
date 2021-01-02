<?php

/* @var $this yii\web\View */

/* @var $button String */
/* @var $modelName String */

?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?= $button ?>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-default block-summary">{summary}</h6>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-sm-12'>
                    {items}
                </div>
            </div>
            <div class='row pager'>
                <div class='col-sm-12 text-align: right;'>
                    {pager}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let block = $('.block-summary');
            if (block.find('.summary').length === 0) {
                block.append('<div class="summary">Showing <b>0</b> items.</div>')
            }
        });
    </script>

</div>

<!-- Logout Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" if you are ready to remove model from system.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="delete-link" class="btn btn-danger" href="#">Delete</a>
            </div>
        </div>
    </div>
</div>










