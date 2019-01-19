<div class="modal fade" id="profile-<?php echo $list->id; ?>-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $list->first_name."'s Profile";  ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6 text-right">
            First Name:<br>
            Middle Name:<br>
            Last Name: <br>
            Block: <br>
            Grade:<br>
          </div>
          <div class="col-6">
            <strong><?php echo $list->first_name; ?><br></strong>
            <strong><?php echo $list->middle_name; ?><br></strong>
            <strong><?php echo $list->last_name; ?><br></strong>
            <strong><?php echo $student_list->getBlock($list->block_id)->block_name; ?><br></strong>
            <strong><?php echo $list->grade; ?></strong><br>
          </div>
        </div> 
        <hr>
        <div class="row">
          <div class="col-6">
            Recent Reasons for Absences:
          </div>
          <div class="col-6">
            Total Absences: <?php echo $absent_details->countAbsentsOfOne($list->id); ?>
          </div>
        </div>
        
        <hr>
        <?php 
          foreach($student_list->getReasons($list->id) as $reason) {
            echo $reason->time_out.' :'.$reason->remark.'<br>';
          }
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>