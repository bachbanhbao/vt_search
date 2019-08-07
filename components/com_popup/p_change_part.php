<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_change_part" class="modal fade" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-gears"></i><span>
                	Danh sách parts
                </span>
            	</h4>
            </div>
            <div class="modal-body" style="padding-top:5px;" id="content_quick_view" style="width: 850px;">
                <!-- widget div-->
                    <div role="content">
                        <!-- widget content -->
                        <div class="widget-body">
                            <table id="table_list_parts" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>                         
                                    <tr>
                                        <th width="5%">
                                            <i class="fa fa-caret-down"></i>
                                        </th>
                                        <th width="3%">
                                            Chọn
                                        </th>
                                        <th width="15%">
                                            Mã part
                                        </th>
                                        <th width="15%">
                                            Tên part
                                        </th>
                                        <th width="10%">
                                            Type
                                        </th>
                                        <th width="12%">
                                            Part type
                                        </th>
                                        <th width="10%">
                                            Reversion
                                        </th>
                                        <th width="10%">
                                            Trạng thái
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    for ($i=0; $i < 11; $i++) { ?>
                                        <tr>
                                            <td align="center">
                                                <i class="fa fa-lg fa-lock txt-color-blue"></i>
                                            </td>
                                            <td align="center">
                                                <label class="radio">
                                                    <input type="radio" name="radio">
                                                    <i></i>
                                                </label>
                                            </td>
                                            <td align="center">
                                                PART-<?php echo $stt;?>
                                            </td>
                                            <td align="center">
                                                Part name
                                            </td>
                                            <td align="center">
                                                Assembly
                                            </td>
                                            <td align="center">
                                                Origin
                                            </td>
                                            <td align="center">
                                                <?php echo $stt;?>
                                            </td>
                                            <td align="center">
                                                Release
                                            </td>
                                        </tr>
                                    <?php $stt++; }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end widget content -->
                        
                    </div>
                    <!-- end widget div --> 
            </div>
            <form class="smart-form">
                <footer>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Đóng</a>
                    <a href="#" class="btn btn-success">
                        <i class="fa fa-save"></i> Save</a>
                </footer>    
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    #dialog_change_part .modal-dialog {
        width: 860px;
    }
</style>