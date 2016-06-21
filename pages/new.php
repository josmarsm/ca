<form action="" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input id="username" class="form-control" type="text" name="user" placeholder="Username" value="<?php echo $user; ?>" />
  </div>
  <div class="form-group">
    <label for="rank">Rank</label>
     <select class="form-control" name="rank">
 <option value="recruit">recruit</option>
 <option value="officer">officer</option>
 <option value="leader">leader</option>

</select>
  </div>
  <div class="form-group">
    <label for="position">Position</label>
    <input id="position" class="form-control" type="text" name="position" placeholder="Leader" value="<?php echo $position; ?>" />
  </div>
    <div class="form-group">
    <label for="Date">Date</label>
    <input id="Date" class="form-control" type="text" name="date" placeholder="<?php echo date('d M y'); ?>" value="<?php echo $date; ?>" />
  </div>
    <div class="form-group">
    <label for="Tag">Tag</label>
    <input id="Tag" class="form-control" type="text" name="tag" value="<?php echo $tag; ?>" />
  </div>
    <div class="form-group">
    <label for="AiT">AiT</label>
    <input id="AiT" class="form-control" type="text" name="ait" value="<?php echo $ait; ?>" />
  </div>
    <div class="form-group">
    <label for="ServiceStripes">Service Stripes</label>
    <input id="ServiceStripes" class="form-control" type="text" name="ss" value="<?php echo $ss; ?>" />
  </div>
    <div class="form-group">
    <label for="Notes">Notes</label>
    <input id="Notes" class="form-control" type="text" name="notes" placeholder="Notes" value="<?php echo $notes; ?>" />
  </div>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary" value="Submit">Save changes</button>
</form>