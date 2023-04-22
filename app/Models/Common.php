<?php 
namespace App\Models;
use CodeIgniter\Model;
class Common extends Model
{
    protected $uri_segment;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->uri_segment = service('uri');
    }

    public function data_insert($table=null, array $data=null,string $type='single')
    {
        $query=false;
        if(isset($table)){
            if($type=="single"){
                $query = $this->db->table($table)->insert($data);
            }else{
                $query = $this->db->table($table)->insertBatch($data);
            }
            $id = $this->db->insertID();
            return $id;
        }else{
            return $query;
        }
        
    }

    public function data_single_update($table=null, array $where=array(), array $data=array())
    {
        $query=false;
        if(isset($table)){
            $query = $this->db->table($table)->update($data,$where);
            // echo $this->db->lastQuery;die();
        }
        return $query;
        
    }

    public function get_single_row($table=null, array $where=array(), array $select=array())
    {
        $result=null;
        if($select>0){
            $select=''.implode(',',$select).'';
        }else{
            $select='*';
        }
        // echo $select;die;
        if(isset($table)){
            $query = $this->db->table($table)->where($where)->select($select)->get();
            $result = $query->getRowArray();
            // echo $this->db->lastQuery;die;
        }
        return $result;
    }

    public function get_data($table=null, array $where=array(), array $select=array(), $type='single')
    {
        $result=null;
        if($select>0){
            $select=''.implode(',',$select).'';
        }else{
            $select='*';
        }
        // echo $select;die;
        if(isset($table)){
            $query = $this->db->table($table)->where($where)->select($select)->get();
            if($type=='single'){
                $result = $query->getRowArray();
            }else{
                $result = $query->getResultArray();
            }
            // echo $this->db->lastQuery;die;
        }
        return $result;
    }

    

    public function getSearchQuery($q)
    {
        $sql = 'SELECT id,email,first_name,last_name FROM tbl_user WHERE email LIKE "%'.$q.'%" OR first_name LIKE "%'.$q.'%" LIMIT 10';
        $query = $this->db->query($sql);
        // echo $this->db->lastQuery;die;
        $result = $query->getResultArray();
        return $result;
    }

    public function getAllPermissions()
    {
        $sql = 'SELECT * FROM tbl_permissions';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getPermissionList()
    {
        $sql = 'SELECT id,display_name FROM tbl_permissions';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getPermission($id)
    {
        $sql = 'SELECT * FROM tbl_permissions WHERE id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getRowArray();
        return $result;
    }

    public function getAllRoles()
    {
        $sql = 'SELECT * FROM tbl_roles';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function deleteRole($id)
    {
        $query=false;
        try {
            $sql = 'DELETE FROM tbl_roles WHERE id='.$id.'';
            $query = $this->db->query($sql);
            return $query;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $query;
    }

    public function getRoleList()
    {
        $sql = 'SELECT id,display_name FROM tbl_roles';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getRole($id)
    {
        $sql = 'SELECT * FROM tbl_roles WHERE id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getRowArray();
        return $result;
    }

    // get permission of user of permission details
    public function getUserPermissions($id)
    {
        $sql = 'SELECT tb.* FROM tbl_permissions as tb 
        WHERE tb.id IN (
            SELECT tb.parent as id FROM (SELECT tp.* FROM tbl_permissions as tp
            LEFT JOIN tbl_user_permissions as tup on tup.permission_id=tp.id
            WHERE tup.user_id='.$id.' AND tp.status=1) as tb
            UNION
            SELECT tb.id FROM (SELECT tp.* FROM tbl_permissions as tp
            LEFT JOIN tbl_user_permissions as tup on tup.permission_id=tp.id
            WHERE tup.user_id='.$id.' AND tp.status=1) as tb
            )
        ORDER BY tb.id ASC';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        // echo $this->db->lastQuery;echo "<pre>";print_r($result);die;
        return $result;
    }

    // get permission of user in single array i.e, [2,4,1] 
    public function getUserPermissionsIds($id)
    {
        $sql = 'SELECT tup.permission_id FROM tbl_user_permissions as tup
        WHERE tup.user_id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        $result = array_column($result, 'permission_id');
        // echo $this->db->lastQuery;
        return $result;
    }

    public function deleteUserPermissions($uid,array $pids)
    {
        $permission_ids=''.implode(',',$pids).'';
        $sql = 'DELETE FROM tbl_user_permissions WHERE user_id='.$uid.' AND permission_id IN ('.$permission_ids.')';
        $query = $this->db->query($sql);
        // echo $this->db->lastQuery;
        return $query;
    }

    public function addUserPermissions($uid,array $ids)
    {
        $values='';
        $count=1;
        foreach ($ids as $key => $value) {
            if($count!=1){
                $values.=',';
            }
            $values.='('.$uid.','.$value.')';
            $count++;
        }
        // echo '<pre>';print_r($values);die;
        $sql = 'INSERT INTO tbl_user_permissions (user_id,permission_id) VALUES '.$values.'';
        $query = $this->db->query($sql);
        // echo $this->db->lastQuery;
        return $query;
    }

    public function deleteRolePermissions($uid,array $pids)
    {
        $permission_ids=''.implode(',',$pids).'';
        $sql = 'DELETE FROM tbl_roles_permissions WHERE role_id='.$uid.' AND permission_id IN ('.$permission_ids.')';
        $query = $this->db->query($sql);
        // echo $this->db->lastQuery;
        return $query;
    }

    public function addRolePermissions($uid,array $ids)
    {
        $values='';
        $count=1;
        foreach ($ids as $key => $value) {
            if($count!=1){
                $values.=',';
            }
            $values.='('.$uid.','.$value.')';
            $count++;
        }
        // echo '<pre>';print_r($values);die;
        $sql = 'INSERT INTO tbl_roles_permissions (role_id,permission_id) VALUES '.$values.'';
        $query = $this->db->query($sql);
        // echo $this->db->lastQuery;
        return $query;
    }

    // get permission of role in single array i.e, [2,4,1] 
    public function getRolePermissionsIds($id)
    {
        $sql = 'SELECT trp.permission_id FROM tbl_roles_permissions as trp
        WHERE trp.role_id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        $result = array_column($result, 'permission_id');
        // echo $this->db->lastQuery;
        return $result;
    }


    public function checkUriPermission()
    {
        $session = session('usersession');
        $uri = $this->uri_segment->getSegment(2);
        $user_id = $session['id'];
        $sql = 'SELECT tp.id FROM `tbl_permissions` as tp
        LEFT JOIN tbl_user_permissions as tup on tp.id=tup.permission_id
        WHERE tup.user_id='.$user_id.' AND tp.routing_url="'.$uri.'"';
        $result = $this->db->query($sql)->getRowArray();
        if($result){
            return true;
        }else{
            return false;
        }
    }

}