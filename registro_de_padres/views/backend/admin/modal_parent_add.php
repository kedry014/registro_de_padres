<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">
          <i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_parent');?>
        </div>
			</div>
			
			<div class="panel-body">

				<form action="<?php echo base_url(); ?>index.php?admin/registerParent" method="post" id="parentForm" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('enrollment');?></label>
						<div class="col-sm-5">

							<?php
								// Traer el ultimo enrollment
								$maxEnroll = $this->db->query('SELECT enrollment AS `maxEnroll` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->maxEnroll;
								// Traer el ultimo año registrado
								$getYear =  $this->db->query('SELECT substring(enrollment,1,4) AS `getYear` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->getYear;
								// Traer el ultimo número registrado
								$getlast =  $this->db->query('SELECT substring(enrollment,-5,5) AS `getlast` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->getlast;
								$currentYear = date("Y");

								if(empty($maxEnroll)){
									$enrollment1 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
									//echo "Variable sin datos";
							?>
									<input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $enrollment1; ?>" disabled>
							<?php
								} else {
									if($getYear === $currentYear){
										$enrollment2 = $currentYear."-".str_pad($getlast + 1,5,0, STR_PAD_LEFT);
										//echo "variable con fechas iguales";
							?>
										<input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $enrollment2; ?>" disabled>
							<?php
									} else {
										$enrollment3 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
										//echo "variable con fechas diferentes";
							?>
										<input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $enrollment3; ?>" disabled>
							<?php
									}
								}
							?>

						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Tipo de identificación</label>
						<div class="col-sm-5">
							<select id="identification_type" name="identification_type" class="form-control">
								<option value="cedula">Cédula</option>
								<option value="pasaporte">Pasaporte</option>
							</select>
						</div>
					</div>

					<div class="form-group" id="identification_card_div">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('identification_card');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="identification_card" name="identification_card" placeholder="Cédula">
						</div>
					</div>

					<div class="form-group hidden" id="passport_div">
						<label for="field-3" class="col-sm-3 control-label">Pasaporte</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="passport" name="passport" placeholder="Pasaporte">
						</div>
					</div>

					<div class="form-group">
						<label for="field-3" class="col-sm-3 control-label"><?php echo get_phrase('name');?>s</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="name" name="name">
						</div>
					</div>

					<div class="form-group">
						<label for="field-4" class="col-sm-3 control-label"><?php echo get_phrase('lastname');?>s</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="lastname" name="lastname">
						</div>
					</div>

					<div class="form-group">
						<label for="field-5" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" id="birthday" name="birthday" data-start-view="2">
						</div>
					</div>

					<div class="form-group">
						<label for="field-6" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
						<div class="col-sm-5">
							<select id="sex" name="sex" class="form-control">
									<option value="0"><?php echo get_phrase('select');?></option>
									<?php
										$gender = $this->db->order_by('gender_id', 'ASC')->get('gender')->result_array();
										foreach($gender as $row):																	
									?>
																			
									<option value="<?php echo $row['gender_id'];?>">
										<?php echo $row['gender'];?>
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
										$civil_status = $this->db->order_by('civil_status_id', 'ASC')->get('civil_status')->result_array();
										foreach($civil_status as $row):																	
									?>
																			
									<option value="<?php echo $row['civil_status_id'];?>">
										<?php echo $row['civil_status'];?>
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
										$nacionalidad = $this->db->order_by('nacionalidad', 'ASC')->get('paises')->result_array();
										foreach($nacionalidad as $row):																	
									?>
																			
									<option value="<?php echo $row['pais_id'];?>">
										<?php echo $row['nacionalidad'];?>
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
									$municipio = $this->db->order_by('municipio', 'ASC')->get('municipios')->result_array();
									foreach($municipio as $row):																	
								?>
																		
								<option value="<?php echo $row['municipio_id'];?>">
									<?php echo $row['municipio'];?>
								</option>
																	
								<?php endforeach;?>

							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-10" class="col-sm-3 control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sector');?></label>
						<div class="col-sm-5">
							<select class="form-control" id="sector" name="sector">
									<option value="0"><?php echo get_phrase('select_municipality_first') ?></option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-11" class="col-sm-3 control-label"><?php echo get_phrase('street');?></label>         
						<div class="col-sm-5">
							<input type="text" class="form-control" id="address" name="address">
						</div>
					</div>

					<div class="form-group">
						<label for="field-12" class="col-sm-3 control-label"><?php echo get_phrase('phone_home');?></label>              
						<div class="col-sm-5">
							<input type="text" class="form-control" id="phone_home" name="phone_home">
						</div>
					</div>

					<div class="form-group">
						<label for="field-13" class="col-sm-3 control-label"><?php echo get_phrase('phone_office');?></label>                     
						<div class="col-sm-5">
							<input type="text" class="form-control" id="phone_office" name="phone_office" data-inputmask="'alias': 'phone'">
						</div> 
						<div class="col-sm-2">
							<input type="text" class="form-control" id="phone_office_ext" name="phone_office_ext" placeholder="ext." minlength="3" maxlength="4">
						</div>
					</div>

					<div class="form-group">
						<label for="field-14" class="col-sm-3 control-label"><?php echo get_phrase('cellphone');?></label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cellphone" name="cellphone">
						</div>
					</div>

					<div class="form-group">
						<label for="field-15" class="col-sm-3 control-label"><?php echo get_phrase('cellphone');?> 2</label>        
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cellphone2" name="cellphone2" data-inputmask="'alias': 'phone'">
						</div>
					</div>

					<div class="form-group">
						<label for="field-16" class="col-sm-3 control-label"><?php echo get_phrase('academic_level');?></label>      
						<div class="col-sm-5">
							<select id="academic_level" name="academic_level" class="form-control">
								<option value="0"><?php echo get_phrase('select');?></option>
								<?php
										$academic_level = $this->db->order_by('academic_level_parent_id', 'ASC')->get('academic_level_parent')->result_array();
										foreach($academic_level as $row):																	
									?>
																			
									<option value="<?php echo $row['academic_level_parent_id'];?>">
										<?php echo $row['academic_level'];?>
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
										$profesion = $this->db->order_by('profesion', 'ASC')->get('profesiones')->result_array();
										foreach($profesion as $row):																	
									?>
																			
									<option value="<?php echo $row['profesion_id'];?>">
										<?php echo $row['profesion'];?>
									</option>
																		
									<?php endforeach;?>

							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-18" class="col-sm-3 control-label"><?php echo get_phrase('occupation');?></label>      
						<div class="col-sm-5">
							<select class="form-control select2" id="occupation" name="occupation">
								<option value="0"><?php echo get_phrase('select');?></option>
									<?php
										$ocupacion = $this->db->order_by('ocupacion', 'ASC')->get('ocupaciones')->result_array();
										foreach($ocupacion as $row):																	
									?>
																			
									<option value="<?php echo $row['ocupacion_id'];?>">
										<?php echo $row['ocupacion'];?>
									</option>
																		
									<?php endforeach;?>

								</select>
						</div>
					</div>

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

					<div class="form-group">
						<label for="field-20" class="col-sm-3 control-label">Tipo de comprobante fiscal</label>
						<div class="col-sm-5">
							<select id="comprobante_fiscal" name="comprobante_fiscal" class="form-control">
								<option value="0"><?php echo get_phrase('select');?></option>
									<?php
										$tcf = $this->db->order_by('tcf_id', 'ASC')->get('tcf')->result_array();
										foreach($tcf as $row):																	
									?>
																			
									<option value="<?php echo $row['tcf_id'];?>">
										<?php echo $row['tipo_tcf'];?>
									</option>
																		
									<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-21" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com">
						</div>
					</div>
					
					<div class="form-group">
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
					</div>
					        
          <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" id="submit" class="btn btn-success"><?php echo get_phrase('add_parent');?></button>
						</div>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>

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