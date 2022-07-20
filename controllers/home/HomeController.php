<?php
class HomeController extends Controller
{

    public function index()
    {
        return $this->view('home/index');
    }

    public function show()
    {
        return $this->view('home/index');
    }

}
?>