<?php
/**
	* File Name: Posts
	* Creator URI: 
	* Description: Main configuration file
	* Author: @Gabriel Rodriguez:
	* Version: 1.1
	* Author URI: 
 */
class Posts{

	var $sql;
	var $mail;
	//var $current_user;

	public function Posts($sql, $getCurrentUser){

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

            case 'like_post':
                if(preg_match("/POST/i", $_SERVER['REQUEST_METHOD']))
				{
                    if ($this->like_post())
                    {
                        $alert = '<div class="alert alert-primary" role="alert">Like </div>';
                        $output .= $this->show_all_rows($alert);
                    }
                    else
                    {
                        $alert = '<div class="alert alert-primary" role="alert">NO Like </div>';
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
            

            case 'unlike_post':
                if(preg_match("/POST/i", $_SERVER['REQUEST_METHOD']))
				{
                    if ($this->unlike_post())
                    {
                        $alert = '<div class="alert alert-primary" role="alert">Like </div>';
                        $output .= $this->show_all_rows($alert);
                    }
                    else
                    {
                        $alert = '<div class="alert alert-primary" role="alert">NO Like </div>';
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

	public function show_posts()
	{
		$query = "SELECT * from posts ORDER BY date desc";
		//$params_query = array($this->postData['email']);

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

    public function if_liked($post_id, $user_id)
	{
		$query = "SELECT * from posts_likes WHERE id_post = ? and id_user = ?";
		$params_query = array($post_id, $user_id);

		if($rs = $this->sql->select($query, $params_query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    public function count_likes($post_id)
	{
		$query = "SELECT count(*) as likes from posts_likes WHERE id_post = ?";
		$params_query = array($post_id);

		if($rs = $this->sql->select($query, $params_query))
		{
			return $rs[0];
		}
		else
		{
			return false;
		}
	}

    public function like_post()
	{
        //$datetime = date('Y-m-d H:i:s');
		$query = "INSERT INTO posts_likes (id_post, id_user) VALUES (?, ?);";
		$params_query = array($this->postData['id_post'], 
            $this->_user['user_id']
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

    public function unlike_post()
	{
        //$datetime = date('Y-m-d H:i:s');
		$query = "DELETE FROM posts_likes WHERE id_post = ? AND id_user = ?;";
		$params_query = array($this->postData['id_post'], 
            $this->_user['user_id']
        );

		if($this->sql->delete($query, $params_query))
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

	public function show_weather()
	{
		$apiKey = "6b62ccff0ba29262b5c8b808d547bb0a";
		$cityId = "4013708";
		$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);

		curl_close($ch);
		$data = json_decode($response);
		$currentTime = time();
	}

	/** 
	* @param action
	* @return null
	*/

	public function show_all_rows($alert='')
	{
		$output .= '
        <div class="container">
            <div class="row">
                '.$alert.'
                <div class="col-md-8">';
                    foreach ($this->show_posts() as $post)
                    {
                        $author = $this->get_post_user($post['id_user']);
                        $likes = $this->count_likes($post['id_post']);
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
                                <p class="text-muted"><i class="icon-heart"></i>  &nbsp; '.$likes['likes'].'</p>
                            </div>
                            <div class="card-footer" role="group" >';
                                    if(!$this->if_liked($post['id_post'], $this->_user['user_id']))
                                    {
                                        $output .= '
                                        <form method="post" action="?action=like_post" onsubmit="return like_post('.$post['id_post'].');">
                                            <input type="hidden" value="'.$post['id_post'].'" v-model="postID" name="id_post" id="id_post">
                                            <button type="submit" class="btn btn-secondary" @click="likePost()" id="btn_like">
                                                <i class="icon-heart"></i> &nbsp; Me Gusta
                                            </button>
                                        </form>';
                                    }
                                    else
                                    {
                                        $output .= '
                                        <form method="post" action="?action=unlike_post" onsubmit="return unlike_post('.$post['id_post'].', '.$this->_user['user_id'].');">
                                            <input type="hidden" value="'.$post['id_post'].'" v-model="postID" name="id_post" id="id_post">
                                                <button type="submit" class="btn btn-secondary" @click="unlikePost()" id="btn_like">
                                                <i class="icon-heart-broken"></i> &nbsp; Ya No Te Gusta
                                            </button>
                                        </form>';
                                    }
                                    $output .= '
                            </div>
                        </div>
                        ';
                    }
                $output .= '
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="icon-edit"></i> Nueva Publicación</h4>
                        </div>
                        <form class="card-block" method="post" role="form" action="?action=publicar">
                            <div class="form-group">
                                <textarea name="post_text" class="form-control" autocomplete="off" placeholder="¿Qué quieres publicar?" rows="5"></textarea>
                                <!-- <input type="text" id="num_cliente" class="form-control"
                                placeholder="Número De Cliente" name="num_cliente" autocomplete="off" required> -->
                            </div>
                            <div class="form-group">
                                <label for="photo">Subir Foto</label>
                                <input type="file" class="form-control-file" name="photo" id="photo">
                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block"> Publicar</button>
                        </div>
                        </form>
                    </div>

					<div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="icon-sun"></i> El Clima De Hoy</h4>
                        </div>
                        <div class="card-block">
						<div class="widget">
						<h3>Weather Forecast</h3>
						<div class="content">
							<h2>'.$data->name.'</h2>			
						</div>
				
						<div class="representation">
							<img src="http://openweathermap.org/img/w/'. $data->weather[0]->icon.'.png" />
							<p>'.ucwords($data->weather[0]->description).'</p>
						</div>
						
						<div class="content-full">
							<hr/>
							<div class="half">
								<b>Min. temp. : </b> <span class="min-temp">'. $data->main->temp_min.'°C</span><br/>
								<b>Min. temp. : </b> <span class="max-temp">'. $data->main->temp_max.'°C</span><br/>	
							</div>	
							<div class="half">	
								<b>Humidity: </b>'. $data->main->humidity.' %<br/>
								<b>Wind: </b>'. $data->wind->speed.' km/h<br/>
							</div>
							<p><small>Consulted at: '.date('H:i:s d/m/Y').'</small></p>
						</div>
					</div>
				
                        </div>
                    </div>
                </div>

            </div>
        </div>';
		return $output;
	}
}

?>