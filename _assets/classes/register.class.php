<?php
/**
	* File Name: Register
	* Creator URI: 
	* Description: Main configuration file
	* Author: @Gabriel Rodriguez:
	* Version: 1.1
	* Author URI: 
 */
class Register{

	var $sql;
	var $mail;
	//var $current_user;

	public function Register($sql/*, $getCurrentUser*/){

		$this->sql			= $sql;
		//$this->_user		= $getCurrentUser;
	}

	/** 
	* @param action
	* @return null
	*/

	public function setData(){

		$this->postData    = BlockXSS::sanitizes($_POST);
		$this->getData     = BlockXSS::sanitizes($_GET);
		$this->requestData = BlockXSS::sanitizes($_REQUEST);
		$this->action      = $this->getData['action'];

	}

	/** 
	* @param action
	* @return null
	*/

	public function process()
	{
		switch ($this->action) {
			case 'agregar_usuario':
				
                if(preg_match("/POST/i", $_SERVER['REQUEST_METHOD']))
				{
                    if($this->postData['password'] == $this->postData['rep_password'])
                    {
                        if ($this->check_email())
                        {
                            $alert = '<div class="alert alert-primary" role="alert">Correo ya registrado</div>';
                            $output .= $this->show_all_rows($alert);
                        }
                        else
                        {
                            if ($this->save_user())
                            {
                                $alert = '<div class="alert alert-primary" role="alert">Registrado </div>';
                                $output .= $this->show_all_rows($alert);
                            }
                            else
                            {
                                $alert = '<div class="alert alert-primary" role="alert">NO Registrado </div>';
                                $output .= $this->show_all_rows($alert);
                            }
                        }
                    }
                    else
                    {
                        $alert = '<div class="alert alert-primary" role="alert">Las contraseñas no coinciden </div>';
                        $output .= $this->show_all_rows($alert);
                    }	
                }
                else
				{
					$alert = '<div class="alert alert-primary" role="alert">Error</div>';
                    $output .= $this->show_all_rows($alert);
				}	    
				return $output;
			break;
			
			default:
				$output .= $this->show_all_rows();
				return $output;
			break;
		}
	}

	/** 
	* @param action
	* @return null
	*/

	public function check_email()
	{
		$query = "SELECT * from users WHERE email = ?";
		$params_query = array($this->postData['email']);

		if($sale_id = $this->sql->select($query, $params_query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function save_user()
	{
		$query = "INSERT INTO users (email, name, lastname, password, active) VALUES (?, ?, ?, ?, 1);";
		$params_query = array($this->postData['email'], 
        $this->postData['username'],
        $this->postData['lastname'],  
        md5($this->postData['password']));

		if($sale_id = $this->sql->insert($query, $params_query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/** 
	* @param action
	* @return null
	*/

	public function show_all_rows($alert='')
	{
		$output .= '
        '.$alert.'
        <div class="card-body collapse in">
            <div class="card-block">
                <form method="post" role="form" class="form-horizontal form-simple" action="register.php?action=agregar_usuario">
                    <fieldset class="form-group mb-0">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="username" placeholder="Nombre" required>
                    </fieldset>
                    <br>
                    <fieldset class="form-group mb-0">
                        <label>Apellido:</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Apellido" required>
                    </fieldset>
                    <br>
                    <fieldset class="form-group mb-0"">
                        <label>Correo Electrónico:</label>
                        <input type="email" class="form-control" name="email" placeholder="tunombre@dominio.com" required>
                    </fieldset>
                    <br>
                    <fieldset class="form-group mb-0"">
                        <label>Contraseña:</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </fieldset>
                    <br>
                    <fieldset class="form-group mb-0"">
                        <label>Repetir Contraseña:</label>
                        <input type="password" class="form-control" name="rep_password" placeholder="Repetir Contraseña" required>
                    </fieldset>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Registrarme</button>
                </form>
            </div>
        </div>';
		return $output;
	}
}

?>