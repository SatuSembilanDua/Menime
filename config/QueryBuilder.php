<?php

class QueryBuilder{

	private $con;
	private $config;
	private $sql;

	public function __construct($con, $config)
	{
		$this->con = $con;
		$this->config = $config;
	}

	public function get_all($ext =  "")
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		if($ext != ""){
			$this->sql .= " $ext";
		}
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_byid($id)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE ".$this->config['table'].".".$this->config['pk']." = '$id'";
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_slug($slug)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE ".$this->config['table'].".link_anime = '$slug'";
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_slug2($slug, $num)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		//$this->sql .= " WHERE ".$this->config['join'].".link_anime = '$slug' and ".$this->config['table'].".id_eps = $num";
		$this->sql .= " WHERE ".$this->config['join'].".link_anime = '$slug' and ";
		if(in_array($slug, ["avatar_the_legend_of_aang", "avatar_the_legend_of_korra", "spongebob_squarepants"]) ){
			$this->sql .= "id_eps = $num";
		}else{
			$this->sql .= "CAST(SUBSTR(".$this->config['table'].".eps, INSTR(".$this->config['table'].".eps, ' ')+1) AS REAL) = $num"; //$this->config['table'].".id_eps = $num";
		}
		//return $this->sql;
		//echo $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_byfk($id)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE ".$this->config['table'].".".$this->config['fk']." = '$id'";
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_where($wh)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE ";//.$wh[0]." = '".$wh[1]."'";
		$i = 0;
		foreach ($wh as $k => $v) {
			//$v = $this->con->real_escape_string($v);
			//$v = str_replace("'", "''", $v);
			if($i == 0){
				$this->sql .= "$k = '$v' ";
			}else{
				$this->sql .= "AND $k = '$v' ";
			}
			$i++;
		}
		//return $this->sql;
		return $this->con->query($this->sql);
	}


	public function get_qwhere($wh)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					$this->sql .= " JOIN ".$v." ON ";
					$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE $wh";
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_query($sql)
	{
		$this->sql = $sql;
		//return $this->sql;
		return $this->con->query( $sql);
	}




	public function get_all2($ext =  "")
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					if($k==0){
						$this->sql .= " JOIN ".$v." ON ";
						$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
					}else{
						$this->sql .= " JOIN ".$v." ON ";
						$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['join'][$k-1].".".$this->config['fk'][$k];
					}
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		
		if($ext != ""){
			$this->sql .= " $ext";
		}
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function get_byid2($id)
	{
		$this->sql = "SELECT * FROM ".$this->config['table'];
		if(isset($this->config['join'])){
			if(is_array($this->config['join'])){
				foreach ($this->config['join'] as $k => $v) {
					if($k==0){
						$this->sql .= " JOIN ".$v." ON ";
						$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['table'].".".$this->config['fk'][$k];
					}else{
						$this->sql .= " JOIN ".$v." ON ";
						$this->sql .= $v.".".$this->config['fk'][$k]." = ".$this->config['join'][$k-1].".".$this->config['fk'][$k];
					}
				}
			}else{
				$this->sql .= " JOIN ".$this->config['join']." ON ";
				$this->sql .= $this->config['join'].".".$this->config['fk']." = ".$this->config['table'].".".$this->config['fk'];
			}
		}
		$this->sql .= " WHERE ".$this->config['table'].".".$this->config['pk']." = '$id'";
		//return $this->sql;
		return $this->con->query($this->sql);
	}

	public function insert($data)
	{
		$ret = false;
		$this->sql = "INSERT INTO ".$this->config["table"];
		if(is_array($data)){
			$val = '';
			$isi = '';
			$i=0;
			foreach ($data as $k => $v) {
				//$v = $this->con->real_escape_string($v);
				if(sizeof($data)==1){
					$val .= " ($k)";
					$isi .= " VALUES ('$v') "; 
				}else{
					if($i==0){
						$val .= " ($k, "; 
						$isi .= " VALUES ('$v', "; 
					}else if($i==sizeof($data)-1){
						$val .= " $k) "; 
						$isi .= " '$v') "; 
					}else{
						$val .= " $k, "; 
						$isi .= " '$v', "; 
					}
					$i++;
				}
			}
			$this->sql .= $val.$isi;
			return $this->con->query($this->sql);
		}
		return $ret;
	}

	public function update($id, $data)
	{
		$ret = false;
		$this->sql = "UPDATE ".$this->config["table"];
		if(is_array($data)){
			$val = '';
			$i=0;
			foreach ($data as $k => $v) {
				if(sizeof($data)==1){
					$val .= " SET $k = '$v' "; 
				}else{
					if($i==0){
						$val .= " SET $k = '$v', "; 
					}else if($i==sizeof($data)-1){
						$val .= " $k = '$v' "; 
					}else{
						$val .= " $k = '$v', ";
					}
					$i++;
				}
			}
			$this->sql .= $val." WHERE ".$this->config['pk']." = '$id'";
			return $this->con->query($this->sql);
		}
		return $ret;
	}

	public function last_query()
	{
		return $this->sql;
	}

	public function get_naveps($id_anime, $id_eps)
	{
		$before = $id_eps-1;
	 	$after = $id_eps+1;

	 	$ret = ["prev"=> ["id" => "", "dis" => true], "next"=> ["id" => "", "dis" => true]];

	 	$this->sql = "SELECT id_episode, id_eps, eps FROM ".$this->config['table'];
	 	$this->sql .= " WHERE id_anime = '$id_anime' AND id_eps = $before ";
	 	$q_before = $this->con->query($this->sql);
		$row = $this->fetch_assoc($q_before);
		if(is_array($row)){
			//$ret["prev"]["id"] = $row["id_episode"]; 
			if( in_array($id_anime,["ME0001","ME0002","ME0021"])){
				$lkeps = $row["id_eps"];
			}else{
				$lkeps = explode(" ", $row["eps"])[1];
			}
			$ret["prev"]["id"] = $lkeps; //$row["id_eps"]; 
			$ret["prev"]["dis"] = false; 	
		}
		/*if($this->num_rows($q_before)>0){
		}	*/ 	

		$this->sql = "SELECT id_episode, id_eps, eps FROM ".$this->config['table'];
	 	$this->sql .= " WHERE id_anime = '$id_anime' AND id_eps = $after ";
	 	$q_after = $this->con->query( $this->sql);
		
		$row = $this->fetch_assoc($q_after);
		if(is_array($row)){
			//$ret["next"]["id"] = $row["id_episode"]; 
			if( in_array($id_anime,["ME0001","ME0002","ME0021"])){
				$lkeps = $row["id_eps"];
			}else{
				$lkeps = explode(" ", $row["eps"])[1];
			}
			$ret["next"]["id"] = $lkeps;//$row["id_eps"]; 
			$ret["next"]["dis"] = false; 
		}	 	
		/*if($this->num_rows($q_after)>0){
		}	 */	

		return $ret;
	}

	public function fetch_assoc($result)
	{
		if(is_a($this->con, "mysqli")){
			return $result->fetch_assoc();
		}else{
			return $result->fetchArray();
		}
	}

	public function num_rows($result)
	{
		if(is_a($this->con, "mysqli")){
			return $result->num_rows;
		}else{
			if ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL) {
			    return 1;
			} else {
			    return 0;
			}
		}
	}
}

?>