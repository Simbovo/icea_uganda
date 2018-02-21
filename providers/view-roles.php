<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 17/05/16
 * Time: 10:25
 */

session_start();

require_once('../app/Loader.php');

use application\controller\settingsController;

$impl = new settingsController();

$controls = $impl->roles();
?>

    

<form name="add-role" id="add-role" method="post" action=""
                                                  data-toggle="validator">

                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="acct_no" class="control-label">Role
                                                            Name </label>
                                                        <input type="text" class="form-control" name="role_name"
                                                               id="role_name"
                                                               data-min-length="5"
                                                               data-error="The account is invalid"
                                                               required/>

                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" id="submit" class="btn btn-success"><i
                                                                class="fa fa-save"></i>&nbsp; Save Role
                                                        </button>
                                                        <button type="reset" id="reset" class="btn btn-warning">
                                                            Clear
                                                        </button>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4"></div>

                                            </form>

<div id="smallModal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Small Modal</h4>

            </div>

            <div class="modal-body">

                <p>Add the <code>.modal-sm</code> class on <code>.modal-dialog</code> to create this small modal.</p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-primary">OK</button>

            </div>

        </div>

    </div>

</div>