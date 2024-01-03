<?php
/**
	* File Name: Profile
	* Creator URI: 
	* Description: Main configuration file
	* Author: @Gabriel Rodriguez:
	* Version: 1.1
	* Author URI: 
 */
class Profile{

	var $sql;
	var $mail;
	//var $current_user;

	public function Profile($sql, $getCurrentUser){

		$this->sql			= $sql;
		$this->_user		= $getCurrentUser;
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
			case 'publicar':
                if(preg_match("/POST/i", $_SERVER['REQUEST_METHOD']))
				{
                    if ($this->save_post())
                    {
                        $alert = '<div class="alert alert-primary" role="alert">Publicado </div>';
                        $output .= $this->show_all_rows($alert);
                    }
                    else
                    {
                        $alert = '<div class="alert alert-primary" role="alert">NO Publicado </div>';
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

            case 'save_location':
                if(preg_match("/POST/i", $_SERVER['REQUEST_METHOD']))
				{
                    if ($this->save_user_location())
                    {
                        $alert = 'Guardado';
                        $output .= $this->show_all_rows($alert);
                    }
                    else
                    {
                        $alert = 'NO Guardado';
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

	public function get_user_info()
	{
		$query = "SELECT * from users WHERE user_id = ?";
		$params_query = array($this->getData['user_id']);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}
    
    public function get_user_posts()
	{
		$query = "SELECT * from posts WHERE id_user = ?";
		$params_query = array($this->getData['user_id']);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}

    public function get_post_user($user_id)
	{
		$query = "SELECT * from users WHERE user_id = ?";
		$params_query = array($user_id);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs[0];
		}
		else
		{
			return false;
		}
	}
    
    public function get_friends()
	{
		$query = "SELECT * from friendships WHERE user_id = ?";
		$params_query = array($this->getData['user_id']);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}

    public function get_user_location($user_id)
	{
		$query = "SELECT * from users_location WHERE id_user = ?";
		$params_query = array($user_id);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs[0];
		}
		else
		{
			return false;
		}
	}

    public function save_user_location()
	{
		$query = "INSERT INTO users_location (id_user, lat, lon) VALUES (?, ?, ?);";
		$params_query = array(
            $this->_user['user_id'], 
            $this->postData['lat'],
            $this->postData['lon']);

		if($sale_id = $this->sql->insert($query, $params_query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function save_post()
	{
        $datetime = date('Y-m-d H:i:s');
		$query = "INSERT INTO posts (id_user, photo, date, post_text, lat, lon) VALUES (?, ?, ?, ?, ?, ?);";
		$params_query = array($this->_user['user_id'], 
            $this->postData['photo'],
            $datetime, 
            $this->postData['post_text'],  
            $this->postData['lat'],
            $this->postData['lon']
        );

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
        if($this->action == 'see_friends')
        {
            $output .= '
            <div class="container">
                <div class="row">
                </div>
            </div>
                ';
        }
        if($this->action == 'set_user_location')
        {
            $output .= '
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <form method="post" action="?action=save_location" onsubmit="return save_location();">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="icon-map-marker"></i>  Agregar Ubicación A Mi Perfil
                                </h4>
                            </div>
                            <div class="card-block">
                                <p><b>Instrucciones:</b> Mueve el marcador en el mapa para indicar tu ubicación y guardarla en tu perfil.</p>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lon" id="lon">
                                <!-- <input type="hidden" name="dir" id="dir"> -->

                                <div id="mapa" style="width:100%;height:300px"></div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="icon-check"></i> Guardar Ubicación</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                ';
        }
        else
        {
            $output .= '
            <div class="container">
                <div class="row">
                    '.$alert.'
                    <div class="col-md-6">';
                        foreach ($this->get_user_info() as $user)
                        {
                            $user_location = $this->get_user_location($this->getData['user_id']);
                            if($user['profile_pic'])
                            {
                                $profile_picture = $user['profile_pic'];
                            }
                            else
                            {
                                $profile_picture = 'default.jpg';
                            }
                            $output .='
                            <div class="card">
                                <center><img class="card-img-top" src="./_assets/img/users/'.$profile_picture.'" alt="Card image cap" width="200" height="200"></center>
                                <div class="card-block">';
                                if($this->getData['user_id'] != $this->_user['user_id'])
                                {
                                    $output .='
                                    <center><form>
                                        <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                            <i class="icon-user-plus"></i> &nbsp; Agregar a mis amigos
                                        </button>
                                    </form></center>
                                    <hr>
                                    ';
                                }
                                $output .= '    
                                    <h2 class="card-title text-center">'.$user['name'].' '.$user['lastname'].'</h2>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="icon-envelope"></i> : &nbsp;  '.$user['email'].'
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-map-marker"></i> : &nbsp;';
                                            if ($this->get_user_location($this->getData['user_id']))
                                            {
                                                $output .= '<b>Lat: </b>'.$user_location['lat'].', <b>Lng: </b>'.$user_location['lon'].'';
                                            }
                                            else
                                            {
                                                $output .= '<small class="text-muted">Sin Ubicación Agregada... '; 
                                                if ($this->getData['user_id'] == $this->_user['user_id']){
                                                    $output.='<a href="profile.php?action=set_user_location">Agregar Ubicación</a>';
                                                }
                                                $output .= '</small>';
                                            }
                                            $output .= '
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-calendar"></i> : &nbsp;  0000-00-00
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-user"></i> : &nbsp;  0
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            ';
                        }
                    $output .= '
                    </div>

                    <div class="col-md-6">';
                    foreach ($this->get_user_posts() as $post)
                    {
                        $author = $this->get_post_user($post['id_user']);
                        if($author['profile_pic'])
                        {
                            $profile_picture = $author['profile_pic'];
                        }
                        else
                        {
                            $profile_picture = 'default.jpg';
                        }
                        $output .='
                        <div class="card">
                            <div class="card-header">
                                <a href="profile.php?user_id='.$author['user_id'].'">
                                    <h5 class="card-title"><img src="./_assets/img/users/'.$profile_picture.'" width="30" style="border-radius:50px;"> 
                                    '.$author['name']. ' ' .$author['lastname'].'</h5>
                                </a>
                            </div>
                            <div class="card-block">
                                <p>'.$post['post_text']. '</p>
                            </div>
                            <div class="card-footer">
                                Like Comment
                            </div>
                        </div>
                        ';
                    }
                    $output .= '
                </div>

                </div>
            </div>';
        }
		return $output;
	}
}

?>