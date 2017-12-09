<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

  /**** PADRES *****/

  // Traer el ultimo matriculado
  public function maxEnroll(){
    $maxEnroll = $this->db->query('SELECT enrollment AS `maxEnroll` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->maxEnroll;
    return $maxEnroll;
  }

  // Traer el ultimo año registrado
  public function getYear(){
    $getYear = $this->db->query('SELECT substring(enrollment,1,4) AS `getYear` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->getYear;
    return $getYear;
  }

  // Traer la ultima secuancia númerica
  public function getlast(){
    $getlast = $this->db->query('SELECT substring(enrollment,-5,5) AS `getlast` FROM parent ORDER BY parent_id DESC LIMIT 1')->row()->getlast;
    return $getlast;
  }

  // Traer la ultima secuancia númerica
  public function registrar(){
    echo "Hola";
  }

}