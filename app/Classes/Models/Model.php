<?

namespace Classes\Models;

use mysqli;
use Exception;
use Classes\Foundation\Request;

class Model
{
    protected $connection = null;
    public $table = null;
    public $orderBy = "DESC";
    public $orderByColumn = "id";
    public $limit = null;
    public $where = [];

    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
    	
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            // if( $params ) {
            //     $stmt->bind_param($params[0], $params[1]);
            // }
            $stmt->execute();
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }

    public function get() {

        $request = Request::request();

        if (isset($request['limit']) && $request['limit']) {
            $this->limit($request['limit']);
        }

        if (isset($request['order-by']) && $request['order-by']) {
            $this->orderBy($request['order-by']);
        }

        if (isset($request['order-by-column']) && $request['order-by-column']) {
            $this->orderByColumn($request['order-by-column']);
        }

        $query = "SELECT * FROM {$this->table}";

        foreach ($this->where as $item) {
            $query .= " WHERE {$item[0]} {$item[1]} {$item[2]}";
        }

        $query .= " ORDER BY {$this->orderByColumn} {$this->orderBy}";

        if (isset($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        return Model::select(
            $query
        );
    }

    public function orWhere($column, $operator, $value) {
        array_push($this->where, [$column, $operator,$value]);
    }

    public function limit($limit) {
        $this->limit = $limit;
    }

    public function orderBy($orderBy = "DESC") {
        $this->orderBy = $orderBy;
    }

    public function orderByColumn($orderByColumn = "id") {
        $this->orderByColumn = $orderByColumn;
    }
}