<div class="modal fade" id="alertModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:0">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
  </div>

  <?php
  if(session()->has('flash_msg')){
    $flash_msg = session()->get('flash_msg');
    session()->forget('flash_msg');

    if(!empty($flash_msg)){
      ?>
      <script type="text/javascript">
        $("#alertModal").find(".modal-body").html('<?php echo $flash_msg; ?>');
        $("#alertModal").modal("show");
      </script>
      <?php
    }
  }
  ?>

  