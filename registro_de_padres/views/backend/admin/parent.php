
            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_parent_add/');"
                class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('add_new_parent');?>
                </a>
                <br><br>
               <table id="table_export" class="table table-bordered datatable dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div><?php echo get_phrase('enrollment');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('cellphone');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $parents   =   $this->db->get('parent' )->result_array();
                            foreach($parents as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['enrollment'];?></td>
                            <td><?php echo $row['name'].' '.$row['lastname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['cellphone'];?></td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <?php echo get_phrase('options');?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                        <!-- PADRES EDITAR -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_parent_edit/<?php echo $row['parent_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                                        </li>
                                        <li class="divider"></li>

                                        <!-- PADRES ELIMINAR -->
                                        <li>
                                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/parent/delete/<?php echo $row['parent_id'];?>');">
                                                <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
                                                </a>
                                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!---  DATA TABLE EXPORTACION  -->
<script type="text/javascript">

    jQuery(document).ready(function($)
    {

        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-12 col-md-4 col-left'l><'col-xs-12 col-md-4'<'export-data'T>><'col-xs-12 col-md-4 col-right'f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {
                "aButtons": [

                    {
                        "sExtends": "xls",
                        "mColumns": [1,2,3,4],
                        "sButtonText": "<i class='fa fa-file-excel-o'></i>",
                        "sButtonClass": "btn btn-success"
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1,2,3,4],
                        "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
                        "sButtonClass": "btn btn-danger"
                    },
                    {
                        "sExtends": "print",
                        "sButtonClass": "btn btn-primary",
                        "sButtonText": "<i class='fa fa-print'></i>",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(4, false);

                            this.fnPrint( true, oConfig );

                            window.print();

                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(4, true);
                                  }
                            });
                        },

                    },
                ]
            },
            "oLanguage": {
                "sUrl": "http://localhost/registro_de_padres/assets/js/datatables/Spanish.json"
            },
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>
