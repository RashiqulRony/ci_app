<tr id="registry_no_<?php echo $sub_registry_form_inc; ?>"s>
  <td>
     <div class="item form-group">
        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
        </label> -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
        </div>
      </div>
  </td>
  <td>
    <div class="item form-group">
        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
        </label> -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
  </td>
  <td><div class="item form-group">
        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span class="required">*</span>
        </label> -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
    </td>
  <td>
    <div class="item form-group">
       <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
        </label> -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
  </td>
  <td>
    <div class="item form-group">
      <button id="send" onclick="rm_registry_form(<?= $sub_registry_form_inc; ?>)" type="button" class="btn btn-danger">-</button>
    </div>
    
  </td>
</tr>