<?php 
namespace App\Models;
use CodeIgniter\Model;
class Common extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function data_insert($table=null, array $data=null)
    {
        $query=false;
        if(isset($table)){
            $query = $this->db->table($table)->insert($data);
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

    public function getAllMenu()
    {
        $sql = 'SELECT * FROM tbl_menu';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getMenuList()
    {
        $sql = 'SELECT id,display_name FROM tbl_menu';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getMenu($id)
    {
        $sql = 'SELECT * FROM tbl_menu WHERE id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getRowArray();
        return $result;
    }
}