<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Affiliates
 *
 * @author Sony
 */
class Affiliates {

    //put your code here


    public static function add($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);

        $map = array();
        $map['farmout_name'] = 'farmout_name';
        $map['city'] = 'city';
        $map['vehicle'] = 'vehicle';
        $map['vehicle_no'] = 'vehicle_no';
        $map['rate_per_hour'] = 'rate_per_hour';
        $map['minimum'] = 'minimum';
        $map['contact_name'] = 'contact_name';
        $map['contact_number'] = 'contact_number';
        $map['contact_email'] = 'contact_email';
        $map['renewal_date'] = 'renewal_date';
        $ds = _bindArray($data, $map);
        return qi('affiliates', $ds);
    }

    public static function update($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['farmout_name'] = 'farmout_name';
        $map['city'] = 'city';
        $map['vehicle'] = 'vehicle';
        $map['vehicle_no'] = 'vehicle_no';
        $map['rate_per_hour'] = 'rate_per_hour';
        $map['minimum'] = 'minimum';
        $map['contact_name'] = 'contact_name';
        $map['contact_number'] = 'contact_number';
        $map['contact_email'] = 'contact_email';
        $map['renewal_date'] = 'renewal_date';
        $ds = _bindArray($data, $map);

        $condition = "id = " . $id;
        return qu('affiliates', $ds, $condition);
    }

    public static function delete($id) {
        $condition = "id =" . $id;
        return qd('affiliates', $condition);
    }

    public static function deleteCity($id) {
        $condition = "id =" . $id;
        return qd('affiliates_city_', $condition);
    }

    public static function getaffiliatesDetail($id) {
        return qs("SELECT * FROM affiliates WHERE id = " . $id);
    }

    public static function AffiliatesAttachment($id, $type) {
        return q("SELECT * FROM affiliates_attachment WHERE affiliates_id = '{$id}' AND file_type = '{$type}'");
        
    }

}

?>
