<?php 
	$edit_data = $this->db->get_where('parent' , array('parent_id' => $param2))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_parent');?>
				</div>
			</div>
			<div class="panel-body">
				
				
				<form action="<?php echo base_url(); ?>index.php?admin/editParent" method="post" id="parentFormEdit" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

				<input type="hidden" id="id" name="id" value="<?php echo $row['parent_id']; ?>">

				<!-- <form action="<?php echo base_url(); ?>index.php?admin/editParent/" method="post" id="parentFormEdit" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"> -->

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('enrollment');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $row['enrollment']; ?>" disabled>
						</div>
					</div>

					<?php

						if(!empty($row['identification_card'])){
					?>

							<div class="form-group" id="identification_card_div">
								<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('identification_card');?></label>        
								<div class="col-sm-5">
									<input type="text" class="form-control" id="identification_card" name="identification_card" value="<?php echo $row['identification_card']; ?>" placeholder="Cédula">
								</div>
							</div>

					<?php
						} else {
					?>

							<div class="form-group" id="passport_div">
								<label for="field-3" class="col-sm-3 control-label">Pasaporte</label>        
								<div class="col-sm-5">
									<input type="text" class="form-control" id="passport" name="passport" value="<?php echo $row['passport']; ?>" placeholder="Pasaporte">
								</div>
							</div>

					<?php
						}
					?>

					<div class="form-group">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('name');?>s</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-4" class="col-sm-3 control-label"><?php echo get_phrase('lastname');?>s</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">
						</div>
					</div>

					<!-- <div class="form-group">
						<label for="field-5" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" id="birthday" name="birthday" data-start-view="2" value="<?php echo date('d/m/Y', $row['birthday']); ?>">
						</div>
					</div> -->

					<div class="form-group">
						<label for="field-6" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
						<div class="col-sm-5">
							<select id="sex" name="sex" class="form-control">
									<option value="0"><?php echo get_phrase('select');?></option>
									
									<?php
										$gender = $this->db->get('gender')->result_array();
										$gender_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->sex;
										foreach($gender as $row2):																
									?>

									<option value="<?php echo $row2['gender_id'];?>"
										<?php if($row2['gender_id'] == $gender_id)echo 'selected';?>>
										<?php echo $row2['gender'];?>
									</option>
																		
									<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-7" class="col-sm-3 control-label"><?php echo get_phrase('civil_status');?></label>
						<div class="col-sm-5">
							<select id="civil_status" name="civil_status" class="form-control">
									<option value="0"><?php echo get_phrase('select');?></option>

									<?php
										$civil_status = $this->db->get('civil_status')->result_array();
										$civil_status_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->civil_status;
										foreach($civil_status as $row3):																
									?>

									<option value="<?php echo $row3['civil_status_id'];?>"
										<?php if($row3['civil_status_id'] == $civil_status_id)echo 'selected';?>>
										<?php echo $row3['civil_status'];?>
									</option>
																		
									<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-8" class="col-sm-3 control-label"><?php echo get_phrase('nationality');?></label>
						<div class="col-sm-5">
							<select class="form-control select2" id="nationality" name="nationality">
								<option value="0"><?php echo get_phrase('select');?></option>

									<?php
										$nacionalidad = $this->db->get('paises')->result_array();
										$nacionalidad_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->nationality;
										foreach($nacionalidad as $row4):																
									?>

									<option value="<?php echo $row4['pais_id'];?>"
										<?php if($row4['pais_id'] == $nacionalidad_id)echo 'selected';?>>
										<?php echo $row4['nacionalidad'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-9" class="col-sm-3 control-label"><?php echo get_phrase('municipality');?></label>
						<div class="col-sm-5">
							<select class="form-control" id="municipality" name="municipality" onchange="select_sectores(this.value)">
								<option value="0"><?php echo get_phrase('select_municipality');?></option>

									<?php
										$municipio = $this->db->get('municipios')->result_array();
										$municipio_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->municipality;
										foreach($municipio as $row5):													
									?>

									<option value="<?php echo $row5['municipio_id'];?>"
										<?php if($row5['municipio_id'] == $municipio_id)echo 'selected';?>>
										<?php echo $row5['municipio'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-10" class="col-sm-3 control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sector');?></label>
						<div class="col-sm-5">
							<select class="form-control" name="sector" id="sector">
									<option value="0"><?php echo get_phrase('select_municipality_first') ?></option>

									<?php
										$sector = $this->db->get('sectores')->result_array();
										$sector_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->sector;
										foreach($sector as $row6):													
									?>

									<option value="<?php echo $row6['sector_id'];?>"
										<?php if($row6['sector_id'] == $sector_id)echo 'selected';?>>
										<?php echo $row6['sector'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-11" class="col-sm-3 control-label"><?php echo get_phrase('street');?></label>         
						<div class="col-sm-5">
							<input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-12" class="col-sm-3 control-label"><?php echo get_phrase('phone_home');?></label>              
						<div class="col-sm-5">
							<input type="text" class="form-control" id="phone_home" name="phone_home" value="<?php echo $row['phone_home']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-13" class="col-sm-3 control-label"><?php echo get_phrase('phone_office');?></label>                     
						<div class="col-sm-5">
							<input type="text" class="form-control" id="phone_office" name="phone_office" value="<?php echo $row['phone_office']; ?>">
						</div> 
						<div class="col-sm-2">
							<input type="text" class="form-control" id="phone_office_ext" name="phone_office_ext" placeholder="ext." minlength="3" maxlength="4" value="<?php echo $row['phone_office_ext']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-14" class="col-sm-3 control-label"><?php echo get_phrase('cellphone');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cellphone" name="cellphone" value="<?php echo $row['cellphone']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-15" class="col-sm-3 control-label"><?php echo get_phrase('cellphone');?> 2</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cellphone2" name="cellphone2" value="<?php echo $row['cellphone2']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-16" class="col-sm-3 control-label"><?php echo get_phrase('academic_level');?></label>      
						<div class="col-sm-5">
							<select id="academic_level" name="academic_level" class="form-control">
								<option value="0"><?php echo get_phrase('select');?></option>

									<?php
										$academic_level_parent_id = $this->db->get('academic_level_parent')->result_array();
										$academic_level_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->academic_level;
										foreach($academic_level_parent_id as $row7):																
									?>

									<option value="<?php echo $row7['academic_level_parent_id'];?>"
										<?php if($row7['academic_level_parent_id'] == $academic_level_id)echo 'selected';?>>
										<?php echo $row7['academic_level'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-17" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>      
						<div class="col-sm-5">
							<select class="form-control select2" id="profession" name="profession">
								<option value="0"><?php echo get_phrase('select');?></option>

									<?php
										$profesion = $this->db->get('profesiones')->result_array();
										$profesion_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->profession;
										foreach($profesion as $row7):																
									?>

									<option value="<?php echo $row7['profesion_id'];?>"
										<?php if($row7['profesion_id'] == $profesion_id)echo 'selected';?>>
										<?php echo $row7['profesion'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-18" class="col-sm-3 control-label"><?php echo get_phrase('occupation');?></label>      
						<div class="col-sm-5">
							<select class="form-control select2" id="occupation" name="occupation">

									<?php
										$ocupacion = $this->db->get('ocupaciones')->result_array();
										$ocupacion_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->occupation;
										foreach($ocupacion as $row8):																
									?>

									<option value="<?php echo $row8['ocupacion_id'];?>"
										<?php if($row8['ocupacion_id'] == $ocupacion_id)echo 'selected';?>>
										<?php echo $row8['ocupacion'];?>
									</option>
																		
									<?php endforeach;?>

								</select>
						</div>
					</div>

					<?php

					if($row['company_invoice'] === "rnc"){ ?>

					<div class="form-group">
						<label for="field-19" class="col-sm-3 control-label">Factura a nombre de</label>
						<div class="col-sm-5">
							<select id="company_invoice" name="company_invoice" class="form-control">
								<option value="Ninguno">Ninguno</option>
								<option value="rnc" selected>RNC</option>
								<option value="cedula">Cédula</option>
							</select>
						</div>
					</div>

					<div class="form-group" id="company_invoice_rnc_div">
						<label for="field-3" class="col-sm-3 control-label">RNC</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="rnc" name="rnc" value="<?php echo $row['rnc']; ?>" placeholder="RNC">
						</div>
					</div>

					<div class="form-group hidden" id="company_invoice_identification_card_div">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('identification_card');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="identification_card_invoice" name="identification_card_invoice"  value="<?php echo $row['identification_card_invoice']; ?>" placeholder="Cédula" disabled>
						</div>
					</div>

					<?php } else if($row['company_invoice'] === "cedula"){ ?>

					<div class="form-group">
						<label for="field-19" class="col-sm-3 control-label">Factura a nombre de</label>
						<div class="col-sm-5">
							<select id="company_invoice" name="company_invoice" class="form-control">
								<option value="Ninguno">Ninguno</option>
								<option value="rnc">RNC</option>
								<option value="cedula" selected>Cédula</option>
							</select>
						</div>
					</div>

					<div class="form-group hidden" id="company_invoice_rnc_div">
						<label for="field-3" class="col-sm-3 control-label">RNC</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="rnc" name="rnc" value="<?php echo $row['rnc']; ?>" placeholder="RNC" disabled>
						</div>
					</div>

					<div class="form-group" id="company_invoice_identification_card_div">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('identification_card');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="identification_card_invoice" name="identification_card_invoice" value="<?php echo $row['identification_card_invoice']; ?>" placeholder="Cédula">
						</div>
					</div>

					<?php } else { ?>

					<div class="form-group">
						<label for="field-19" class="col-sm-3 control-label">Factura a nombre de</label>
						<div class="col-sm-5">
							<select id="company_invoice" name="company_invoice" class="form-control">
								<option value="Ninguno">Ninguno</option>
								<option value="rnc">RNC</option>
								<option value="cedula">Cédula</option>
							</select>
						</div>
					</div>

					<div class="form-group" id="company_invoice_rnc_div">
						<label for="field-3" class="col-sm-3 control-label">RNC</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="rnc" name="rnc" placeholder="RNC" disabled>
						</div>
					</div>

					<div class="form-group hidden" id="company_invoice_identification_card_div">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('identification_card');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="identification_card_invoice" name="identification_card_invoice" placeholder="Cédula">
						</div>
					</div>

					<?php } ?>

					<div class="form-group">
						<label for="field-20" class="col-sm-3 control-label">Tipo de comprobante fiscal</label>
						<div class="col-sm-5">
							<select id="comprobante_fiscal" name="comprobante_fiscal" class="form-control select2">
								<option value="0"><?php echo get_phrase('select');?></option>

									<?php
										$comprobante = $this->db->get('tcf')->result_array();
										$comprobante_id = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->comprobante_fiscal;
										foreach($comprobante as $row8):																
									?>

									<option value="<?php echo $row8['tcf_id'];?>"
										<?php if($row8['tcf_id'] == $comprobante_id)echo 'selected';?>>
										<?php echo $row8['tipo_tcf'];?>
									</option>
																		
									<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-21" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" placeholder="ejemplo@correo.com">
						</div>
					</div>
					
					<!-- <div class="form-group">
						<label for="field-22" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>          
						<div class="col-sm-5">
							<input type="password" class="form-control" id="password" name="password" placeholder="*****">
						</div>
					</div>

					<div class="form-group">
						<label for="field-23" class="col-sm-3 control-label"><?php echo get_phrase('confirm_password');?></label>          
						<div class="col-sm-5">
							<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="*****">
						</div>
					</div> -->
					        
          <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" id="submit" class="btn btn-success"><?php echo get_phrase('edit_parent');?></button>
						</div>
					</div>
				</form>
                    
					
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>

<script src="assets/js/custom/admin/parent/modal_parent.js"></script>
<script type="text/javascript">

function select_sectores(municipio_id) {
	if(municipio_id !== ''){
		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_sectores/' + municipio_id,
			success:function (response)
			{

			jQuery('#sector').html(response);
			}
		});
	}
}

</script>