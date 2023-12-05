<?php
class MainController{
    public function index(){
        return view('index',["name"=>["jhonatan"]]);
    }
    public function login(){
        return view('login');
    }
    public function home(){
        return view('home');
    }
    public function logout(){
        return view('logout');
    }
    public function show($id){
        return "Persona->".$id;
    }
}