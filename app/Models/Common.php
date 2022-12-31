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
            $select=implode('","',$select);
        }else{
            $select='*';
        }
        if(isset($table)){
            $query = $this->db->table($table)->select($select)->where($where)->get();
            $result = $query->getRowArray();
            // echo var_dump($result);die();
        }
        return $result;
    }
}