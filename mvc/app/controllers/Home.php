<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 04.06.2018
 * Time: 0:58
 */
class Home extends Controller
{
    public function Index($name='')
    {
        echo 'rout99ng';
        $this->view('home\index','123');
        $user = $this->model('User');
        $user->FirstName = $name;

    }



    public function PostTest()
    {
        $obj =json_decode($_POST['x']);
        echo $obj->nume;
    }
}
