<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*  
 *  @author     : Creativeitem
 *  date        : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */
class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('admin_model');

       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }


     /**** PAPDRES *****/

     function registerParent()
     {
         $validator = array('success' => false, 'messages' => array());

         // Condicion tipo de identificacion
         if($this->input->post('identification_type') === "cedula"){
            $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|is_unique[parent.identification_card]|xss_clean');
         } else if($this->input->post('identification_type') === "pasaporte") {
            $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|is_unique[parent.passport]|xss_clean');
         } else {
            $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|is_unique[parent.identification_card]|xss_clean');
            $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|is_unique[parent.passport]|xss_clean');
         }

        // validacion RNC/Cedula empresa
        if($this->input->post('company_invoice') === "rnc"){
            $this->form_validation->set_rules('rnc', 'RNC', 'trim|required|xss_clean');
            $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|xss_clean');
        } else if($this->input->post('company_invoice') === "cedula") {
            $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|required|xss_clean');
            $this->form_validation->set_rules('rnc', 'RNC', 'trim|xss_clean');
        } else {
            $this->form_validation->set_rules('rnc', 'RNC', 'trim|xss_clean');
            $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|xss_clean');
        }
         
         $validate_data = array(
            array(
                'field' => 'identification_type',
                'label' => 'tipo de identificación',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'name',
                'label' => 'nombre',
                'rules' => 'trim|required|min_length[4]|xss_clean'
            ),
            array(
               'field' => 'lastname',
               'label' => 'apellido',
               'rules' => 'trim|required|min_length[4]|xss_clean'
            ),
            array(
                'field' => 'birthday',
                'label' => 'cumpleaños',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'sex',
                'label' => 'género',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'civil_status',
                'label' => 'estado civil',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'nationality',
                'label' => 'nacionalidad',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'municipality',
                'label' => 'municipio',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'sector',
                'label' => 'sector',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'address',
                'label' => 'calle',
                'rules' => 'trim|required|min_length[5]|xss_clean'
            ),
            array(
                'field' => 'phone_home',
                'label' => 'teléfono casa',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'phone_office',
                'label' => 'teléfono oficina',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'phone_office_ext',
                'label' => 'ext.',
                'rules' => 'trim|integer|xss_clean'
            ),
            array(
                'field' => 'cellphone',
                'label' => 'celular',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'cellphone2',
                'label' => 'celular',
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'academic_level',
                'label' => 'nivel académico',
                'rules' => 'trim|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'profession',
                'label' => 'profesión',
                'rules' => 'trim|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'occupation',
                'label' => 'ocupación',
                'rules' => 'trim|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'company_invoice',
                'label' => 'factura a nombre de la empresa',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'comprobante_fiscal',
                'label' => 'tipo de comprobante fiscal',
                'rules' => 'trim|required|callback_check_default|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email|is_unique[parent.email]|xss_clean'
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required|matches[confirm_password]|min_length[5]|xss_clean'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'confirmar contraseña',
                'rules' => 'required|matches[password]|min_length[5]|xss_clean'
            )
         );
         
         $this->form_validation->set_rules($validate_data);
         $this->form_validation->set_message('is_unique', 'Ya existe.');
         $this->form_validation->set_message('check_default', 'Debe seleccionar algo distinto al predeterminado.');
         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
 
         if ($this->form_validation->run() === true) {

             // Traemos la ultima matricula
            $maxEnroll = $this->admin_model->maxEnroll();
            // Tramenos el ultmo año registrado
            $getYear =  $this->admin_model->getYear();
            // Traemos la ultmia secuencia númerica
            $getlast =  $this->admin_model->getlast();
            $currentYear = date("Y");

            // Verificamos si no hay matriculas en el sistema
            if (empty($maxEnroll)) {
                $enrollment1 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
                $data['enrollment'] = $enrollment1;

            } else {
                // Verfificamos si el ultimo año traido es igual a el año actual
                if ($getYear === $currentYear) {
                    $enrollment2 = $currentYear."-".str_pad($getlast + 1,5,0, STR_PAD_LEFT);
                    $data['enrollment'] = $enrollment2;
                } else {
                    // reseteamos con el nuevo año y la secuencia númerica desde 1 
                    $enrollment3 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
                    $data['enrollment'] = $enrollment3;
                }
            }

            if ($this->input->post('identification_card') != null) {
                $data['identification_card'] = $this->input->post('identification_card');
            }
            if ($this->input->post('passport') != null) {
                $data['passport'] = $this->input->post('passport');
            }
            if ($this->input->post('name') != null) {
                $data['name'] = $this->input->post('name');
            }
            if ($this->input->post('lastname') != null) {
                $data['lastname'] = $this->input->post('lastname');
            }
            if ($this->input->post('birthday') != null) {
                $data['birthday'] = $this->input->post('birthday');
            }
            if ($this->input->post('sex') != null) {
                $data['sex'] = $this->input->post('sex');
            }
            if ($this->input->post('civil_status') != null) {
                $data['civil_status'] = $this->input->post('civil_status');
            }
            if ($this->input->post('nationality') != null) {
                $data['nationality'] = $this->input->post('nationality');
            }
            if ($this->input->post('municipality') != null) {
                $data['municipality'] = $this->input->post('municipality');
            }
            if ($this->input->post('sector') != null) {
                $data['sector'] = $this->input->post('sector');
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('phone_home') != null) {
                $data['phone_home'] = $this->input->post('phone_home');
            }
            if ($this->input->post('phone_office') != null) {
                $data['phone_office'] = $this->input->post('phone_office');
            }
            if ($this->input->post('phone_office_ext') != null) {
                $data['phone_office_ext'] = $this->input->post('phone_office_ext');
            }
            if ($this->input->post('cellphone') != null) {
                $data['cellphone'] = $this->input->post('cellphone');
            }
            if ($this->input->post('cellphone2') != null) {
                $data['cellphone2'] = $this->input->post('cellphone2');
            }
            if ($this->input->post('academic_level') != null) {
                $data['academic_level'] = $this->input->post('academic_level');
            }
            if ($this->input->post('profession') != null) {
                $data['profession'] = $this->input->post('profession');
            }
            if ($this->input->post('occupation') != null) {
                $data['occupation'] = $this->input->post('occupation');
            }
            if ($this->input->post('company_invoice') != null) {
                $data['company_invoice'] = $this->input->post('company_invoice');
            }
            if ($this->input->post('rnc') != null) {
                $data['rnc'] = $this->input->post('rnc');
            }
            if ($this->input->post('identification_card_invoice') != null) {
                $data['identification_card_invoice'] = $this->input->post('identification_card_invoice');
            }
            if ($this->input->post('comprobante_fiscal') != null) {
                $data['comprobante_fiscal'] = $this->input->post('comprobante_fiscal');
            }
            if ($this->input->post('email') != null) {
                $data['email'] = $this->input->post('email');
            }
            if ($this->input->post('password') != null) {
                $data['password'] = sha1($this->input->post('password'));
            }

            $validator['success'] = true;
            $validator['redirect'] = base_url() . 'index.php?admin/parent/';
            $this->db->insert('parent', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

         }
         else{
             $validator['success'] = false;
             foreach ($_POST as $key => $value) {
                 $validator['messages'][$key] = form_error($key);
             }
         }
         
        echo json_encode($validator);
    }

    function editParent($teacherId = null)
    {
        if($teacherId) {

            $validator = array('success' => false, 'messages' => array());
            
            // Obtenemos el ID por Post
            $id = $this->input->post("parent_id");
                
            // Traemos todos los campos del ID enviado por Post
            $info = $this->db->select()->from('parent')->where('parent_id', $id)->get()->row();
            
            // Validar si existe otro diferente al actual
            if(!$id ||  $info->identification_card != $this->input->post('identification_card')){
                // Cumplir la regla
                $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|is_unique[parent.identification_card]|xss_clean');
            }else{
                // Sin la regla
                $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|xss_clean');
            }
    
            // Validar si existe otro diferente al actual
            if(!$id ||  $info->passport != $this->input->post('passport')){
                // Cumplir la regla
                $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|is_unique[parent.passport]|xss_clean');
            }else{
                // Sin la regla
                $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|xss_clean');
            }
    
            // validacion RNC/Cedula empresa
            if($this->input->post('company_invoice') === "rnc"){
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|required|xss_clean');
            } else if($this->input->post('company_invoice') === "cedula") {
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|required|xss_clean');
            } else if($this->input->post('company_invoice') === "Ninguno"){
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|xss_clean');
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|xss_clean');
            } else {
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|required|xss_clean');
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|required|xss_clean');
            }
    
            // Validar si existe otro CORREO diferente al actual
            if(!$id ||  $info->email != $this->input->post('email')){
                // Cumplir la regla
                $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[parent.email]|xss_clean');
            }else{
                // Sin la regla
                $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
            }
    
            // Validar si cambiara la contraseña
            // if($this->input->post('password') != null || $this->input->post('password') != ""){
            //     $this->form_validation->set_rules('password', 'contraseña', 'required|matches[confirm_password]|min_length[5]|xss_clean');
            //     $this->form_validation->set_rules('confirm_password', 'confirmar contraseña', 'required|matches[password]|min_length[5]|xss_clean');
            // } else {
            //     $this->form_validation->set_rules('password', 'contraseña', 'matches[confirm_password]|min_length[5]|xss_clean');
            //     $this->form_validation->set_rules('confirm_password', 'confirmar contraseña', 'matches[password]|min_length[5]|xss_clean');
            // }
    
            
            $validate_data = array(
                array(
                    'field' => 'identification_type',
                    'label' => 'tipo de identificación',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'name',
                    'label' => 'nombre',
                    'rules' => 'trim|required|min_length[4]|xss_clean'
                ),
                array(
                    'field' => 'lastname',
                    'label' => 'apellido',
                    'rules' => 'trim|required|min_length[4]|xss_clean'
                ),
                array(
                    'field' => 'birthday',
                    'label' => 'cumpleaños',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'sex',
                    'label' => 'género',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'civil_status',
                    'label' => 'estado civil',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'nationality',
                    'label' => 'nacionalidad',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'municipio',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'sector',
                    'label' => 'sector',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'address',
                    'label' => 'calle',
                    'rules' => 'trim|required|min_length[5]|xss_clean'
                ),
                array(
                    'field' => 'phone_home',
                    'label' => 'teléfono casa',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'phone_office',
                    'label' => 'teléfono oficina',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'phone_office_ext',
                    'label' => 'ext.',
                    'rules' => 'trim|integer|xss_clean'
                ),
                array(
                    'field' => 'cellphone',
                    'label' => 'celular',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'cellphone2',
                    'label' => 'celular',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'academic_level',
                    'label' => 'nivel académico',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'profession',
                    'label' => 'profesión',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'occupation',
                    'label' => 'ocupación',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'company_invoice',
                    'label' => 'factura a nombre de la empresa',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'comprobante_fiscal',
                    'label' => 'tipo de comprobante fiscal',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                )
            );
            
            $this->form_validation->set_rules($validate_data);
            $this->form_validation->set_message('is_unique', 'Ya existe.');
            $this->form_validation->set_message('check_default', 'Debe seleccionar algo distinto al predeterminado.');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    
            if ($this->form_validation->run() === true) {
    
                if ($this->input->post('identification_card') != null) {
                    $data['identification_card'] = $this->input->post('identification_card');
                }
                if ($this->input->post('passport') != null) {
                    $data['passport'] = $this->input->post('passport');
                }
                if ($this->input->post('name') != null) {
                    $data['name'] = $this->input->post('name');
                }
                if ($this->input->post('lastname') != null) {
                    $data['lastname'] = $this->input->post('lastname');
                }
                if ($this->input->post('birthday') != null) {
                    $data['birthday'] = $this->input->post('birthday');
                }
                if ($this->input->post('sex') != null) {
                    $data['sex'] = $this->input->post('sex');
                }
                if ($this->input->post('civil_status') != null) {
                    $data['civil_status'] = $this->input->post('civil_status');
                }
                if ($this->input->post('nationality') != null) {
                    $data['nationality'] = $this->input->post('nationality');
                }
                if ($this->input->post('municipality') != null) {
                    $data['municipality'] = $this->input->post('municipality');
                }
                if ($this->input->post('sector') != null) {
                    $data['sector'] = $this->input->post('sector');
                }
                if ($this->input->post('address') != null) {
                    $data['address'] = $this->input->post('address');
                }
                if ($this->input->post('phone_home') != null) {
                    $data['phone_home'] = $this->input->post('phone_home');
                }
                if ($this->input->post('phone_office') != null) {
                    $data['phone_office'] = $this->input->post('phone_office');
                }
                if ($this->input->post('phone_office_ext') != null) {
                    $data['phone_office_ext'] = $this->input->post('phone_office_ext');
                }
                if ($this->input->post('cellphone') != null) {
                    $data['cellphone'] = $this->input->post('cellphone');
                }
                if ($this->input->post('cellphone2') != null) {
                    $data['cellphone2'] = $this->input->post('cellphone2');
                }
                if ($this->input->post('academic_level') != null) {
                    $data['academic_level'] = $this->input->post('academic_level');
                }
                if ($this->input->post('profession') != null) {
                    $data['profession'] = $this->input->post('profession');
                }
                if ($this->input->post('occupation') != null) {
                    $data['occupation'] = $this->input->post('occupation');
                }
                if ($this->input->post('company_invoice') != null) {
                    $data['company_invoice'] = $this->input->post('company_invoice');
                }
                if ($this->input->post('rnc') != null) {
                    $data['rnc'] = $this->input->post('rnc');
                }
                if ($this->input->post('identification_card_invoice') != null) {
                    $data['identification_card_invoice'] = $this->input->post('identification_card_invoice');
                }
                if ($this->input->post('comprobante_fiscal') != null) {
                    $data['comprobante_fiscal'] = $this->input->post('comprobante_fiscal');
                }
                if ($this->input->post('email') != null) {
                    $data['email'] = $this->input->post('email');
                }
                // if ($this->input->post('password') != null) {
                //     $data['password'] = sha1($this->input->post('password'));
                // }
    
                $validator['success'] = true;
                $validator['redirect'] = base_url() . 'index.php?admin/parent/';
                $this->db->where('parent_id', $id);
                $this->db->update('parent', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //    $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
    
            }
            else{
                $validator['success'] = false;
                foreach ($_POST as $key => $value) {
                    $validator['messages'][$key] = form_error($key);
                }
            }
            
            echo json_encode($validator);

        }
   }

    // Validar que el select no este vacio
    function check_default($select)
    {
      return $select == '0' ? FALSE : TRUE;
    }

    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            
            $validator = array('success' => false, 'messages' => array());
            
            // Condicion tipo de identificacion
            if($this->input->post('identification_type') === "cedula"){
            $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|is_unique[parent.identification_card]|xss_clean');
            } else if($this->input->post('identification_type') === "pasaporte") {
            $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|is_unique[parent.passport]|xss_clean');
            } else {
            $this->form_validation->set_rules('identification_card', 'cédula', 'trim|required|is_unique[parent.identification_card]|xss_clean');
            $this->form_validation->set_rules('passport', 'pasaporte', 'trim|required|is_unique[parent.passport]|xss_clean');
            }

            // validacion RNC/Cedula empresa
            if($this->input->post('company_invoice') === "rnc"){
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|required|xss_clean');
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|xss_clean');
            } else if($this->input->post('company_invoice') === "cedula") {
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|required|xss_clean');
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|xss_clean');
            } else {
                $this->form_validation->set_rules('rnc', 'RNC', 'trim|xss_clean');
                $this->form_validation->set_rules('identification_card_invoice', 'cédula', 'trim|xss_clean');
            }
                
                $validate_data = array(
                array(
                    'field' => 'identification_type',
                    'label' => 'tipo de identificación',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'name',
                    'label' => 'nombre',
                    'rules' => 'trim|required|min_length[4]|xss_clean'
                ),
                array(
                    'field' => 'lastname',
                    'label' => 'apellido',
                    'rules' => 'trim|required|min_length[4]|xss_clean'
                ),
                array(
                    'field' => 'birthday',
                    'label' => 'cumpleaños',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'sex',
                    'label' => 'género',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'civil_status',
                    'label' => 'estado civil',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'nationality',
                    'label' => 'nacionalidad',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'municipio',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'sector',
                    'label' => 'sector',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'address',
                    'label' => 'calle',
                    'rules' => 'trim|required|min_length[5]|xss_clean'
                ),
                array(
                    'field' => 'phone_home',
                    'label' => 'teléfono casa',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'phone_office',
                    'label' => 'teléfono oficina',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'phone_office_ext',
                    'label' => 'ext.',
                    'rules' => 'trim|integer|xss_clean'
                ),
                array(
                    'field' => 'cellphone',
                    'label' => 'celular',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'cellphone2',
                    'label' => 'celular',
                    'rules' => 'trim|xss_clean'
                ),
                array(
                    'field' => 'academic_level',
                    'label' => 'nivel académico',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'profession',
                    'label' => 'profesión',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'occupation',
                    'label' => 'ocupación',
                    'rules' => 'trim|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'company_invoice',
                    'label' => 'factura a nombre de la empresa',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'comprobante_fiscal',
                    'label' => 'tipo de comprobante fiscal',
                    'rules' => 'trim|required|callback_check_default|xss_clean'
                ),
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|required|valid_email|is_unique[parent.email]|xss_clean'
                ),
                array(
                    'field' => 'password',
                    'label' => 'contraseña',
                    'rules' => 'required|matches[confirm_password]|min_length[5]|xss_clean'
                ),
                array(
                    'field' => 'confirm_password',
                    'label' => 'confirmar contraseña',
                    'rules' => 'required|matches[password]|min_length[5]|xss_clean'
                )
                );
                
                $this->form_validation->set_rules($validate_data);
                $this->form_validation->set_message('is_unique', 'Ya existe.');
                $this->form_validation->set_message('check_default', 'Debe seleccionar algo distinto al predeterminado.');
                $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
                if ($this->form_validation->run() === true) {

                    // Traemos la ultima matricula
                $maxEnroll = $this->admin_model->maxEnroll();
                // Tramenos el ultmo año registrado
                $getYear =  $this->admin_model->getYear();
                // Traemos la ultmia secuencia númerica
                $getlast =  $this->admin_model->getlast();
                $currentYear = date("Y");

                // Verificamos si no hay matriculas en el sistema
                if (empty($maxEnroll)) {
                    $enrollment1 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
                    $data['enrollment'] = $enrollment1;

                } else {
                    // Verfificamos si el ultimo año traido es igual a el año actual
                    if ($getYear === $currentYear) {
                        $enrollment2 = $currentYear."-".str_pad($getlast + 1,5,0, STR_PAD_LEFT);
                        $data['enrollment'] = $enrollment2;
                    } else {
                        // reseteamos con el nuevo año y la secuencia númerica desde 1 
                        $enrollment3 = $currentYear."-".str_pad(1,5,0, STR_PAD_LEFT);
                        $data['enrollment'] = $enrollment3;
                    }
                }

                if ($this->input->post('identification_card') != null) {
                    $data['identification_card'] = $this->input->post('identification_card');
                }
                if ($this->input->post('passport') != null) {
                    $data['passport'] = $this->input->post('passport');
                }
                if ($this->input->post('name') != null) {
                    $data['name'] = $this->input->post('name');
                }
                if ($this->input->post('lastname') != null) {
                    $data['lastname'] = $this->input->post('lastname');
                }
                if ($this->input->post('birthday') != null) {
                    $data['birthday'] = $this->input->post('birthday');
                }
                if ($this->input->post('sex') != null) {
                    $data['sex'] = $this->input->post('sex');
                }
                if ($this->input->post('civil_status') != null) {
                    $data['civil_status'] = $this->input->post('civil_status');
                }
                if ($this->input->post('nationality') != null) {
                    $data['nationality'] = $this->input->post('nationality');
                }
                if ($this->input->post('municipality') != null) {
                    $data['municipality'] = $this->input->post('municipality');
                }
                if ($this->input->post('sector') != null) {
                    $data['sector'] = $this->input->post('sector');
                }
                if ($this->input->post('address') != null) {
                    $data['address'] = $this->input->post('address');
                }
                if ($this->input->post('phone_home') != null) {
                    $data['phone_home'] = $this->input->post('phone_home');
                }
                if ($this->input->post('phone_office') != null) {
                    $data['phone_office'] = $this->input->post('phone_office');
                }
                if ($this->input->post('phone_office_ext') != null) {
                    $data['phone_office_ext'] = $this->input->post('phone_office_ext');
                }
                if ($this->input->post('cellphone') != null) {
                    $data['cellphone'] = $this->input->post('cellphone');
                }
                if ($this->input->post('cellphone2') != null) {
                    $data['cellphone2'] = $this->input->post('cellphone2');
                }
                if ($this->input->post('academic_level') != null) {
                    $data['academic_level'] = $this->input->post('academic_level');
                }
                if ($this->input->post('profession') != null) {
                    $data['profession'] = $this->input->post('profession');
                }
                if ($this->input->post('occupation') != null) {
                    $data['occupation'] = $this->input->post('occupation');
                }
                if ($this->input->post('company_invoice') != null) {
                    $data['company_invoice'] = $this->input->post('company_invoice');
                }
                if ($this->input->post('rnc') != null) {
                    $data['rnc'] = $this->input->post('rnc');
                }
                if ($this->input->post('identification_card_invoice') != null) {
                    $data['identification_card_invoice'] = $this->input->post('identification_card_invoice');
                }
                if ($this->input->post('comprobante_fiscal') != null) {
                    $data['comprobante_fiscal'] = $this->input->post('comprobante_fiscal');
                }
                if ($this->input->post('email') != null) {
                    $data['email'] = $this->input->post('email');
                }
                if ($this->input->post('password') != null) {
                    $data['password'] = sha1($this->input->post('password'));
                }

                $validator['success'] = true;
                $validator['redirect'] = base_url() . 'index.php?admin/parent/';
                $this->db->insert('parent', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

                }
                else{
                    $validator['success'] = false;
                    foreach ($_POST as $key => $value) {
                        $validator['messages'][$key] = form_error($key);
                    }
                }
                
            echo json_encode($validator);
            
        }
        
        if ($param1 == 'edit') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            if ($this->input->post('phone_office') != null) {
               $data['phone_office'] = $this->input->post('phone_office');
            }
            else{
              $data['phone_office'] = null;
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            else{
               $data['address'] = null;
            }
            if ($this->input->post('profession') != null) {
                $data['profession'] = $this->input->post('profession');
            }
            else{
                $data['profession'] = null;
            }
            $validation = email_validation_for_edit($data['email'], $param2, 'parent');
            if ($validation == 1) {
                $this->db->where('parent_id' , $param2);
                $this->db->update('parent' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }

}
